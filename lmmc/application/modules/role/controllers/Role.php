<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {

	private $modul = 'role';

	public function __construct() {
		parent::__construct();

		$this->load->model('Role_m', 'model');

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


    /*
     * ------------------------------------------------------
     *  Callback Form Validation
     * ------------------------------------------------------
     */

  //   public function cek_pendaftaran($str)
  //   {
        // $tanggalPendaftaran   = explode(' - ', $this->input->post('tanggalPendaftaran', true));

  //    if (date('Y-m-d', strtotime($tanggalPendaftaran[0])) > date('Y-m-d')) 
  //    {
  //        $this->form_validation->set_message(__FUNCTION__, "Tanggal $tanggalPendaftaran[0] kurang dari tanggal sekarang");
  //        return FALSE;
  //    }
  //    else
  //    {
  //        return TRUE;
  //    }
  //   }

    /* ----------------------   END  ----------------------*/

}
