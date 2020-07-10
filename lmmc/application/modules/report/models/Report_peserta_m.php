<?php

class Report_peserta_m extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db_s = $this->load->database('simari', TRUE)->database;
    }

    public function excelize_ringkasan($data)
    {
        $this->load->library('excel');

        $field = [
            '0' => ' ',
            '1' => 'EKSAKTA',
            '2' => 'NON EKSAKTA',
            '3' => 'JUMLAH',
            '4' => 'CATATAN',
        ];

        $this->excel->generateExcel($data, 'Laporan Ringkasan', $field);
    }

    public function excelize_detail_ringkasan($data_object)
    {
        // convert to array
        $data = json_decode(json_encode($data_object, true), true);

        $this->load->library('excel');

        $field = [
            'pesertaNoregis' => 'No Registrasi',
            'pesertaNama' => 'Nama Mahasiswa',
            'knkdtNamahasil' => 'Rincian Masalah',
            'prodiNamaResmi' => 'Program Studi'
        ];

        $this->excel->generateExcel($data, 'Laporan Detail Ringkasan', $field);
    }

    public function get_jaluraktif()
    {
        $this->db->select('*');
        $this->db->from('lmmc_m_jalur');
        $this->db->where('jalurIsactive', 1);

        $db_res = $this->db->get();
        return $db_res->row()->jalurId;
    }

    public function jum_mhs($status)
    {
        $jalur_aktif = $this->get_jaluraktif();
        $this->db->select('*');
        $this->db->from('lmmc_m_peserta');
        $this->db->join('sia_m_prodi', 'lmmc_m_peserta.pesertaProdiid = sia_m_prodi.prodiKode');
        $this->db->where('prodiIsEksakta', $status);
        $this->db->where('pesertaJalurid', $jalur_aktif);

        $db_res = $this->db->get();
        return $db_res->num_rows();
    }

    public function jum_mhs_notnull($status)
    {
        $jalur_aktif = $this->get_jaluraktif();
        $this->db->select('*');
        $this->db->from('lmmc_m_peserta');
        $this->db->join('sia_m_prodi', 'lmmc_m_peserta.pesertaProdiid = sia_m_prodi.prodiKode');
        $this->db->where('prodiIsEksakta', $status);
        $this->db->where('pesertaJalurid', $jalur_aktif);
        $this->db->where('pesertaTanggalverifikasi is NOT NULL', NULL, FALSE);

        $db_res = $this->db->get();
        return $db_res->num_rows();
    }

    public function hasil_status($status, $hid)
    {
        $jalur_aktif = $this->get_jaluraktif();
        $this->db->select('*');
        $this->db->from('lmmc_t_hasilpemeriksaan');
        $this->db->join('lmmc_m_klinikdetil', 'lmmc_t_hasilpemeriksaan.hasilKnkdtid = lmmc_m_klinikdetil.knkdtId');
        $this->db->join('lmmc_m_peserta', 'lmmc_t_hasilpemeriksaan.hasilPesertaid = lmmc_m_peserta.pesertaNoregis');
        $this->db->join('sia_m_prodi', 'lmmc_m_peserta.pesertaProdiid = sia_m_prodi.prodiKode');
        $this->db->where('prodiIsEksakta', $status);
        $this->db->where('pesertaJalurid', $jalur_aktif);
        $this->db->where('hasilKnkdtid', $hid);

        $db_res = $this->db->get();
        return $db_res->num_rows();
    }

    public function hasil_status_fk_fkg($status, $klinikid)
    {
        if ($klinikid == "1") {
            $fkfkg = [
                '11201',
                '11706',
                '11707',
                '11708',
                '11709',
                '11711',
                '11901',
                '12201',
                '12901',

            ];
        } else {
            $fkfkg = [
                '12201',
                '12901',
            ];
        }


        $jalur_aktif = $this->get_jaluraktif();
        $this->db->select('*');
        $this->db->from('lmmc_t_hasilpemeriksaan');
        $this->db->join('lmmc_m_peserta', 'lmmc_t_hasilpemeriksaan.hasilPesertaid = lmmc_m_peserta.pesertaNoregis');
        $this->db->join('sia_m_prodi', 'lmmc_m_peserta.pesertaProdiid = sia_m_prodi.prodiKode');
        $this->db->where('prodiIsEksakta', $status);
        $this->db->where('hasilKlinikid', $klinikid);
        $this->db->where('pesertaJalurid', $jalur_aktif);
        $this->db->or_where_in('pesertaProdiid', $fkfkg);

        // foreach ($fk as $f) {
        //     $this->db->or_where('pesertaProdiid', $f);
        // }
        $this->db->group_by('hasilPesertaid');


        $db_res = $this->db->get();
        return $db_res->num_rows();
    }

    public function get_bermasalah()
    {
        $tidaksehat = [
            '50',
            '52',
            '53',
            '55',
            '56',
            '61',
            '63',
        ];
        $jalur_aktif = $this->get_jaluraktif();
        $this->db->select('pesertaNoregis, pesertaNama, knkdtNamahasil, prodiNamaResmi');
        $this->db->from('lmmc_t_hasilpemeriksaan');
        $this->db->join('lmmc_m_klinikdetil', 'lmmc_t_hasilpemeriksaan.hasilKnkdtid = lmmc_m_klinikdetil.knkdtId');

        $this->db->join('lmmc_m_peserta', 'lmmc_t_hasilpemeriksaan.hasilPesertaid = lmmc_m_peserta.pesertaNoregis');
        $this->db->join('sia_m_prodi', 'lmmc_m_peserta.pesertaProdiid = sia_m_prodi.prodiKode');

        $this->db->where('pesertaJalurid', $jalur_aktif);
        $this->db->where('knkdtKriteria<', 4);

        // $this->db->where('hasilKnkdtid', "49");
        // $this->db->or_where_in('hasilKnkdtid', $tidaksehat);
        $this->db->order_by('pesertaNoregis', 'desc');

        $report_data = $this->db->get()->result();

        $flagged = [];
        $i = 1;
        foreach ($report_data as $p) {
            if (isset($report_data[$i])) {
                if ($p->pesertaNoregis == $report_data[$i]->pesertaNoregis) {
                    $report_data[$i - 1]->knkdtNamahasil = $report_data[$i - 1]->knkdtNamahasil . ", " . $report_data[$i]->knkdtNamahasil;
                    unset($report_data[$i]);
                }
            }
            $i++;
        }

        return $report_data;
    }

    public function report_data()
    {
        $report_data = array();

        $j11 = $this->jum_mhs("1");
        $j12 = $this->jum_mhs("0");
        $j13 = $j11 + $j12;
        $report_data[0] = [
            $j11,
            $j12,
            $j13,
        ];

        $j21 = $this->jum_mhs_notnull("1");
        $j22 = $this->jum_mhs_notnull("0");
        $j23 = $j21 + $j22;
        $report_data[1] = [
            $j21,
            $j22,
            $j23,
        ];

        $j31 = $this->hasil_status("1", "61");
        $j32 = $this->hasil_status("0", "61");
        $j33 = $j31 + $j32;
        $report_data[2] = [
            $j31,
            $j32,
            $j33,
        ];

        $j41 = $this->hasil_status("1", "60");
        $j42 = $this->hasil_status("0", "60");
        $j43 = $j41 + $j42;
        $report_data[3] = [
            $j41,
            $j42,
            $j43,
        ];

        $j51 = $this->hasil_status("1", "53");
        $j52 = $this->hasil_status("0", "53");
        $j53 = $j51 + $j52;
        $report_data[4] = [
            $j51,
            $j52,
            $j53,
        ];

        $j61 = $this->hasil_status("1", "54");
        $j62 = $this->hasil_status("0", "54");
        $j63 = $j61 + $j62;
        $report_data[5] = [
            $j61,
            $j62,
            $j63,
        ];

        $j71 = $this->hasil_status_fk_fkg("1", "1");
        $j72 = $this->hasil_status_fk_fkg("0", "1");
        $j73 = $j71 + $j72;
        $report_data[6] = [
            $j71,
            $j72,
            $j73,
        ];

        $j81 = $this->hasil_status_fk_fkg("1", "4");
        $j82 = $this->hasil_status_fk_fkg("0", "4");
        $j83 = $j81 + $j82;
        $report_data[7] = [
            $j81,
            $j82,
            $j83,
        ];
        return $report_data;
    }
}
