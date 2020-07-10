<?php

class Kategori_prodi_m extends MY_Model {

    private $table  = 'lmmc_t_kategori_prodi';
    private $key    = 'ktgprdId';

    public $_jalurId;

     public function __construct() {
        parent::__construct();
    }    

    public function rules($update = null) {

        $rules = array(
            array('field' => 'ktgprdKategoriId', 'label' => 'Kategori', 'rules' => 'required'),
            array('field' => 'ktgprdProdiId[]', 'label' => 'Program Studi', 'rules' => 'required'),
        );

        return $rules;
    }

    function selectKategori()
    {
        $out = [];
        $res = $this->db->get('lmmc_r_kategori')->result();

        $out[''] = '';
        foreach ($res as $key => $value) {
            $out[$value->kategoriId] = $value->kategoriNama;
        }

        return $out;
    }

    function getListProdi($kategoriId)
    {

        $this->db->select('prodiKode');
        $this->db->where('ktgprdKategoriId', $kategoriId);
        $this->db->join("sia_m_prodi", "ktgprdProdiId = prodiKode", 'right');
        $query =$this->db->get_compiled_select('lmmc_t_kategori_prodi');

        $this->db->where_in('ktgprdProdiId', $query, FALSE);
        $this->db->or_where('ktgprdProdiId', NULL);
       
        $this->db->group_start();
        $this->db->where('prodiJjarKode', 'S1');
        $this->db->or_where('prodiJjarKode', 'D3');
        $this->db->group_end();
       
        $this->db->join("sia_m_prodi", "ktgprdProdiId = prodiKode", 'right');
        $this->db->join("sia_m_jurusan", 'jurKode = prodiJurKode');
        $this->db->join("sia_m_fakultas", 'jurFakKode = fakKode');

        $res =$this->db->get('lmmc_t_kategori_prodi')->result();

        return $res;
    }

    function listProdi($kategoriId)
    {
        $this->db->select('prodiNamaResmi, prodiJjarKode, fakNamaResmi');
        $this->db->where('ktgprdKategoriId', $kategoriId);
        $this->db->join("sia_m_prodi", 'ktgprdProdiId = prodiKode');
        $this->db->join("sia_m_jurusan", 'jurKode = prodiJurKode');
        $this->db->join("sia_m_fakultas", 'jurFakKode = fakKode');

        return $this->db->get($this->table)->result();
    }

    function renderDatatable($tahun)
    {
        $this->db->join('lmmc_r_kategori', 'kategoriId = ktgprdId', 'right');
        return $this->db->get($this->table);
    }

    function deleteData($id)
    {
        $this->db->trans_begin();

        $this->db->where('ktgprdKategoriId', $id);
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

    function replaceData($id = null)
    {
        $data = $this->input->post(NULL, TRUE);
        $kategoriId = $data['ktgprdKategoriId'];

        $this->db->where('ktgprdKategoriId', $kategoriId);
        $this->db->delete($this->table);

        $_insert = [];
        foreach ($data['ktgprdProdiId'] as $key => $value) {
            $_insert[] = array(
                'ktgprdKategoriId' => $kategoriId,
                'ktgprdProdiId' => $value,
            );
        }

        $this->db->insert_batch($this->table, $_insert);

        return ['status' => 'success', 'message' => 'Prodi berhasil dikelola'];
    }


    /**
     * Ambil 1 data
     * @return object [description]
     */
    public function getDataById($id)
    {
        $this->db->select('*');
        $this->db->join('lmmc_m_klinik', 'klinikId = jagaKlinikid');
        $this->db->where($this->key, $id);

        return $this->db->get($this->table)->row();
    } 

    public function cek_kategori_tahun($tahun, $kategoriId)
    {
        $this->db->where('biayaTahun', $tahun);
        $this->db->where('biayaKategoriid', $kategoriId);

        return $this->db->get($this->table)->num_rows();
    } 
}
