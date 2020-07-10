<?php

class Kategori_m extends MY_Model {

    private $table  = 'lmmc_m_kategori';
    private $key    = 'kategoriId';

    public function rules($update = null) {

        $rules = array(
            array('field' => 'kategori', 'label' => 'Nama Dokter', 'rules' => 'required|trim'),
        );

        return $rules;
    }

    function selectProvinsi()
    {
        $out = [];
        $res = $this->db->get('provinsi')->result();

        foreach ($res as $key => $value) {
            $out[$value->id_prov] = $value->nama_prov;
        }

        return $out;
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
        // $this->db->select('TIMESTAMPDIFF(DAY, diklatTanggalMulai, diklatTanggalSelesai)*20 as jam_pelatihan');
        $this->db->select("(SELECT SUM(materiJam) FROM diklat_m_materi_pelatihan where materiDiklatId = diklatId) as jam_pelatihan");
        $this->db->where($this->key, $id);

        return $this->db->get($this->table)->row();
    } 
}
