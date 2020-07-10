<?php

class Verifikasi_m extends MY_Model {

    private $table      = 'lmmc_m_peserta';
    private $key        = 'pesertaNoregis';

    // const DOKTER        =  ['11201', // PENDIDIKAN DOKTER
    //                         '11706', // ANESTESIOLOGI
    //                         '11707', // ILMU BEDAH
    //                         '11708', // OBSTETRI DAN GINEKOLOGI
    //                         '11709', // PULMONOLOGI
    //                         '11711', // KESEHATAN ANAK
    //                         '11901']; // PROFESI DOKTER

    // const DOKTER_GIGI   = ['12201', // PENDIDIKAN DOKTER GIGI
    //                        '12901']; // PROFESI DOKTER GIGI

    // const EKSAKTA       = '2';
    // const NON_EKSAKTA   = '1';
    // const EKSAKTA_FK    = '3';
    // const EKSAKTA_FKG   = '4';
    // 
    public function __construct() {
        parent::__construct();

        $this->simari = $this->load->database('default', TRUE)->database;
    }

    public function rules($update = null) {

        $rules = array(
            array('field' => 'pesertaNama', 'label' => 'Nama Peserta', 'rules' => 'required|trim'),
            array('field' => 'pesertaJK', 'label' => 'Jenis Kelamin', 'rules' => 'required|trim'),
            array('field' => 'pesertaAlamat', 'label' => 'Alamat', 'rules' => 'required|trim'),
            array('field' => 'pesertaProdiid', 'label' => 'Program Studi', 'rules' => 'required|trim'),
            array('field' => 'pesertaNohp', 'label' => 'Nomor HP', 'rules' => 'required|numeric'),
        );

        if ($update == null) 
        {
            $rules[] = array('field' => 'pesertaNoregis', 'label' => 'Nomor Peserta', 'rules' => 'required|trim');
        }

        return $rules;
    }

    private function cekJalur($pesertaNoregis, $jalurId)
    {
        $this->db->join("{$this->simari}.sia_m_prodi", 'prodiKode = pesertaProdiid');
        $this->db->where('pesertaJalurid', $jalurId);
        $this->db->where('pesertaNoregis', $pesertaNoregis);
        return $this->db->get($this->table)->row();
    }

    private function cekPeserta($pesertaNoregis, $jalurId)
    {
        $this->db->join('lmmc_t_tagihan', 'tagihanNoRegis = pesertaNoregis', 'left');
        $this->db->join("{$this->simari}.sia_m_prodi", 'prodiKode = pesertaProdiid');
        $this->db->where('pesertaJalurid', $jalurId);
        $this->db->where('pesertaNoregis', $pesertaNoregis);
        return $this->db->get($this->table)->row();
    }

    private function cekKategoriKlinik($kategoriId, $tahun)
    {
        $this->db->select('klinikFormnama, klinikNama');
        $this->db->where('tKategoriId', $kategoriId);
        $this->db->where('tKlinikTahun', $tahun);
        $this->db->join('lmmc_m_klinik', 'klinikId = tKlinikId');

        return $this->db->get('lmmc_t_kategori_klinik')->result();
    }

