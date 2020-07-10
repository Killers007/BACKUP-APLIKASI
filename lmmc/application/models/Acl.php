<?php

class Acl extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database('baca');
    }

    function cek_akses_module($role, $modul, $hak) {
        if($role != "superadmin"){
            $this->db->select('role');
            $this->db->where('role', $role);
            $this->db->where('modul', $modul);
            $this->db->where('hak', $hak);
            $this->db->from('hak_akses');
            if ($this->db->count_all_results() == 1)
                return true;
            else
                return false;
        }
        return true;
    }

}

?>
