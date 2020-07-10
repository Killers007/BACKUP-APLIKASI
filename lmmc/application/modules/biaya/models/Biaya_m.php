<?php

class Biaya_m extends MY_Model {

    private $table  = 'lmmc_t_biaya';
    private $key    = 'biayaId';

    public function rules($update = null) {

        $cek_tahun = '';
        if ($update == null) $cek_tahun = '|callback_cek_kategori_tahun';

        $rules = array(
            array('field' => 'biayaHarga', 'label' => 'Harga', 'rules' => 'required|callback_cek_harga'),
            array('field' => 'biayaKategoriid', 'label' => 'Kategori', 'rules' => 'numeric|required'),
            // array('field' => 'biayaTahun', 'label' => 'Tahun', 'rules' => 'required'.$cek_tahun),
        );

        return $rules;
    }

    function selectkategori()
    {
        $out = [];
        $res = $this->db->get('lmmc_r_kategori')->result();

        foreach ($res as $key => $value) {
            $out[$value->kategoriId] = $value->kategoriNama;
        }

        return $out;
    }

    // function selectTahun()
    // {
    //     $out = [];
    //     $this->db->order_by('biayaTahun', 'desc');
    //     $res = $this->db->get($this->table)->result();

    //     $out[date('Y')] = date('Y');
    //     foreach ($res as $key => $value) {
    //         $out[$value->biayaTahun] = $value->biayaTahun;
    //     }

    //     return $out;
    // }
    // 
   
    function renderDatatable($jalurId)
    {
        $this->db->select($this->table.'.*, kt.kategoriNama, kt.kategoriId');
        $this->db->join('lmmc_r_kategori kt', "kategoriId = biayaKategoriid AND biayaJalurid = '{$jalurId}'", 'right');
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
        $_jalurActive = $this->getJalurActive();

        $data['biayaHarga'] = str_replace('.', '', @($data['biayaHarga']));
        $data['biayaJalurid'] = @($_jalurActive->jalurId);

        if ($id == NULL) 
        {
                $this->db->insert($this->table, $data);

                return ['status' => 'success', 'message' => 'Data berhasil ditambahkan'];
        }
        else
        {
            $this->db->where('biayaKategoriid', @($data['biayaKategoriid']));
            $this->db->where('biayaJalurid', @($_jalurActive->jalurId));
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
        $this->db->select('*');
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
