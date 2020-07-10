<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Navigasi extends MY_Controller {

    private $modul = 'navigasi';

	public function __construct() {
		parent::__construct();

		$this->load->model('Navigasi_m', 'model');
		$this->load->helper('token');

	}

	public function index() 
	{
        if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			if ($this->input->post('nav', TRUE)) 
			{
				if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis'))
				{
					echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
				}
				else if (!$this->acl->cek_akses_module($this->role, $this->modul, 'update'))
				{
					echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
				}

				$data = $this->input->post('nav', TRUE);
				$_role = $this->input->post('role', TRUE);

				$res = $this->model->insertMenu($data, $_role);

				echo json_encode($res);
			}
			else if ($this->input->post('role', TRUE)) 
			{
				$_role = $this->input->post('role', TRUE);
				$res = $this->model->menuDb($_role);

				echo json_encode($res);
			}
		}
		else
		{
			$data['selectParent'] = $this->model->selectParent();
			$data['selectModul'] = $this->model->selectModul();
			// $data['selectRole'] = $this->model->selectRole();
			$data['menuDb'] = $this->model->menuDb('admin');

			$this->layout->render('index', $data);
		}
	}

    /*
     * ------------------------------------------------------
     *  Callback Form Validation
     * ------------------------------------------------------
     */

    public function cek_harga($str)
    {
    	$harga =  str_replace('.', '', $this->input->post('biayaHarga', true));

    	if (!is_numeric($harga)) 
    	{
    		$this->form_validation->set_message(__FUNCTION__, "Harus berisi angka {$harga}");
    		return FALSE;
    	}
    	else
    	{
    		return TRUE;
    	}
    }

    public function cek_kategori_tahun()
    {
    	$_tahun = $this->input->post('biayaTahun', true);
    	$_kategoriId = $this->input->post('biayaKategoriid', true);

    	if ($this->model->cek_kategori_tahun($_tahun, $_kategoriId)) 
    	{
    		$this->form_validation->set_message(__FUNCTION__, "Kategori tahun {$_tahun} sudah tersedia");
    		return FALSE;
    	}
    	else
    	{
    		return TRUE;
    	}
    }

    /* ----------------------   END  ----------------------*/

}
