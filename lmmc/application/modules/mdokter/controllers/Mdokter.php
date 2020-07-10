<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mdokter extends MY_Controller {

	private $modul = 'mdokter';
	private $nipLama;

	public function __construct() {
		parent::__construct();

		$this->load->model('Dokter_m', 'model');

	}

	public function index() 
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			$res = $this->model->getDataGrid($this->input->get(), 'renderDatatable', array(NULL));

			echo json_encode($res);
		}
		else
		{
			$this->layout->render('index');
		}

	}

	function replaceData($id = null)
	{
		$this->nipLama = $id;

		if ($id == null) 
		{
			if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis'))
			{
				echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
			}
		}
		else
		{
			if (!$this->acl->cek_akses_module($this->role, $this->modul, 'update'))
			{
				echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
			}
		}

		if ($this->input->is_ajax_request()) 
		{
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<span class="help-block" style="font-style: italic;">', '</span>');
			$this->form_validation->set_rules($this->model->rules($id));

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
				$data = $this->model->replaceData($id);

				echo json_encode($data);
			}
		}
	}

	function deleteData($id = null)
	{
		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'hapus')){
			echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
		}
		
		if ($this->input->is_ajax_request()) 
		{
			$data = $this->model->deleteData($id);

			echo json_encode($data);
		}
	}

	function resetPassword($id = null)
	{
		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'update')){
			echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
		}
		
		if ($this->input->is_ajax_request()) 
		{
			$data = $this->model->resetPassword($id);

			echo json_encode($data);
		}
	}


    /*
     * ------------------------------------------------------
     *  Callback Form Validation
     * ------------------------------------------------------
     */

    public function cek_nip($str)
    {
    	$dokterNip =  $str;
    	if ($this->nipLama != $dokterNip) 
    	{
	    	if (!empty($this->model->getDataById($dokterNip))) 
	    	{
	    		$this->form_validation->set_message(__FUNCTION__, "Nip $str sudah digunakan");
	    		return FALSE;
	    	}
	    	else
	    	{
	    		return TRUE;
	    	}
    	}
    	else{
    		return TRUE;
    	}

    }

    /* ----------------------   END  ----------------------*/

}
