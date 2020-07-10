<?php

/** @property LoginM $LoginM Login model */
class login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    function index() 
    {
        $model = "";
        $this->load->helper("form");
        if ($this->input->post('Submit')) {
        
            $username = strtoupper($this->input->post('username'));
            $password = $this->input->post('password');

            if ($username == '1') {
                $this->session->set_userdata("user",[
                    'username'=>'mecha',
                    'nama'=>'Super Admin',
                    'role'=>'superadmin',
                ]);
                redirect(base_url('welcome'));
            }

            if ($username == '2') {
                $this->session->set_userdata("user",[
                    'username'=>'mecha',
                    'nama'=>'Admin Data Master',
                    'role'=>'admin_master',
                ]);
                redirect(base_url('welcome'));
            }

            if ($username == '3') {
                $this->session->set_userdata("user",[
                    'username'=>'mecha',
                    'nama'=>'Admin Verifikasi',
                    'role'=>'admin_verif',
                ]);
                redirect(base_url('welcome'));
            }

            if ($username == '4') {
                $this->session->set_userdata("user",[
                    'username'=>'mecha',
                    'nama'=>'Admin Hasil Pemeriksaan',
                    'role'=>'admin_hasil',
                ]);
                redirect(base_url('welcome'));
            }

            if ($username == 'MECHA' && $password == 'mecha') {
                $this->session->set_userdata("user",[
                    'username'=>'mecha',
                    'nama'=>'Administrator',
                    'role'=>'admin',
                ]);
                redirect(base_url('welcome'));
            }
            elseif ($username == 'PTIK' && $password == 'ptik') {
                $this->session->set_userdata("user",[
                    'username'=>'ptik',
                    'nama'=>'PTIK',
                    'role'=>'ptik',
                ]);
                redirect(base_url('welcome'));
            }
            elseif ($username == 'SUPERADMIN' && $password == 'superadmin') {
                $this->session->set_userdata("user",[
                    'username'=>'superadmin',
                    'nama'=>'Superadmin',
                    'role'=>'superadmin',
                ]);
                redirect(base_url('welcome'));
            }
            elseif ($username == 'ADMIN_HASIL' && $password == 'admin_hasil') {
                $this->session->set_userdata("user",[
                    'username'=>'admin_hasil',
                    'nama'=>'admin_hasil',
                    'role'=>'admin_hasil',
                ]);
                redirect(base_url('welcome'));
            }
            elseif ($username == 'ADMIN_VERIF' && $password == 'admin_verif') {
                $this->session->set_userdata("user",[
                    'username'=>'admin_verif',
                    'nama'=>'admin_verif',
                    'role'=>'admin_verif',
                ]);
                redirect(base_url('welcome'));
            }
            elseif ($username == 'OPERATOR' && $password == 'operator') {
                $this->session->set_userdata("user",[
                    'username'=>'operator',
                    'nama'=>'admin_master',
                    'role'=>'admin_master',
                ]);
                redirect(base_url('welcome'));
            }
            else
            {
                redirect(base_url('login'));
            }
        }
        $this->load->view('form', array(
            'model' => $model,
        ));
    }

 

    function keluar() {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }

}
