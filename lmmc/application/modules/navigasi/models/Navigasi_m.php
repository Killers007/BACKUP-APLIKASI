<?php

class Navigasi_m extends MY_Model {

    private $table  = 'lmmc_nav';
    private $key    = 'navId';

    public function rules($update = null) {


        $rules = array(
            array('field' => 'navNama', 'label' => 'Nama Navigasi', 'rules' => 'required'),
            // array('field' => 'navModul', 'label' => 'Nama Modul', 'rules' => 'required'),
        );

        return $rules;
    }

    function selectParent()
    {
        $out = [];
        $this->db->where('navParentid', NULL);

        $res = $this->db->get($this->table)->result();

        $out[''] = 'Menu Awal';

        foreach ($res as $key => $value) {
            $out[$value->navId] = $value->navNama;
        }

        return $out;
    }

    function selectRole()
    {
        $out = [];

        $res = $this->db->get('lmmc_role')->result();

        // foreach ($res as $key => $value) {
        //     $out[] = $value->role;
        // }

        return $res;
    }

    function selectModul()
    {
        $out = [];

        $res = $this->db->get('modul')->result();

        $out[''] = 'Menu Awal';

        foreach ($res as $key => $value) {
            $out[$value->modul] = $value->modul;
        }

        return $out;
    }

    public function menuDb($role = 'admin')
    {
        // $this->db->where('navRole', $role);
        $this->db->order_by('navId', 'asc');
        $this->db->order_by('navParentid', 'asc');
        $data = $this->db->get('lmmc_nav')->result();

        $res = [];

        foreach ($data as $key => $value) 
        {
            $_temp = [];

            $_temp = array(
                'label' => $value->navNama,
                'modules' => $value->navModul,
                'url' => $value->navUrl,
                'icon' => $value->navIcon,
            );

            if ($value->navParentid == null) 
            {
                $res[$value->navId] = array_merge($_temp, ['child' => []]);
            }
            else 
            {
                $res[$value->navParentid]['child'][$value->navId] = $_temp;
            }
        }

        return $res;
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
        // $data['navIcon'] = @('fa '.$data['navIcon']);
        $data['navParentid'] = @(($data['navParentid'] == 0)?NULL:$data['navParentid']);

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

    function insertMenu($res, $_role)
    {
        $_insert = [];

        $this->db->select('MAX(navId) as maxId', FALSE);
        $_navNum = $this->db->get('lmmc_nav')->row()->maxId;
        $_id = count($res) + 1 + $_navNum;

        $_sort = 1;

        foreach ($res as $key => $value) 
        {
            $_temp = array(
                'navId' => ($_navNum+$key + 1),
                'navModul' => $value['modules'],
                'navIcon' => $value['icon'],
                'navUrl' => $value['url'],
                'navNama' => $value['label'],
                'navRole' => $_role,
                'navSort' => $_sort,
            );

            $_sort++;

            $_insert[] = $_temp;

            if (isset($value['children'])) 
            {
                foreach ($value['children'] as $values) 
                {
                    $_temp = array(
                        'navId' => $_id,
                        'navModul' => $values['modules'],
                        'navIcon' => $values['icon'],
                        'navUrl' => $values['url'],
                        'navNama' => $values['label'],
                        'navParentid' => ($_navNum+$key + 1),
                        'navRole' => $_role,
                        'navSort' => $_sort,
                    );

                    $_insert[] = $_temp;

                    $_id++;
                    $_sort++;
                }
            }
        }

        $this->db->trans_begin();
        $this->db->empty_table('lmmc_nav');
        // $this->db->delete('lmmc_nav', ['navRole' => $_role]);
        // $this->db->insert_batch('lmmc_nav', $_insert);

        foreach ($_insert as $key => $value) 
        {
            $this->db->insert('lmmc_nav', $value);
        }

        if ($this->db->trans_status()) 
        {
            $this->db->trans_commit();
            return ['status' => 'success', 'message' => 'Menu berhasil disimpan'];
        }
        else
        {
            $this->db->trans_rollback();
            return ['status' => 'error', 'message' => 'Menu gagal disimpan'];
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
        // $this->db->select('TIMESTAMPDIFF(DAY, diklatTanggalMulai, diklatTanggalSelesai)*20 as jam_pelatihan');
        $this->db->where('biayaTahun', $tahun);
        $this->db->where('biayaKategoriid', $kategoriId);

        return $this->db->get($this->table)->num_rows();
    } 
}
