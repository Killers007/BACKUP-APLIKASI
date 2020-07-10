<?php

class Klinik_m extends MY_Model {

    private $table  = 'lmmc_m_klinik';
    private $key    = 'klinikId';

    public function rules($update = null) {

        $rules = array(
            array('field' => 'klinikNama', 'label' => 'Nama Klinik', 'rules' => 'required'),
            array('field' => 'klinikFormnama', 'label' => 'Nama Form', 'rules' => 'required'),
            array('field' => 'hasil', 'label' => 'Hasil Pemeriksaan', 'rules' => 'callback_cek_kriteria'),
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

    function renderDatatable($tahun)
    {
        $this->db->select("CONCAT('<ul>', GROUP_CONCAT(CONCAT('<li>', (knkdtNamahasil),'</li>') SEPARATOR ''), '</ul>') AS klinikHasil");
        $this->db->select($this->table.'.*');
      
        $this->db->join('lmmc_m_klinikdetil', 'knkdtKlinikid = klinikId', 'left');

        $this->db->group_by('klinikId');
        return $this->db->get($this->table);
    }

    function deleteData($id)
    {
        $this->db->trans_begin();
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);

        $this->db->delete('lmmc_m_klinikdetil', ['knkdtKlinikid' => $id]);

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
        unset($data['hasil']);
        $hasil = $this->input->post('hasil', TRUE);

        if ($id == NULL) 
        {
            $data['klinikId'] = $this->_generateKodeKlinik();

            $this->db->insert($this->table, $data);

            $id = $data['klinikId'];

            $_hasil = [];
            foreach ($hasil as $key => $value) 
            {
                $_hasil[] = array(
                    'knkdtKlinikid' => $id,
                    'knkdtNamahasil' => $value['value'],
                    'knkdtKriteria' => $value['bobotKriteria'],
                );
            }

            $this->db->insert_batch('lmmc_m_klinikdetil', $_hasil);

            return ['status' => 'success', 'message' => 'Data berhasil ditambahkan'];
        }
        else
        {
            $this->db->delete('lmmc_m_klinikdetil', ['knkdtKlinikid' => $id]);

            $_hasil = [];
            foreach ($hasil as $key => $value) 
            {
                $_temp = array(
                    'knkdtKlinikid' => $id,
                    'knkdtNamahasil' => $value['value'],
                    'knkdtKriteria' => $value['bobotKriteria'],
                    'knkdtId' => @$value['id'],
                );

                $_hasil[] = $_temp;
            }

            $this->db->insert_batch('lmmc_m_klinikdetil', $_hasil);

            $this->db->where($this->key, $id);
            $this->db->update($this->table, $data);

            return ['status' => 'success', 'message' => 'Data berhasil diperbaharui'];
        }
    }

    private function _generateKodeKlinik()
    {
        $_currentYear = '3'.substr(date('Y'), 2);

        $this->db->select('*, MAX(klinikId) AS maxKlinik');
        $this->db->like('klinikId', $_currentYear, 'right');
        $data = $this->db->get('lmmc_m_klinik')->row();

        if (@$data->maxKlinik == null) 
        {
            return $_currentYear.'001';
        }
        else
        {
            return ++$data->maxKlinik;
        }

    }

    private function cekDataHasil($klinikId, $hasilNama)
    {
        $this->db->where('knkdtKlinikid', $klinikId);
        $this->db->where('knkdtNamahasil', $hasilNama);
        return $this->db->get('table', $limit, $offset)->num_rows();
    }

    function getHasil($id = null)
    {
        $this->db->where('knkdtKlinikid', $id);
        return $this->db->get('lmmc_m_klinikdetil')->result();
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
