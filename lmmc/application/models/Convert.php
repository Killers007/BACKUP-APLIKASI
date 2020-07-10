<?php

class Convert extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database('baca');
    }

    function cek_akses_module($role, $modul, $hak) {
        $this->db->select('role');
        if($role != "mahasiswa" || $role != "dosen"){
            $this->db->where('role', $role);
            $this->db->where('modul', $modul);
            $this->db->where('hak', $hak);
            $this->db->from('sia_hak_akses');
            if ($this->db->count_all_results() == 1)
                return true;
            else
                return false;
        }
        return false;
    }

    function cek_nip($nip) {
        $this->db->select('nip');
        $this->db->where('nip', $nip);
        $this->db->from('dosen');
        if ($this->db->count_all_results() == 1)
            return true;
        else
            return false;
    }
}

?>
