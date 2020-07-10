<?php

class Panduan_m extends MY_Model {

    private $table  = 'lmmc_m_panduan';
    private $key    = 'panduanId';

    public $imageLocation = NULL;

    public function __construct() 
    {
        parent::__construct();

        $this->imageLocation = $this->config->item("path_foto_panduan");
    }

    public function rules($update = null) {

        $rules = array(
            // array('field' => 'panduanTahun', 'label' => 'Tahun Panduan', 'rules' => 'required|numeric'),
            array('field' => 'panduanVersi', 'label' => 'Versi panduan', 'rules' => 'required|numeric|callback_cek_panduan'),
            array('field' => 'panduanDeskripsi', 'label' => 'Deskripsi Panduan', 'rules' => 'required'),
        );

        return $rules;
    }

    function selectKlinik()
    {
        $out = [];
        $res = $this->db->get('lmmc_m_klinik')->result();

        $out[''] = '';
        foreach ($res as $key => $value) {
            $out[$value->klinikId] = $value->klinikNama;
        }

        return $out;
    }

    function renderDatatable()
    {
        $this->db->select($this->table.'.*');
        $this->db->select("CONCAT(panduanDeskripsi) as panduanDeskripsi");
      
        return $this->db->get($this->table);
    }

    function deleteData($id)
    {
        $this->db->trans_begin();
        $fill = $this->getDataById($id);

        $this->deleteImage($id);
        $this->db->where('panduanId', $id);
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


    function deleteImage($id)
    {
        if ($id != null) 
        {
            $data = $this->getDataById($id);
            
            $imageLocation = $this->imageLocation.$data->panduanGambar;

            if (file_exists($imageLocation)) {
                unlink($imageLocation);
            }
        }

    }

    function replaceData($id = null, $imageName)
    {
        $data = $this->input->post(null, TRUE);
        
        if ($imageName != null) {

            $this->deleteImage($id);
            
            $data['panduanGambar'] = $imageName;
        }

        if ($id == NULL) 
        {
            $this->db->insert($this->table, $data);

            return ['status' => 'success', 'message' => 'Data berhasil ditambahkan'];

        }
        else
        {
            $this->db->where($this->key, $id);
            $this->db->update($this->table, $data);

            return ['status' => 'success', 'message' => 'Data berhasil di perbaharui'];
        }
    }


    /**
     * Ambil 1 data
     * @return object [description]
     */
    public function getDataById($id)
    {
        $this->db->select('*');
        $this->db->where($this->key, $id);

        return $this->db->get($this->table)->row();
    } 

    public function cek_panduan($tahun, $versi, $panduanId)
    {
        $this->db->where_not_in('panduanId', $panduanId);
        // $this->db->where('panduanTahun', $tahun);
        $this->db->where('panduanVersi', $versi);

        return $this->db->get($this->table)->num_rows();
    } 
}
