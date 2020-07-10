<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
    private $modul = 'welcome';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Welcome_m', 'model');
        $this->load->model('laporan/Laporan_m', 'laporan');
    }

    public function index()
    {
        if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        if ($this->input->is_ajax_request()) 
        {
            $kategoriId = $this->input->post('kategoriId', TRUE);

            $_queryJumPeserta = $this->laporan->_queryJumPeserta();

            $res = $this->model->getProdi($kategoriId, $_queryJumPeserta);

            echo json_encode($res);
        }
        else
        {
            $data['dataBiaya'] = $this->model->getBiaya();
            $data['dataJalur'] = $this->model->getJalurActive();
            $this->layout->render('petunjuk', $data);
        }


    }

    public function detail()
    {
        if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

        if ($this->input->is_ajax_request()) 
        {
            $res = $this->model->getDetailPembayaran();

            echo json_encode($res);
        }

    }
}
