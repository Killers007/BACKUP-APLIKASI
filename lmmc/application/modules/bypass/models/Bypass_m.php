<?php

class Bypass_m extends MY_Model {

    private $table  = 'lmmc_t_bypass';
    private $key    = 'bypassId';

    private $simari;

    public $imageLocation = NULL;
    public $imagePeserta = NULL;

    public function __construct() {
        parent::__construct();

        $this->simari = $this->load->database('default', TRUE)->database;

        $this->imageLocation = $this->config->item("path_temp_excel");
        $this->imagePeserta = $this->config->item("path_foto_peserta");
    }

    public function rules($update = null) {

        $rules = array(
            array('field' => 'noRegis', 'label' => 'Nomor Peserta', 'rules' => 'required|trim|callback_cek_no_registrasi'),
            // array('field' => 'noRegis', 'label' => 'Nomor Peserta', 'rules' => 'required|trim'),
            array('field' => 'alasanBypass', 'label' => 'Alasan Bypass', 'rules' => 'required|trim'),
            array('field' => 'noTagihan', 'label' => 'Nomor tagihan', 'rules' => 'required|trim'),
        );

        return $rules;
    }

    function renderDatatable($_jalurId = NULL)
    {
        $this->db->select('*');
        $this->db->where('pesertaJalurid', $_jalurId);

        $this->db->join("{$this->simari}.lmmc_m_peserta", 'pesertaNoregis = bypassNoRegis');
        $this->db->join("{$this->simari}.lmmc_t_tagihan", 'pesertaNoregis = tagihanNoRegis');
        $this->db->join("{$this->simari}.sia_m_prodi", 'pesertaProdiid = prodiKode');
        $this->db->join("{$this->simari}.sia_m_jurusan", 'jurKode = prodiJurKode');
        $this->db->join("{$this->simari}.sia_m_fakultas", 'jurFakKode = fakKode');
      
        return $this->db->get($this->table);
    }

    function saveImportPeserta($data = array())
    {
        $this->db->insert_batch('lmmc_t_bypass', $data);

        return $data;
    }

    function replaceData($id = null)
    {
        $data = [];
        $data['bypassUsername'] = $this->session->user['username'];
        $data['bypassNoRegis'] = $this->input->post('noRegis', TRUE);
        $data['bypassAlasan'] = $this->input->post('alasanBypass', TRUE);

        if ($this->isLunas($data['bypassNoRegis'])) 
        {
            return ['status' => 'success', 'message' => 'Tagihan Sudah Lunas'];
        }

        if (!$this->db->get_where($this->table, ['bypassNoRegis' => $data['bypassNoRegis']])->num_rows()) 
        {
            $this->db->insert($this->table, $data);

            $this->bypassPembayaran($data['bypassNoRegis']);

            return ['status' => 'success', 'message' => 'Tagihan Berhasil Di Bypass'];
        }
        else
        {
            return ['status' => 'info', 'message' => 'Tagihan Sudah Di Bypass Sebelumnya'];
        }
    }

    function isLunas($noRegis)
    {
        $this->db->where('tagihanNoRegis', $noRegis);
        return $this->db->get_where('lmmc_t_tagihan', ['tagihanIslunas' => 1])->num_rows();
    }

    function bypassPembayaran($noRegis)
    {
        $this->db->where('tagihanNoRegis', $noRegis);
        $this->db->update('lmmc_t_tagihan', ['tagihanIslunas' => 1]);
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

    public function arrNoRegis()
    {
        // $_jalurId = $this->model->getJalurActive();

        $this->db->select('*');
        // $this->db->where('pesertaJalurid', ($_jalurId->jalurId));

        $res = $this->db->get('lmmc_t_tagihan')->result();

        if (!empty($res)) 
        {
            return array_column($res, 'tagihanNoRegis');
        }

        return [];

    }

    function cariNoRegis($id)
    {
        $this->db->where('tagihanNoRegis', $id);

        $this->db->join("{$this->simari}.lmmc_m_peserta", 'pesertaNoregis = tagihanNoRegis');
        $this->db->join("{$this->simari}.sia_m_prodi", 'pesertaProdiid = prodiKode');
        $this->db->join("{$this->simari}.sia_m_jurusan", 'jurKode = prodiJurKode');
        $this->db->join("{$this->simari}.sia_m_fakultas", 'jurFakKode = fakKode');

        $data = $this->db->get('lmmc_t_tagihan')->row();

        if (empty($data)) 
        {
            return ['status' => 'error', 'message' => 'Data Tidak Ditemukan, Tagihan belum digenerate'];
        }

        return ['status' => 'success', 'message' => 'Data Ditemukan', 'data' => $data];

    }

    public function getTagihan()
    {
        $this->db->select('*');

        $_jalurId = $this->model->getJalurActive();
        $this->db->where('tagihanJalurId', $_jalurId->jalurId);
        $this->db->join('lmmc_m_peserta', 'pesertaNoregis = tagihanNoRegis');
        return $res = $this->db->get("lmmc_t_tagihan")->result();
    } 

    function cekNoRegis($noRegis)
    {
        $_jalurId = $this->model->getJalurActive();

        $this->db->select('*');
        $this->db->where('tagihanNoRegis', $noRegis);
        // $this->db->where('pesertaJalurid', $_jalurId->jalurId);

        return $this->db->get('lmmc_t_tagihan')->row();
    }
}
