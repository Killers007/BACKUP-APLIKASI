<?php

class Jalur_masuk_m extends MY_Model
{

    private $table  = 'lmmc_m_jalur';
    private $key    = 'jalurId';

    public function rules($update = null)
    {

        $rules = array(
            array('field' => 'jalurNama', 'label' => 'Nama jalur', 'rules' => 'required'),
            array('field' => 'jalurTahun', 'label' => 'Tahun', 'rules' => 'required|numeric'),
        );

        return $rules;
    }

    function update_jalur_file($id, $upload)
    {
        $data = [
            'jalurFileKelulusan' => $upload['nama_file']
        ];

        $this->db->where('jalurId', $id);
        $status = $this->db->update('lmmc_m_jalur', $data);

        if ($status == 1) {
            return $status;
        } else {
            return 0;
        }
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function upload_img($key)
    {
        $aksi_modul = 'tulis';
        $data = ['error' => ''];

        $rs = $this->generateRandomString(10);
        $config['upload_path']          = $this->config->item("path_pengumuman");
        $config['allowed_types']        = 'pdf';
        $config['file_name']            = $rs;
        // $config['overwrite']            = true;
        $config['max_size']             = 10000; // 10MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('Handle_file', $config, 'upload');

        if (!$this->upload->do_upload($key)) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data  = array(
                'upload_data' => $this->upload->data(),
                'error' => ''
            );
            // return $this->upload->disx`play_errors();
            return $data;
        }
    }

    public function upload_berkas($key)
    {
        // jika ada file yang ingin diupload
        $validasi['status'] = 'ok';

        if (count($_FILES) == 0) {
            $validasi['status'] = 'ok';
        } else {
            // jika tidak terdapat error pada file
            if ($_FILES[$key]['error'] == 0) {
                $status_upload = $this->upload_img($key);

                // jika upload tidak error
                if (!$status_upload['error']) {
                    $validasi['nama_file'] = $status_upload['upload_data']['file_name'];
                } else {
                    $validasi['status'] = 'validasi';
                    $validasi['nama_file'] = $status_upload;
                }
            }
        }
        return $validasi;
    }

    function selectTahun()
    {
        $out = [];
        $this->db->order_by('jalurTahun', 'desc');
        $res = $this->db->get($this->table)->result();

        $out[date('Y')] = date('Y');
        foreach ($res as $key => $value) {
            $out[$value->jalurTahun] = $value->jalurTahun;
        }

        return $out;
    }

    function renderDatatable($tahun = null)
    {
        if ($tahun != null) {
            $this->db->where('jalurTahun', $tahun);
        }
        $this->db->select($this->table . '.*');

        return $this->db->get($this->table);
    }

    function deleteData($id)
    {
        $this->db->where('jalurIsactive', '1');
        $this->db->where('jalurId', $id);
        $_row = $this->db->get('lmmc_m_jalur')->num_rows();

        if ($_row) {
            return ['status' => 'info', 'message' => 'Tidak dapat menghapus jalur yang aktif'];
        }

        $this->db->trans_begin();
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);

        if ($this->db->trans_status()) {
            $this->db->trans_commit();

            return ['status' => 'success', 'message' => 'Data berhasil dihapus'];
        } else {
            $this->db->trans_rollback();

            return ['status' => 'error', 'message' => 'Data gagal dihapus'];
        }
    }

    function setActive($id)
    {
        $this->db->trans_begin();

        $this->db->update($this->table, ['jalurIsactive' => 0]);

        $this->db->where($this->key, $id);
        $this->db->update($this->table, ['jalurIsactive' => 1]);

        if ($this->db->trans_status()) {
            $this->db->trans_commit();

            return ['status' => 'success', 'message' => 'Jalur berhasil di aktifkan'];
        } else {
            $this->db->trans_rollback();

            return ['status' => 'error', 'message' => 'Jalur gagal di aktifkan'];
        }
    }

    function sanitaize(&$data)
    {
        $_whiteList = array(
            'jalurNama',
            'jalurTahun',
        );

        foreach ($data as $key => $value) {
            if (!in_array($key, $_whiteList)) unset($data[$key]);
        }
    }

    function replaceData($id = null)
    {
        $data = $this->input->post(NULL, TRUE);
        $this->sanitaize($data);

        if ($id == NULL) {
            $this->db->insert($this->table, $data);

            return ['status' => 'success', 'message' => 'Data berhasil ditambahkan'];
        } else {
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
