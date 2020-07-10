<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends MY_Controller
{
    private $modul = 'dokter';

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Dokter_m", "model");
    }

    function dashboard()
    {
        if (!$this->get_session()) redirect(base_url('dokter'));

        $this->layout->dokter_render('Dashboard_v');
    }

    function jadwal()
    {
        if (!$this->get_session()) redirect(base_url('dokter'));

        $this->load->helper('datetime');
        $data['jadwal'] = $this->model->getJadwal();

        $this->layout->dokter_render('Jadwal_v', $data);
    }

    function hasil_pemeriksaan()
    {
        if (!$this->get_session()) redirect(base_url('dokter'));

        $data['jadwal'] = $this->model->getHasil();

        $this->layout->dokter_render('Hasil_pemeriksaan_v', $data);
    }

    function ganti_password()
    {
        if (!$this->get_session()) redirect(base_url('dokter'));
        
        if ($this->input->is_ajax_request()) 
        {
            $this->load->library('form_validation');

            $this->form_validation->set_error_delimiters('<p>', '</p>');
            $this->form_validation->set_rules($this->model->rulesPwd());

            if(!$this->form_validation->run())
            {
                $res = array();

                $res['status'] = false;

                foreach ($this->model->rulesPwd() as $value) {

                    $res['error'][$value['field']] = form_error($value['field']);
                }

                echo json_encode($res);
            }
            else
            {
                $passwordBaru = $this->input->post('new');

                $data = $this->model->gantiPassword($passwordBaru);

                echo json_encode($data);
            }
        }
        else
        {
            $this->layout->dokter_render('Ganti_password_v');
        }
    }

    function index()
    {

        if ($this->input->is_ajax_request()) 
        {
            $this->load->library('form_validation');

            $this->form_validation->set_error_delimiters('<p>', '</p>');
            $this->form_validation->set_rules($this->model->rules());

            if(!$this->form_validation->run())
            {
                $res = array();

                $res['status'] = false;

                foreach ($this->model->rules() as $value) {

                    $res['error'][$value['field']] = form_error($value['field']);
                }

                echo json_encode($res);
            }
            else
            {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $data = $this->model->cekLogin($username, $password);

                echo json_encode($data);
            }
        }
        else
        {
            if (!$this->get_session()) 
            {
                // $this->layout->dokter_render('arlo');
                $this->layout->dokter_render('Masuk_v');
            }
            else
            {
                $this->layout->dokter_render('Dashboard_v');

            }
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('dokter').'/');
    }

    public function get_session()
    {
        $sess = $this->session->userdata('user');

        if ($sess['role'] == 'dokter') 
        {
            return true;
        } 

        return false;
    }

    /*
     * ------------------------------------------------------
     *  Callback Form Validation
     * ------------------------------------------------------
     */

    public function cek_password_lama($str)
    {
        $password =  $this->input->post('password', true);

        if (!$this->model->cekPasswordLama($password)) 
        {
            $this->form_validation->set_message(__FUNCTION__, "Password Lama Salah");
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }



}
