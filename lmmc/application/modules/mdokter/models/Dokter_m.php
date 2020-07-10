<?php

class Dokter_m extends MY_Model {

    private $table  = 'lmmc_m_dokter';
    private $key    = 'dokterNip';

    public function rules($update = null) {

        $rules = array(
            array('field' => 'dokterNama', 'label' => 'Nama Dokter', 'rules' => 'required|trim'),
            array('field' => 'dokterNip', 'label' => 'NIP Dokter', 'rules' => 'required|numeric|trim|callback_cek_nip'),
        );

        return $rules;
    }

    function renderDatatable($nim = NULL)
    {
        $this->db->select('dokterNama, dokterNip');
      
        return $this->db->get($this->table);
    }

    function resetPassword($nip = NULL)
    {
        $nip = urldecode($nip);

        $this->load->library('Lmmc');
        $data['dokterPassword'] = $this->lmmc->hashPassword($nip);

        $this->db->where('dokterNip', $nip);
        $this->db->update($this->table, $data);

        return ['status' => 'success', 'message' => 'Password berhasil direset'];
    }

    function deleteData($id)
    {
        $id = urldecode($id);
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
        $id = urldecode($id);

        $this->load->library('Lmmc');
        $data = $this->input->post(NULL, TRUE);

        if ($id == NULL) 
        {
            $data['dokterPassword'] = $this->lmmc->hashPassword($data['dokterNip']);
            $this->db->insert($this->table, $data);

            return ['status' => 'success', 'message' => 'Data berhasil ditambahkan'];
        }
        else
        {
            // $data['dokterPassword'] = $this->lmmc->hashPassword($data['dokterNip']);
            $this->db->where($this->key, $id);
            $this->db->update($this->table, $data);

            return ['status' => 'success', 'message' => 'Data berhasil diperbarui'];
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
