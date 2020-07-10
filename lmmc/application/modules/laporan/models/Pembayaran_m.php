<?php

class Pembayaran_m extends MY_Model {

    private $table  = 'lmmc_t_tagihan';
    private $key    = 'tagihanNoRegis';

    public $_jalurId;
    public $kodeLMMC;

    private $simari = '';
    private $h2h    = '';

    public function __construct() {
        parent::__construct();

        $this->simari   = $this->load->database('default', TRUE)->database;
        $this->h2h      = $this->load->database('h2h', TRUE);
        $this->_jalurId = @$this->getJalurActive();
        $this->kodeLMMC = '94';
    }

    public function rules($update = null) {

        $rules = array(
            array('field' => 'waktu_berlaku', 'label' => 'Waktu Berlaku', 'rules' => 'required|callback_cek_tanggal_mulai'),
            array('field' => 'waktu_berakhir', 'label' => 'Waktu Berakhir', 'rules' => 'required'),
        );

        return $rules;
    }

    function renderDatatable($nim = NULL)
    {
        $this->db->select('*');
        $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);
        $this->db->join("lmmc_m_peserta", 'pesertaNoregis = tagihanNoRegis');
        $this->db->join("{$this->simari}.sia_m_prodi", 'prodiKode = tagihanProdikode');
        $this->db->group_by('pesertaNoregis');
        // $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        // $this->db->join('lmmc_m_peserta', 'pesertaNoregis = tagihanNoRegis', 'right');
        // $this->db->join("{$this->simari}.sia_m_prodi", 'prodiKode = pesertaProdiid');

        return $this->db->get($this->table);
    }

    function getBiaya()
    {
        $this->db->join('lmmc_r_kategori', "kategoriId = biayaKategoriid and biayaJalurid = {$this->_jalurId->jalurId}", 'right');
        return $this->db->get('lmmc_t_biaya')->result();
    }

    function isBiayaTidakTerisi()
    {
        $this->db->where('biayaId', null);
        $this->db->join('lmmc_r_kategori', "kategoriId = biayaKategoriid and biayaJalurid = {$this->_jalurId->jalurId}", 'right');

        return $this->db->get('lmmc_t_biaya')->num_rows();
    }

    function isTagihan()
    {
        $this->db->select('tagihanNoRegis');;
        $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);
        $_querytagihan = $this->db->get_compiled_select('lmmc_t_tagihan');

        $this->db->where_not_in("pesertaNoregis", $_querytagihan, FALSE);
        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        
        $_num = $this->db->get('lmmc_m_peserta')->num_rows();

        return $_num > 0 ? false : true;
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
}
