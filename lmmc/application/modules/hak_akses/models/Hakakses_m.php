<?php

class Hakakses_m extends MY_Model {

    protected $tables = 'hak_akses';
    protected $pK = 'role';
    public $role;
    public $modul;
    public $hak = array('tulis' => false, 'baca' => false, 'hapus' => false, 'update' => false);

    function rules() {
        return array(
            array('field' => 'role', 'label' => 'Role',
                'rules' => array(
                    'required',
                    array('checkrole', array(Hakakses_m::model(), 'checkRole'))
                ),
                'errors' => array('checkrole' => "Hak akses sudah terdaftar")
            ),
            array('field' => 'modul', 'label' => 'modul', 'rules' => 'required'),
            array('field' => 'hak[]', 'label' => 'Hak Akses', 'rules' => 'required',
                'errors' => array('required' => "Pilihan hak akses harus dicentang minimal satu !")
            ),
        );
    }

    function checkRole($value) {
        $this->db->where('role',$value);
        $this->db->where('modul',$this->input->post('modul'));
        return !($this->db->count_all_results($this->tables) > 0);
    }

    function insert($data) {
        unset($data['submit'], $data['Submit']);
        $temp = $data;
        unset($temp['hak']);
        $this->db->where($temp);
        $this->db->delete($this->tables);
        $insert = array();
        foreach ($data['hak'] as $hak => $value) {
            $insert[] = array('role' => $data['role'], 'modul' => $data['modul'], 'hak' => $hak);
        }
        return $this->db->insert_batch($this->tables, $insert);
    }

    function update_hak($data) {
        unset($data['submit'], $data['Submit']);
        foreach ($data as $role => $val1) {
//            foreach ($val1 as $modul => $hak) {
//                if ($hak!=null){
//                    $this->db->or_group_start()
//                            ->where('role', $role)
//                            ->where('modul', $modul);
//                    $this->db->group_end();
//                }
//            }
            $this->db->where('role', $role);
        }
        $this->db->delete($this->tables);
        foreach ($data as $role => $val1) {
            foreach ($val1 as $modul => $val2) {
                foreach ($val2 as $hak => $value) {
                    $insert[] = array('role' => $role, 'modul' => $modul, 'hak' => $hak);
                }
            }
        }
        $this->db->insert_batch($this->tables, $insert);
    }

    function delete($data) {
        $this->db->where($data);
        return $this->db->delete($this->tables);
    }

    function getDataGrid($request,$role = null,$where = NULL) {
        $select = 'user_role.role,modul.modul,UPPER(GROUP_CONCAT(hak)) as hak';
        $limit = $request['length'];
        $offset = $request['start'];
        $search = $request['search']['value'];
        $order = $request['order'][0];
        $columnOrder = $request['columns'][$order['column']]['data'];
        
        $this->db->from("(SELECT modul FROM modul) as gr");
        $count = $this->db->count_all_results();
        
        $countFilter = $count;
        if ($search != null) {
            $this->db->where("role = '$role'");
            foreach ($request['columns'] as $column) {
                if ($column['searchable'] == 'true')
                    $like[$column['data']] = $search;
            }
            $this->db->select('role');
            $this->db->group_by('role,modul');
            $this->db->like($like);
            $query = $this->db->get_compiled_select($this->tables);
            $this->db->from("($query) as gr");
            $countFilter = $this->db->count_all_results();
        
            $this->db->like($like);
        }
        $this->db->select($select);
        $this->db->where("user_role.role = '$role'");
        $this->db->group_by('role,modul');
        $this->db->order_by($columnOrder, $order['dir']);
        $result = $this->db->get("`user_role` INNER JOIN `modul` LEFT JOIN `hak_akses` USING (`role`,`modul`)", $limit, $offset);
        $data = $result->result_array();
        return array('recordsTotal' => $count, 'recordsFiltered' => $countFilter, 'data' => $data);
    }
    
    public function relations(){
        return array();
    }

}
