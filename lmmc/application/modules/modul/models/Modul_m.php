<?php

class Modul_m extends MY_Model {

    private $table  = 'modul';
    private $key    = 'modul';

    public function rules($update = null) {

        $rules = array(
            array('field' => 'modul', 'label' => 'Nama Modul', 'rules' => 'required|trim'),
        );

        return $rules;
    }

    function relations()
    {
        return [];
    }

    function renderDatatable($nim = NULL)
    {
        $this->db->select('*');
      
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

    function replaceData($id = null)
    {
        $data = $this->input->post(NULL, TRUE);

        if ($id == NULL) 
        {
                $this->db->insert($this->table, $data);

                return ['status' => 'success', 'message' => 'Data berhasil ditambahkan'];
        }
        else
        {
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
}