    /**
     * Popup detail peserta
     * @param  [type] $pesertaNoregis [description]
     * @return [type]            [description]
     */
    function getDetailPeserta($pesertaNoregis)
    {
        $_jalurAktif = $this->getJalurActive();

        $data = $this->cekPeserta($pesertaNoregis, @$_jalurAktif->jalurId);
        $cekJalur = $this->cekJalur($pesertaNoregis, @$_jalurAktif->jalurId);

        if (empty($data)) 
        {
            return ['status' => 'error', 'message' => 'Peserta tidak tersedia'];
        }

        if (empty($cekJalur)) 
        {
            return ['status' => 'error', 'message' => 'Peserta Salah Jalur'];
        }

        // if (in_array($data->prodiKode, self::DOKTER)) 
        // {
        //     $this->db->where('biayaKategoriid', self::EKSAKTA_FK);
        // }
        // else if (in_array($data->prodiKode, self::DOKTER_GIGI)) 
        // {
        //     $this->db->where('biayaKategoriid', self::EKSAKTA_FKG);
        // }
        // else if($data->prodiIsEksakta)
        // {
        //     $this->db->where('biayaKategoriid', self::EKSAKTA);
        // }
        // else
        // {
        //     $this->db->where('biayaKategoriid', self::NON_EKSAKTA);
        // }

        $this->db->where('ktgprdProdiId', $data->prodiKode);
        $this->db->where('biayaJalurid', @$_jalurAktif->jalurId);
        $this->db->join('lmmc_t_biaya', 'biayaKategoriid = ktgprdKategoriId');
        $this->db->join('lmmc_r_kategori', 'kategoriId = biayaKategoriid');
        $_kategori = $this->db->get('lmmc_t_kategori_prodi')->row();

        // $this->db->where('biayaJalurid', @$_jalurAktif->jalurId);
        // $this->db->join('lmmc_r_kategori', 'kategoriId = biayaKategoriid');
        // $_kategori = $this->db->get('lmmc_t_biaya')->row();

        if (empty($_kategori)) 
        {
            return ['status' => 'error', 'message' => 'Biaya tes belum di atur'];
        }

        $data->kategoriNama = $_kategori->kategoriNama;
        $data->biayaHarga = $_kategori->biayaHarga;
        $data->pesertaIsbayar = 1;
        $data->klinikForm = $this->cekKategoriKlinik($_kategori->kategoriId, @$_jalurAktif->jalurTahun);

        return ['status' => 'success', 'message' => 'Data berhasil di load', 'data' => $data];
    }

    function setValidasiPeserta($pesertaNoregis, $status)
    {
        date_default_timezone_set('Asia/Kuala_Lumpur');

        $data = array(
            'pesertaIsvalid'            => 1,//$status,
            'pesertaVerifikator'        => $this->session->user['username'],
            'pesertaTanggalverifikasi'  => date('Y-m-d H:i:s'),
        );

        $this->db->where('pesertaNoregis', $pesertaNoregis);
        $this->db->update($this->table, $data);

        return ['status' => 'success', 'message' => 'Data berhasil diverifikasi'];

    }

    function selectProdi()
    {
        $out = [];
        $res = $this->db->get("{$this->simari}.sia_m_prodi")->result();

        $out[''] = NULL;
        foreach ($res as $key => $value) {
            $out[$value->prodiKode] = $value->prodiNamaResmi;
        }

        return $out;
    }

    function selectJK()
    {
        return array(
            // '' => '-- Pilih Jenis Kelamin --',
            'L' => 'Laki-Laki',
            'P' => 'Perempuan',
        );
    }

    function renderDatatable($status = null, $jalurId)
    {
        if ($status !== '') 
        {
            $this->db->where('pesertaIsvalid', $status);
        }

        $this->db->select('*');
        $this->db->where('pesertaJalurid', $jalurId);
        $this->db->join("{$this->simari}.sia_m_prodi", 'pesertaProdiid = prodiKode', 'left');
      
        return $this->db->get($this->table);
    }

    function isLunas($pesertaNoregis)
    {
        $_jalurAktif = $this->getJalurActive();

        $this->db->where('pesertaNoregis', $pesertaNoregis);
        $this->db->where('tagihanIslunas', 1);
        $this->db->where('pesertaJalurid', $_jalurAktif->jalurId);
        $this->db->join('lmmc_t_tagihan', 'tagihanNoRegis = pesertaNoregis');

        return $this->db->get('lmmc_m_peserta')->num_rows();
    }


    /**
     * Ambil 1 data
     * @return object [description]
     */
    public function getDataById($id)
    {
        // $id = $this->db->escape($id);

        $this->db->select('*');
        $this->db->where($this->key, $id);

        return $this->db->get($this->table)->row();
    } 

    public function getProdi()
    {
        $this->db->select('*');
        return $res = $this->db->get("{$this->simari}.sia_m_prodi")->result();
    } 
}
