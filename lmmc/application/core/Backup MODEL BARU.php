<?php
//require_once APPPATH."hooks/Db_log.php";
/**
 * @property CI_DB_query_builder $db 
 */
class MY_Model extends CI_Model {

    private $realFillter = true;

    protected $tables = 'user_role';

    /** @var String|Integer nama primary key * */
    protected $pK = "";

    private $showQuery = false;

    /**
     * Jalur aktif
     * @return [type] [description]
     */
    function getJalurActive()
    {
        $this->db->where('jalurIsactive', '1');
        return $this->db->get('lmmc_m_jalur')->row();
    }

    /**
     * Tampilkan query di response
     * @return [type] [description]
     */
    function showQuery()
    {
        $this->showQuery = true;
        return $this;
    }

    /**
     * API datatable serverside
     * @param  array $request [auto]
     * @return array          [description]
     */
    function getDataGrid($request, $callBack, $param = []) 
    {
        // Serverside
        if (isset($request['length'])) 
        {
            $countFilter = 0;
            $limit = $request['length'];
            $offset = $request['start'];
            $search = $request['search']['value'];
            $order = $request['order'];

            // fungsi untuk mengurutkan berdasarkan filed yang diilih
            foreach ($order as $o) 
            {
                $this->db->order_by($request['columns'][$o['column']]['data'], $o['dir']);
            }
         
            // untk pencarian data
            if ($search != null) 
            {

                foreach ($request['columns'] as $key => $column) 
                {
                    if ($column['searchable'] == 'true')
                    {

                        if (isset($column['name']) && $column['name'] != NULL)
                        {
                            $t = explode("|",$column['name']);
                            
                            foreach($t as $c)
                            {
                                $like[$c] = ($search == null)?$column['search']['value']:$search;
                            }
                        }
                        else
                        {
                            $like[$column['data']] = ($search == null)?$column['search']['value']:$search;
                        }
                    }
                }

                //Active record fillter
                $this->db->group_start();

                if ($search == null) 
                {
                    $this->db->like($like);
                }
                else
                {
                    $this->db->or_like($like);
                }
                
                $this->db->group_end();

            }

            $result = call_user_func_array(array($this, $callBack), $param);
            // Total semua data
            $countFilter = $result->num_rows();

            // Limit datatable
            $data = $result->result();
            $data = array_slice($data, $offset, ($limit == -1)?null:$limit);
            // Total yang terlimit
            $recordTotal = count($data);
            
            if ($this->showQuery) return array('draw' => intval($_GET['draw']),'recordsTotal' => $recordTotal, 'recordsFiltered' => $countFilter, 'data' => $data, 'query' => $this->db->last_query());
            else return array('draw' => intval($_GET['draw']),'recordsTotal' => $recordTotal, 'recordsFiltered' => $countFilter, 'data' => $data);
        }
        // Non Serverside
        else
        {
            $data = call_user_func_array(array($this, $callBack), $param);

            if ($this->showQuery) return array('data' => $data->result(), 'query' => $this->db->last_query());
            else return array('data' => $data->result());
        }
    }

    function getArrayProperty() {
        $property = get_object_vars($this);
        if ($property[$property['pK']])
            $property['new'] = FALSE;
        else
            $property['new'] = TRUE;

        unset($property['tables'], $property['pK'], $property['db'], $property['db'], $property['rowIdCol'],
                $property['preResultFunc'], $property['matchType'], $property['protectIdentifiers']);
        return $property;
    }

      function getListData($key, $value, $where = NULL, $order = NULL, $placeholder = NULL) {
        $this->db->select(array($key, $value));
        // if ($where != NULL)
        //     $this->db->where($where);
        // if ($order != NULL)
        //     $this->db->order_by($order);
        // foreach ($this->relations() as $alias => $relasi) {
        //     if ($relasi[0] == self::HAS_ONE)
        //         $this->db->join($relasi[1] . " as $alias", "$alias.$relasi[2] = $relasi[3]", "LEFT");
        // }
        $query = $this->db->get($this->tables);
        $result = $query->result_array();
        $return = array();
        if ($placeholder != NULL)
            $return = array('' => $placeholder);
        foreach ($result as $data) {
            $return[$data[$key]] = $data[$value];
        }
        return $return;
    }

    function getAll($param = NULL) {
        foreach ($this->relations() as $alias => $relasi) {
            if ($relasi[0] == self::HAS_ONE)
                $this->db->join($relasi[1] . " as $alias", "$alias.$relasi[2] = $relasi[3]", 'left');
        }
        if (isset($param['select']))
            $this->db->select($param['select']);
        if (isset($param['where']))
            $this->db->where($param['where']);
        if (isset($param['sort'])) {
            if (isset($param['order']))
                $this->db->order_by($param['sort'], $param['order']);
            else
                $this->db->order_by($param['sort']);
        }
        $query = $this->db->get($this->tables);
        return $query->result_array();
    }

}
