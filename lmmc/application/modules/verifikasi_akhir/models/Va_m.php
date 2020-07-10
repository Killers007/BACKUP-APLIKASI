<?php

/**
 * Description of MY_Controller
 *
 * @author azmi.adhani@ulm.ac.id
 */
class Va_m extends MY_Model
{
    public function get_hasil_form($id)
    {
        $this->db->select('*');
        $this->db->from('lmmc_t_hasilpemeriksaan');
        $this->db->where('hasilBarcode', $id);
        $r = $this->db->get();
        return $r->row();
    }

    public function val_hasil()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('hasilBarcode', 'Barcode', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $validasi = [
                'status' => 'validasi',
                'hasilBarcode' => form_error('hasilBarcode'),
                'content' => ''
            ];
        } else {
            $klinreg = $this->input->post('hasilBarcode');

            $hasil = $this->get_hasil($klinreg);
            if ($hasil) {
                $validasi = [
                    'status' => 'OK',
                    'hasilBarcode' => $hasil,
                    'content' => 'Data ditemukan.'
                ];
            } else {
                $validasi = [
                    'status' => 'validasi',
                    'hasilBarcode' => 'Data tidak ditemukan.',
                    'content' => 'Data tidak ditemukan.'
                ];
            }
        }
        return $validasi;
    }

    public function val_update_hasil()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('klindet', 'Status', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('hasilid', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('keterangan_v', 'Keterangan Verifikasi', 'required|trim');


        if ($this->form_validation->run() == FALSE) {
            $validasi = [
                'status' => 'validasi',
                'klindet' => form_error('klindet'),
                'keterangan' => form_error('keterangan'),
                'hasilid' => form_error('hasilid'),
                'keterangan_v' => form_error('keterangan_v'),
                'hasilBarcode' => ''
            ];
        } else {
            $id = $this->input->post('hasilid');
            $db_get = $this->get_hasil_by($id);

            $data = [
                'hasilIsVerified' => '1',
                'hasilKnkdtid' => $this->input->post('klindet'),
                'hasilKetVerifikasi' => $this->input->post('keterangan_v'),
                'hasilCatatan' => $this->input->post('keterangan'),
                'hasilTglVerifikasi' => date('Y/m/d H:i:s'),
                'hasilNipVerifikator' => $this->session->userdata('user')['username'],
            ];

            if ($db_get->hasilKnkdtid !== $this->input->post('klindet')) {
                $data['hasilHistory'] = $db_get->hasilKnkdtid;
            }

            $update = $this->update_hasil($id, $data);

            if ($update !== 0) {
                $validasi = [
                    'status' => 'OK',
                    'klindet' => '',
                    'keterangan' => '',
                    'hasilid' => '',
                    'keterangan_v' => '',
                    'hasilBarcode' => 'Verifikasi berhasil!'
                ];
            } else {
                $validasi = [
                    'status' => 'validasi',
                    'klindet' => '',
                    'keterangan' => '',
                    'hasilid' => '',
                    'keterangan_v' => '',
                    'hasilBarcode' => 'Tidak ada data yang berubah'
                ];
            }
        }
        return $validasi;
    }

    public function update_hasil($id, $data)
    {
        $this->db->where('hasilId', $id);
        $this->db->update('lmmc_t_hasilpemeriksaan', $data);

        $status = $this->db->affected_rows();
        return $status;
    }

    public function get_hasil_by($id)
    {
        $this->db->select('*');
        $this->db->from('lmmc_t_hasilpemeriksaan');
        $this->db->where('hasilId', $id);
        $res = $this->db->get()->row();
        return $res;
    }

    public function get_tahun()
    {
        $this->db->select('jalurTahun');
        $this->db->from('lmmc_m_jalur');
        $this->db->where('jalurIsactive', '1');

        $db_tahun = $this->db->get()->row();
        return $db_tahun->jalurTahun;
    }
    public function get_hasil($id)
    {
        $dt = explode('-LMMC-', $id);
        if (count($dt) == 2) {
            $c_kli = $this->check_klinik($dt);
            $c_pes = $this->check_peserta($dt);
            if ($c_pes->num_rows() > 0) {
                $kategori = $this->get_kategori($c_pes->row());
                $klinikList = $this->get_kategori_klinik($kategori);
                $validasi_klinik = 0;

                foreach ($klinikList as $kl) {
                    if ($kl->tKlinikId == $dt[0]) {
                        $validasi_klinik = 1;
                    }
                }

                if ($c_kli > 0 && $c_pes->num_rows() > 0 && $validasi_klinik == 1) {
                    $this->db->select('*');
                    $this->db->from('lmmc_t_hasilpemeriksaan');
                    $this->db->join('lmmc_m_klinik', 'lmmc_t_hasilpemeriksaan.hasilKlinikid = lmmc_m_klinik.klinikId');
                    $this->db->join('lmmc_m_peserta', 'lmmc_t_hasilpemeriksaan.hasilPesertaid = lmmc_m_peserta.pesertaNoregis');
                    $this->db->join('sia_m_prodi', 'lmmc_m_peserta.pesertaProdiid = sia_m_prodi.prodiKode');

                    $this->db->where('hasilKlinikid', $dt[0]);
                    $this->db->where('hasilPesertaid', $dt[1]);

                    $db_res = $this->db->get();
                    if ($db_res->num_rows() > 0) {
                        return $db_res->row();
                    } else {

                        $object = [
                            'hasilPesertaid' => $dt[1],
                            'hasilKlinikid' => $dt[0],
                            'hasilTanggal' => date('Y/m/d H:i:s')
                        ];
                        $insert = $this->db->insert('lmmc_t_hasilpemeriksaan', $object);
                        if ($this->db->affected_rows() > 0) {
                            $this->db->select('*');
                            $this->db->from('lmmc_t_hasilpemeriksaan');
                            $this->db->join('lmmc_m_klinik', 'lmmc_t_hasilpemeriksaan.hasilKlinikid = lmmc_m_klinik.klinikId');
                            $this->db->join('lmmc_m_peserta', 'lmmc_t_hasilpemeriksaan.hasilPesertaid = lmmc_m_peserta.pesertaNoregis');
                            $this->db->join('sia_m_prodi', 'lmmc_m_peserta.pesertaProdiid = sia_m_prodi.prodiKode');

                            $this->db->where('hasilKlinikid', $dt[0]);
                            $this->db->where('hasilPesertaid', $dt[1]);

                            $db_res = $this->db->get();
                            return $db_res->row();
                        } else {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }

            // $db_res = (object) array_merge((array) $db_k, (array) $db_pp);

            // return $db_res;
        } else {
            return false;
        }
    }

    public function check_klinik($dt)
    {
        $tahun = $this->get_tahun();

        $this->db->select('tKlinikId');
        $this->db->from('lmmc_t_kategori_klinik');

        $this->db->where('tKlinikId', $dt[0]);
        $this->db->where('tKlinikTahun', $tahun);

        $db_k = $this->db->get()->num_rows();
        return $db_k;
    }

    public function check_peserta($dt)
    {
        $this->db->select('*');
        $this->db->from('lmmc_m_peserta');
        $this->db->join('sia_m_prodi', 'lmmc_m_peserta.pesertaProdiid = sia_m_prodi.prodiKode');

        $this->db->where('pesertaNoregis', $dt[1]);

        $db_pp = $this->db->get();

        return $db_pp;
    }

    public function get_kategori_klinik($id)
    {
        $this->db->select('*');
        $this->db->from('lmmc_t_kategori_klinik');

        $this->db->where('tKategoriId', $id);

        $debe = $this->db->get();

        return $debe->result();
    }

    public function get_data_kategori($id)
    {
        $this->db->select('*');
        $this->db->from('lmmc_r_kategori');
        $this->db->where('kategoriId', $id);

        $db_res = $this->db->get();
        return $db_res->row();
    }

    public function get_klinik_detail($id)
    {
        $this->db->select('*');
        $this->db->from('lmmc_m_klinikdetil');
        $this->db->where('knkdtKlinikid', $id);
        $this->db->order_by('knkdtKriteria', 'asc');

        $db_res = $this->db->get();
        return $db_res->result();
    }

    public function pesertaTemplate($data)
    {
        $jk = '';
        if ($data->pesertaJK == 'L') {
            $jk = 'Laki-laki';
        } else if ($data->pesertaJK == 'P') {
            $jk = 'Perempuan';
        }
        $label = [
            'Program Studi',
            'No HP',
            'Jenis Kelamin',
            'Kategori',
        ];
        $kategoriId = $this->get_kategori($data);
        $kategori = $this->get_data_kategori($kategoriId);
        $labelValue = [
            $data->prodiNamaResmi,
            $data->pesertaNohp,
            $jk,
            $kategori->kategoriNama,
        ];

        $html = '        
        <header class="panel-heading bg-light no-border mar-bot" style="background-color:#fff">
            <div class="col-md-12 mar-bot">
                <input type="hidden" id="hasilid" name="hasilid" value="' . $data->hasilId . '">
                <a href="#" class="pull-left thumb-md avatar b-3x m-r">
                    <img src="' . base_url('verifikasi_akhir/image/path_foto_peserta/') . '/';
        if ($data->pesertaFoto) {
            $html .= $data->pesertaFoto;
        } else {
            $html .= 'default.png';
        }
        $html .= '"> </a>
                <div class="clear">
                    <br>
                    
                    <div class="col-sm-12 ">
                        <div class="h3 m-t-xs m-b-xs">
                            <b>' . $data->pesertaNama . ' </b>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 ">
                        <small class="text-muted"><b>' . $data->pesertaNoregis . '</b></small>
                    </div>
                </div>
            </div>
        </header>
        <br>
        <div class="list-group no-radius alt" >
            <div class="col-md-12 mar-bot">
                <label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-9 ">';
        if ($data->hasilKnkdtid !== '0') {
            $html .= ' <input type="hidden" id="klindet" name="klindet" value="' . $data->hasilKnkdtid . '">';
        } else {
            $html .= ' <input type="hidden" id="klindet" name="klindet" value="">';
        }

        $klinikDetil = $this->get_klinik_detail($data->klinikId);
        $kriteria = self::kriteria;
        foreach ($klinikDetil as $kd) {
            if ($data->hasilKnkdtid == $kd->knkdtId) {
                foreach ($kriteria as $key => $value) {

                    if ($key == $kd->knkdtKriteria) {
                        $html .= '  
                        <a href="#" class="btn btn-s-md sehat-status btn-' . $value . '" onclick="upd_hasil_status(\'' . $kd->knkdtId . '\',\'' . $kd->knkdtKriteria . '\')" id="sehat-' . $kd->knkdtId . '" name="sehat_status"><span id="checkIcon" class="fa  fa-check"></span><b>' . $kd->knkdtNamahasil . '</b></a>
                        ';
                    }
                }
            } else {
                $html .= '  
                <a href="#" class="btn btn-s-md sehat-status btn-default" onclick="upd_hasil_status(\'' . $kd->knkdtId . '\',\'' . $kd->knkdtKriteria . '\')" id="sehat-' . $kd->knkdtId . '" name="sehat_status"><b>' . $kd->knkdtNamahasil . '</b></a>
            ';
            }
        }

        $html .= ' 
                <div id="klindet-v" name="inVal"></div>

                </div>
            </div>
        ';

        // Input Keterangan
        $html .= '
            <div class="col-md-12 mar-bot">
                <label class="col-sm-3 control-label">Keterangan</label>
                <b>
                    <div class="col-sm-9">';
        if ($data->hasilCatatan !== NULL) {
            $html .= '<input type="text" id="keterangan" name="keterangan" class="btn form-control" style="text-align: left" placeholder="Keterangan Hasil Pemeriksaan" value="' . $data->hasilCatatan . '">';
        } else {
            $html .= '<input type="text" id="keterangan" name="keterangan" class="btn form-control" style="text-align: left" placeholder="Keterangan Hasil Pemeriksaan">';
        }

        $html .= '<div id="keterangan-v" name="inVal" style="margin-bottom:0px !important;"></div>
                    </div>
                </b>
            </div>
        ';

        $i = 0;
        foreach ($label as $l) {
            $html .= '
                <div class="col-md-12 mar-bot">
                    <label class="col-sm-3 control-label">' . $l . '</label>
                    <b>
                        <div class="col-sm-9 control-label" style="text-align: left;">';
            if ($labelValue[$i]) {
                $html .= $labelValue[$i];
            } else {
                $html .= '<bv style="color:red">-</bv>';
            }
            $html .= '   </div>
                    </b>
                </div>
            ';
            $i++;
        }
        // Input Keterangan
        $html .= '
            <div class="col-md-12 mar-bot">
                <label class="col-sm-3 control-label">Keterangan Verifikator</label>
                <b>
                    <div class="col-sm-9">';
        if ($data->hasilKetVerifikasi !== NULL) {
            $html .= '<input type="text" id="keterangan_v" name="keterangan_v" class="btn form-control" style="text-align: left" placeholder="Keterangan Hasil Pemeriksaan" value="' . $data->hasilKetVerifikasi . '">';
        } else {
            $html .= '<input type="text" id="keterangan_v" name="keterangan_v" class="btn form-control" style="text-align: left" placeholder="Keterangan Hasil Pemeriksaan">';
        }

        $html .= '<div id="keterangan_v-v" name="inVal" style="margin-bottom:0px !important;"></div>
                    </div>
                </b>
            </div>
        ';

        // Input Keterangan

        $html .= '
        <div class="col-md-12">&nbsp</div>
        <div class="col-md-12" > 
            <div class="btn-group btn-group-justified" style="padding: 0 15px;"> 
                <a href="#" class="btn btn-success" onclick="updHasil()" style="background-color:#1BB399 !important;border-color:#1BB399 !important;">
                    <span class="fa fa-check-square-o"></span>&nbsp    
                    <b>Verifikasi</b>
                </a>
            </div> 
        </div>
        ';


        $html .= '
            </div>
            <script>
            $("[id=keterangan]").keypress(function(e) {
                if (e.which == 13) {
                    updHasil();
                    return false; //<---- Add this line
                }
            });
            </script>
        ';


        return $html;
    }

    public function sementara()
    {
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
}
