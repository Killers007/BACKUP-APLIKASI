<?php


class Dokter_m extends MY_Model
{
    private $_jalurId = '';
    private $simari = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Lmmc');
        $this->simari = $this->load->database('default', TRUE)->database;

        $this->_jalurId = $this->getJalurActive();

    }

     public function rules($update = null) {

        $rules = array(
            array('field' => 'username', 'label' => 'NIP', 'rules' => 'required'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'required'),
        );

        return $rules;
    }

    public function rulesPwd($update = null) {

        $rules = array(
            array('field' => 'password', 'label' => 'Password Lama', 'rules' => 'required|callback_cek_password_lama'),
            array('field' => 'new', 'label' => 'Password Baru', 'rules' => 'required'),
            array('field' => 'retype', 'label' => 'Ulangi Password', 'rules' => 'required|matches[new]'),
        );

        return $rules;
    }

    function getJadwal()
    {
        $this->db->order_by('jagaTanggal', 'ASC');
        $this->db->where('jagaJalurid', @$this->_jalurId->jalurId);
        $this->db->where('jagaDokterid', $this->session->user['username']);

        $this->db->join('lmmc_m_klinik', 'klinikId = jagaKlinikid');
        return $this->db->get('lmmc_t_jagaklinik')->result();
    }

    function getHasil()
    {
        $jalurId = @$this->_jalurId->jalurId;

        $klinik = $this->db->get('lmmc_m_klinik')->result();

        $res = [];
        foreach ($klinik as $key => $value) 
        {
            $jum_peserta = 0;
            
            $this->db->where('tKlinikId', $value->klinikId);
            $this->db->where('tKlinikTahun', @$this->_jalurId->jalurTahun);
            $this->db->join('lmmc_m_klinik', 'klinikId = tKlinikId');
            $kategori = $this->db->get('lmmc_t_kategori_klinik')->result();

            foreach ($kategori as $values) 
            {
                $kategoriId = $values->tKategoriId;

                // if ($kategoriId == self::EKSAKTA_FK) 
                // {
                //     $this->db->where_in('prodiKode', self::DOKTER);
                // }
                // else if ($kategoriId == self::EKSAKTA_FKG) 
                // {
                //     $this->db->where_in('prodiKode', self::DOKTER_GIGI);
                // }
                // else if($kategoriId == self::EKSAKTA)
                // {
                //     $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
                //     $this->db->where_not_in('prodiKode', $_dokterCombine);
                //     $this->db->where('prodiIsEksakta', '1');
                // }
                // else
                // {
                //     $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
                //     $this->db->where_not_in('prodiKode', $_dokterCombine);
                //     $this->db->where('prodiIsEksakta', '0');
                // }

                $this->db->where('ktgprdKategoriId', $kategoriId);
                $this->db->select('ktgprdProdiId');
                $queryPeserta = $this->db->get_compiled_select("lmmc_t_kategori_prodi");

                $this->db->where_in('pesertaProdiid', $queryPeserta, FALSE);
                $this->db->from("{$this->simari}.sia_m_fakultas");
                $this->db->join("{$this->simari}.sia_m_jurusan", 'jurFakKode = fakKode');
                $this->db->join("{$this->simari}.sia_m_prodi", "prodiJurKode = {$this->simari}.sia_m_jurusan.jurKode");
                $this->db->join("lmmc_m_peserta", "prodiKode = pesertaProdiid");
                $jum_peserta += $this->db->get()->num_rows();
            }

            $this->db->where('hasilKlinikid', $value->klinikId);
            $this->db->where('jagaDokterid', $this->session->user['username']);
            $this->db->where('jagaJalurid', $jalurId);
            $this->db->join('lmmc_t_jagaklinik', "hasilJagaId = jagaId");
            $jum_hasil = $this->db->get('lmmc_t_hasilpemeriksaan')->num_rows();

            // $jum_hasil = 1;

            $res[] = (object)array(
                'klinikNama' => $value->klinikNama,
                'jum_hasil' => $jum_hasil,
                'jum_peserta' => $jum_peserta,
            );
        }

        return $res;
    }

    function gantiPassword($password)
    {
        $this->load->library('Lmmc');
        $password = $this->lmmc->hashPassword($password);

        $this->db->where('dokterNip', $this->session->user['username']);

        $this->db->update('lmmc_m_dokter', ['dokterPassword' => $password]);

        return ['status' => 'success', 'message' => 'Password berhasil diganti'];
    }

    function cekPasswordLama($password)
    {
        $this->load->library('Lmmc');
        $password = $this->lmmc->hashPassword($password);

        $this->db->where('dokterPassword', $password);
        $this->db->where('dokterNip', $this->session->user['username']);

        return $this->db->get('lmmc_m_dokter')->num_rows();
    }

    function cekLogin($username, $password)
    {
        $password = $this->lmmc->hashPassword($password);

        $this->db->where('dokterNip', $username);
        $this->db->where('dokterPassword', $password);
        $data = $this->db->get('lmmc_m_dokter');

        if ($data->num_rows()) 
        {
            $dokter =  $data->row();

            $this->session->set_userdata('user', [
                'username'=> $dokter->dokterNip,
                'nama'=> $dokter->dokterNama,
                'role'=> 'dokter',
            ]);

            return ['status' => 'success', 'message' => 'Login Berhasil'];
        }
        else
        {
            return ['status' => 'error', 'message' => 'Username atau password salah'];
        }
    }

  
}
