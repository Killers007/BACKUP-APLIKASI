<?php

/**
 * Description of MY_Controller
 *
 * @author azmi.adhani@ulm.ac.id
 */
class Peserta_m extends MY_Model
{
    private $mechapp;
    private $simari;
    public $fileBPJS;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->simari = $this->load->database('default', TRUE)->database;
        $this->fileBPJS = $this->config->item("path_foto_peserta");
        // $this->mechapp = $this->load->database('mechapp', TRUE);
    }

    function tagihanIsLunas()
    {
        $jalurId = $this->getJalurActive();
        // $this->db->where('tagihanJalurId', @$jalurId->jalurId);
        $this->db->where('tagihanNoRegis', $this->session->user['noregis']);
        $this->db->where('tagihanIslunas', 1);
        return $this->db->get('lmmc_t_tagihan')->num_rows();
    }

    public function rulesBPJS($isBpjs = false)
    {

        $rules = array(
            array('field' => 'bpjs', 'label' => 'Pernyataan BPJS', 'rules' => 'required|numeric'),
            array('field' => 'noBpjs', 'label' => 'Nomor BPJS', 'rules' => 'required|numeric'),
        );

        if (!$isBpjs) unset($rules[1]);

        return $rules;
    }

    function get_hasil($noRegis)
    {
        $this->db->where('pesertaNoregis', $noRegis);
        $this->db->join("{$this->simari}.sia_m_prodi", "pesertaProdiid = {$this->simari}.sia_m_prodi.prodiKode");
        $peserta = $this->db->get('lmmc_m_peserta')->row();

        $kategoriId = '';

        if (in_array($peserta->pesertaProdiid, self::DOKTER)) {
            $kategoriId = self::EKSAKTA_FK;
        } else if (in_array($peserta->pesertaProdiid, self::DOKTER_GIGI)) {
            $kategoriId = self::EKSAKTA_FKG;
        } else if ($peserta->prodiIsEksakta == 1) {
            $kategoriId = self::EKSAKTA;
        } else {
            $kategoriId = self::NON_EKSAKTA;
        }

        $this->db->where('tKategoriId', $kategoriId);
        $this->db->join('lmmc_m_klinik', 'klinikId = tKlinikId');
        $klinik = $this->db->get('lmmc_t_kategori_klinik')->result();

        $res = [];
        foreach ($klinik as $key => $value) {
            $this->db->where('hasilPesertaid', $noRegis);
            $this->db->where('hasilKlinikid', $value->klinikId);

            $this->db->join('lmmc_m_klinikdetil', 'knkdtId = hasilKnkdtid');
            $hasil = $this->db->get('lmmc_t_hasilpemeriksaan')->row();

            $res[] = (object) array(
                'klinikFormnama' => $value->klinikFormnama,
                'knkdtNamahasil' => @$hasil->knkdtNamahasil
            );
        }

        return $res;
    }

    function deleteImage($id)
    {
        if ($id != null) {
            $data = $this->get_data_peserta($id);

            $imageLocation = $this->fileBPJS . $data->pesertaFileBpjs;

            if (file_exists($imageLocation)) {
                @unlink($imageLocation);
            }
        }
    }

    public function setBPJS($data, $fileName = null)
    {
        $this->deleteImage($this->session->user['noregis']);
        if (!$data['pesertaIsBpjs']) {
            $data['pesertaFileBpjs'] = null;
            $data['pesertaNoBpjs'] = null;
        }

        if ($fileName != null) {

            $data['pesertaFileBpjs'] = $fileName;
        }

        $this->db->where('pesertaNoregis', $this->session->user['noregis']);
        $this->db->update('lmmc_m_peserta', $data);

        return ['status' => 'success', 'message' => 'Terimakasih'];
    }

    function get_jalur_by_peserta($id)
    {

        $this->db->select('*');
        $this->db->from('lmmc_m_peserta');
        $this->db->join('lmmc_m_jalur', 'lmmc_m_peserta.pesertaJalurid = lmmc_m_jalur.jalurId');
        $this->db->where('pesertaNoregis', $id);

        $db_res = $this->db->get();
        return $db_res->row();
    }

    public function get_data_peserta($id)
    {
        $this->db->select('*');
        $this->db->from('lmmc_m_peserta');
        $this->db->join('sia_m_prodi', 'lmmc_m_peserta.pesertaProdiid = sia_m_prodi.prodiKode');
        $this->db->join('lmmc_t_tagihan', 'lmmc_m_peserta.pesertaNoregis = lmmc_t_tagihan.tagihanNoRegis', 'left');
        $this->db->join('lmmc_m_jalur', 'lmmc_t_tagihan.tagihanJalurId = lmmc_m_jalur.jalurId','left');

        $this->db->join('sia_m_jurusan', 'sia_m_prodi.prodiJurKode = sia_m_jurusan.jurKode','left');
        $this->db->join('sia_m_fakultas', 'sia_m_jurusan.jurFakKode = sia_m_fakultas.fakKode','left');
        
        
        $this->db->where('pesertaNoregis', $id);

        $db_res = $this->db->get();
        return $db_res->row();
    }

    public function get_data_panduan()
    {
        $query = $this->db->query('SELECT * FROM lmmc_m_panduan WHERE panduanVersi=(SELECT MAX(panduanVersi) FROM lmmc_m_panduan)');
        return $query->row();
    }

    public function get_data_formNama()
    {
        $this->db->select('klinikNama, klinikId');
        $this->db->from('lmmc_m_klinik');

        $db_res = $this->db->get();
        return $db_res->result();
    }

    public function get_kategori($status)
    {
        $fk = self::DOKTER;
        $fkg = self::DOKTER_GIGI;

        /*
            1=Non Eksakta
            2=Eksakta
            3=Eksakta FK
            4=Eksakta FKG
        */
        $kategori = 0;

        $status_fk = 0;
        $status_fkg = 0;
        if ($status->prodiIsEksakta == 1) {
            foreach ($fk as $f) {
                if ($status->prodiKode == $f) {
                    $status_fk = 1;
                }
            }
            foreach ($fkg as $ff) {
                if ($status->prodiKode == $ff) {
                    $status_fkg = 1;
                }
            }
            if ($status_fk == 1) {
                $kategori = self::EKSAKTA_FK;
            } else if ($status_fkg == 1) {
                $kategori = self::EKSAKTA_FKG;
            } else {
                $kategori = self::EKSAKTA;
            }
        } else {
            $kategori = self::NON_EKSAKTA;
        }
        return $kategori;
    }

    public function get_biaya($status)
    {
        // $kategori = $this->get_kategori($status);

        $this->db->select('*');
        $this->db->from('lmmc_t_tagihan');
        $this->db->where('tagihanNoRegis', $status->pesertaNoregis);

        $r = $this->db->get();
        return $r->row();
    }

    function convert_to_rupiah($angka)
    {
        return 'Rp. ' . strrev(implode('.', str_split(strrev(strval($angka)), 3))) . ',00';
    }

    public function get_form($status)
    {
        $kategori = $this->get_kategori($status);

        if ($kategori !== 0) {
            $form_list = $this->get_data_form_kategori($kategori);
        } else {
            return false;
        }
        return $form_list;
    }

    public function get_all_form()
    {
        $this->db->select('*');
        $this->db->from('mecha_t_kategori_klinik');
        $this->db->join('mecha_m_klinik', 'mecha_t_kategori_klinik.tKlinikId = mecha_m_klinik.klinikId');
        $this->db->where('tKlinikTahun', date("Y"));

        $this->db->order_by('tKlinikId', 'asc');

        $db_res = $this->db->get();
        return $db_res->result();
    }

    public function get_data_form_kategori($id)
    {
        $this->db->select('klinikId, klinikNama');
        $this->db->from('lmmc_t_kategori_klinik');
        $this->db->join('lmmc_m_klinik', 'lmmc_t_kategori_klinik.tKlinikId = lmmc_m_klinik.klinikId');
        $this->db->where('tKategoriId', $id);
        $this->db->where('tKlinikTahun', date("Y"));

        $this->db->order_by('tKlinikId', 'asc');

        $db_res = $this->db->get();
        return $db_res->result();
    }

    // public function get_form()
    // {
    //     $this->db->select('klinikId, klinikNama');
    //     $this->db->from('lmmc_m_klinik');

    //     $r = $this->db->get();
    //     return $r->result();
    // }

    public function get_form_byid($id)
    {
        $this->db->select('*');
        $this->db->from('lmmc_m_klinik');
        $this->db->where('klinikId', $id);

        $r = $this->db->get();
        return $r->row();
    }

    public function get_jalur($id)
    {
        $this->db->select('*');
        $this->db->from('lmmc_m_jalur');
        $this->db->where('jalurId', $id);

        $r = $this->db->get();
        return $r->row();
    }

    public function post_to_array($pd)
    {
        $pdnew = array();
        $i = 0;
        foreach ($pd as $p) {
            $pdnew[$i] = $p;
            $i++;
        }
        return $pdnew;
    }

    public function cek_is_jalur_aktif($id)
    {
        $this->db->select('*');
        $this->db->from('lmmc_m_jalur');
        $this->db->where('jalurId', $id);

        $r = $this->db->get();
        return $r;
    }

    public function masuk_validasi()
    {
        $this->load->library('form_validation');
        $aksi_modul = 'baca';
        $navi = 'masuk_request';

        $this->form_validation->set_rules('noreg', 'Nomor Peserta', 'required|trim');
        $this->form_validation->set_rules('tgl', 'Tanggal Lahir', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $validasi = [
                'status' => 'validasi',
                'noreg' => form_error('noreg'),
                'tgl' => form_error('tgl'),
                'content' => ''
            ];
        } else {
            $date = DateTime::createFromFormat('d-m-Y', $this->input->post('tgl', TRUE));
            $peserta_db = $this->masuk_data_check($this->input->post('noreg', TRUE), $date->format('Y-m-d'));
            if ($peserta_db) {
                $cek_jalur_aktif = $this->cek_is_jalur_aktif($peserta_db->pesertaJalurid);
                if ($cek_jalur_aktif->num_rows() > 0 && $cek_jalur_aktif->row()->jalurIsactive == "1") {
                    $validasi = [
                        'status' => 'OK',
                        'noreg' => '',
                        'tgl' => '',
                        'content' => 'Data ditemukan, akan diarahkan kehalaman beranda'
                    ];
                    $this->session->set_userdata("user", [
                        'noregis' => $peserta_db->pesertaNoregis,
                        'role' => 'peserta',
                    ]);
                } else {
                    $validasi = [
                        'status' => 'validasi',
                        'noreg' => '',
                        'tgl' => '',
                        'content' => 'Jalur pendaftaran anda belum dibuka.'
                    ];
                }
            } else {
                $validasi = [
                    'status' => 'validasi',
                    'noreg' => '',
                    'tgl' => '',
                    'content' => 'Nomor Peserta dan Tanggal Lahir tidak cocok'
                ];
            }
        }
        return $validasi;
    }

    public function masuk_data_check($id, $tgl)
    {
        $this->db->select('*');
        $this->db->from('lmmc_m_peserta');
        $this->db->join('sia_m_prodi', 'lmmc_m_peserta.pesertaProdiid = sia_m_prodi.prodiKode');
        $this->db->where('pesertaNoregis', $id);
        $this->db->where('pesertaTanggallahir', $tgl);


        $db_res = $this->db->get();
        return $db_res->row();
    }

    public function get_hasil_form($id, $klinik)
    {
        $this->db->select('*');
        $this->db->from('lmmc_t_hasilpemeriksaan');
        $this->db->where('hasilPesertaid', $id);
        $this->db->where('hasilKlinikid', $klinik);

        $r = $this->db->get();
        return $r->row();
    }
    public function arr_input()
    {
        $input = [
            'Nama*' => 'pesertaNama',
            'Alamat*' => 'pesertaAlamat',
            'Nomor Handphone**' => 'pesertaNohp',
            'Tempat Lahir*' => 'pesertaTempatlahir',
            'Foto Peserta*' => 'pesertaFoto'
        ];
        return $input;
    }
    public function bio_update()
    {

        $input = $this->arr_input();
        $this->load->library('form_validation');

        foreach ($input as $k => $v) {
            // if ($v !== 'pesertaFoto') {
            //     $this->form_validation->set_rules($v, $k, 'required|trim');
            // }
        }
        $this->form_validation->set_rules('pesertaNama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('pesertaTempatlahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('pesertaNohp', 'Nomor Handphone', 'required|integer|trim');
        $this->form_validation->set_rules('pesertaAlamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('pesertaJK', 'Jenis Kelamin', 'required|trim');


        if ($this->form_validation->run() == FALSE) {
            $validasi['status'] = 'validasi';
            $validasi['pesertaNama'] = form_error('pesertaNama');
            $validasi['pesertaTempatlahir'] = form_error('pesertaTempatlahir');
            $validasi['pesertaNohp'] = form_error('pesertaNohp');
            $validasi['pesertaAlamat'] = form_error('pesertaAlamat');
            $validasi['pesertaJK'] = form_error('pesertaJK');

            $validasi['comment'] = 'Data belum lengkap';
        } else {
            $id = $this->session->userdata('user')['noregis'];
            $upload_status = 1;
            // foreach ($input as $k => $v) {
            //     if ($v !== 'pesertaFoto') {
            //         $data[$v] = $this->input->post($v, TRUE);
            //     }
            // }
            $data = [];
            $data['pesertaNama'] = $this->input->post('pesertaNama', TRUE);
            $data['pesertaTempatlahir'] = $this->input->post('pesertaTempatlahir', TRUE);
            $data['pesertaNohp'] = $this->input->post('pesertaNohp', TRUE);
            $data['pesertaAlamat'] = $this->input->post('pesertaAlamat', TRUE);
            $data['pesertaJK'] = $this->input->post('pesertaJK', TRUE);

            $img_before = $this->config->item('path_foto_peserta') . $this->input->post('imgp');

            if ($_FILES['pesertaFoto']['error'] == 0) {
                $status_upload = $this->upload_image();
                if (!$status_upload['error']) {
                    if ($this->input->post('imgp')) {
                        @unlink($img_before);
                    }

                    $data['pesertaFoto'] = $status_upload['upload_data']['file_name'];
                } else {
                    $validasi['status'] = 'validasi';
                    foreach ($input as $k => $v) {
                        $validasi[$v] = '';
                    }
                    $validasi['comment'] = $status_upload['error'];
                    return $validasi;
                }
            }

            $update = $this->update_hasil($id, $data);

            if ($update !== 0) {
                $validasi['status'] = 'OK';
                foreach ($input as $k => $v) {
                    $validasi[$v] = '';
                }
                $validasi['comment'] = 'Data berhasil diubah';
            } else {
                $validasi['status'] = 'validasi';
                foreach ($input as $k => $v) {
                    $validasi[$v] = '';
                }
                $validasi['comment'] = 'Tidak ada data yang berubah';
            }
        }
        return $validasi;
    }

    public function check($filename)
    {
        $this->load->library('Handle_file', [
            'upload_path' => $this->config->item("path_foto_peserta"),
            'allowed_mimes' => ['image/jpeg', 'image/png', 'application/pdf']
        ], 'handle');
        $this->handle->do_download($filename);
    }

    public function upload_image()
    {
        $aksi_modul = 'tulis';
        $data = ['error' => ''];

        $rs = $this->generateRandomString(10);
        $config['upload_path']          = $this->config->item("path_foto_peserta");
        $config['allowed_types']        = 'jpg|png|jpeg';
        if ($this->config->item('encrypt_name') == TRUE)
            $config['file_name']            = $rs;
        // $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('Handle_file', $config, 'upload');

        if (!$this->upload->do_upload('pesertaFoto')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data  = array(
                'upload_data' => $this->upload->data(),
                'error' => ''
            );
            // return $this->upload->disx`play_errors();
            return $data;
        }
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function update_hasil($id, $data)
    {
        $this->db->where('pesertaNoregis', $id);
        $this->db->update('lmmc_m_peserta', $data);

        $status = $this->db->affected_rows();
        return $status;
    }
}
