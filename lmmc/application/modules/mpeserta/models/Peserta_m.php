<?php

use Spatie\Async\Pool;

class Peserta_m extends MY_Model {

    private $table  = 'lmmc_m_peserta';
    private $key    = 'pesertaNoregis';

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
            array('field' => 'pesertaNama', 'label' => 'Nama Peserta', 'rules' => 'required|trim'),
            array('field' => 'pesertaJK', 'label' => 'Jenis Kelamin', 'rules' => 'required|trim'),
            array('field' => 'pesertaProdiid', 'label' => 'Program Studi', 'rules' => 'required|trim'),
            array('field' => 'pesertaTanggallahir', 'label' => 'Tanggal Lahir', 'rules' => 'required|trim'),
            array('field' => 'pesertaNohp', 'label' => 'No Hp', 'rules' => 'required|numeric'),
            array('field' => 'pesertaEmail', 'label' => 'Email', 'rules' => 'valid_email'),
            array('field' => 'pesertaNomorKIP', 'label' => 'Nomor KIP', 'rules' => 'trim'),
            // array('field' => 'pesertaAlamat', 'label' => 'Alamat', 'rules' => 'required|trim'),
            // array('field' => 'pesertaNohp', 'label' => 'Nomor HP', 'rules' => 'required|numeric'),
            // array('field' => 'pesertaNoregis', 'label' => 'Nomor Peserta', 'rules' => 'required|trim|callback_cek_no_registrasi'),
        );

        if ($update == null) 
        {
            $rules[] = array('field' => 'pesertaNoregis', 'label' => 'Nomor Peserta', 'rules' => 'required|trim|callback_cek_no_registrasi');
        }

        return $rules;
    }

    function selectProdi()
    {
        $out = [];
        $this->db->group_start();
        $this->db->where('prodiJjarKode', 'S1');
        $this->db->or_where('prodiJjarKode', 'D3');
        $this->db->group_end();
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

    function renderDatatable($_jalurId = NULL)
    {
        $this->db->select('*');
        $this->db->where('pesertaJalurid', $_jalurId);

        $this->db->group_start();
        $this->db->where('prodiJjarKode', 'S1');
        $this->db->or_where('prodiJjarKode', 'D3');
        $this->db->group_end();

        $this->db->join("{$this->simari}.sia_m_prodi", 'pesertaProdiid = prodiKode', 'left');
        $this->db->join("{$this->simari}.sia_m_jurusan", 'jurKode = prodiJurKode');
        $this->db->join("{$this->simari}.sia_m_fakultas", 'jurFakKode = fakKode');
      
        return $this->db->get($this->table);
    }

    function deleteData($id)
    {
        $this->db->trans_begin();
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);

        if ($this->db->trans_status()) 
        {
            $this->db->trans_commit();

            return ['status' => 'success', 'message' => 'Data berhasil dihapus'];
        }
        else
        {
            $this->db->trans_rollback();

            return ['status' => 'error', 'message' => 'Data gagal dihapus'];

        }

    }

    function saveImportPeserta($data = array())
    {
        $this->db->insert_batch('lmmc_m_peserta', $data);

        return $data;
    }

    function replaceData($id = null)
    {
        $data = $this->input->post(NULL, TRUE);
        $data['pesertaImporter'] = $this->session->user['username'];
        $data['pesertaTanggallahir'] = date('Y-m-d', strtotime($data['pesertaTanggallahir']));

        if ($id == NULL) 
        {
            $_jalurId = $this->model->getJalurActive();

            date_default_timezone_set('Asia/Kuala_Lumpur');
            $data['pesertaTanggalinput'] = date('Y-m-d H:i:s');
            $data['pesertaJalurid'] = @($_jalurId->jalurId);
            $this->db->insert($this->table, $data);

            return ['status' => 'success', 'message' => 'Data berhasil ditambahkan'];
        }
        else
        {
            // unset($data['pesertaNoregis']);
            $this->db->where($this->key, $id);
            $this->db->update($this->table, $data);

            return ['status' => 'success', 'message' => 'Data berhasil diperbaharui'];
        }
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

        $res = $this->db->get($this->table)->result();

        if (!empty($res)) 
        {
            return array_column($res, 'pesertaNoregis');
        }

        return [];

    }

    public function getProdi()
    {
       $this->db->group_start();
       $this->db->where('prodiJjarKode', 'S1');
       $this->db->or_where('prodiJjarKode', 'D3');
       $this->db->group_end();
       
       $this->db->select('*');
       return $res = $this->db->get("{$this->simari}.sia_m_prodi")->result();
    } 

    function cekNoRegis($noRegis)
    {
        $_jalurId = $this->model->getJalurActive();

        $this->db->select('*');
        $this->db->where('pesertaNoregis', $noRegis);
        // $this->db->where('pesertaJalurid', $_jalurId->jalurId);

        return $this->db->get($this->table)->row();
    }
}
