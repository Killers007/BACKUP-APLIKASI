<?php
/**
 * Description of MY_Controller
 *
 * @author mhmdzaien
 * @property $notification Notification
 */
class MY_Controller extends CI_Controller{

    protected $allowedRole = array(
        'superadmin',
        'admin_fakul',
        'admin_univ',
        'operator',
        'absensi',
        'alumni',
        'admin_bak',
        'ptik',
        'kaprodi',
        'admin_ult',
        'dekan',
        'lainnya',
        'mahasiswa',
        'dosen',
        'keuangan');
    protected $role;
    protected $filterRole;
    protected $semester;
    protected $user;
    protected $range_semester = 10;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Acl','acl');
        $this->load->library(array('session','layout'));

        $this->role = $this->session->user['role'];

//         $semesterAktif = $this->sia->getSemesterAktif();
//         $this->semester = $semesterAktif['semId'];

// //        if($this->sia->EventRun('Maintenance'))
// //            redirect(base_url('maintenance'));
// //
//         if($this->config->item('saml_sp_active') && !$this->session->has_userdata('user'))
//             redirect(base_url('saml'));

//         if($this->session->has_userdata('user') && in_array($this->session->user['role'],$this->allowedRole)){
//             $this->user = $this->session->user;
//             $this->role = $this->user['role'];
//             if($this->role == 'admin_bak'){
//                 $user = $this->session->user;
//                 $user['role'] = 'admin_univ';
//                 $this->session->set_userdata('user',$user);
//                 $this->role = $this->user['role'];
//                 $this->user = $user;
//             }
//             if($this->role == 'ptik'){
//                 $user = $this->session->user;
//                 $user['role'] = 'superadmin';
//                 $this->session->set_userdata('user',$user);
//                 $this->role = $this->user['role'];
//                 $this->user = $user;
//             }
//         }
//        else
//            redirect(base_url('login/keluar'));


    }
}
