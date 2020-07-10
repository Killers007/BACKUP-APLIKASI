<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends MY_Controller {

	private $modul = 'jadwal';

	public function __construct() {
		parent::__construct();

		$this->load->model('Jadwal_m', 'model');
        $this->load->model('welcome/welcome_m', 'welcome');

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
			$this->load->helper('datetime');

            $data['dataBiaya'] = $this->welcome->getBiaya();
			$data['dataJalur'] = $this->model->getJalurActive();

			$data['dataTable'] = $this->model->getDataTable($data['dataBiaya']);

			$this->layout->render('index', $data);
		}
	}

	public function perbaharui()
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis') || !$this->acl->cek_akses_module($this->role, $this->modul, 'update')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			$data = $this->input->post(NULL, TRUE);

			foreach ($data as $key => $uuid) 
			{
				foreach ($uuid as $key => $value) 
				{
					if ($value['tanggalPemeriksaan'] == '') 
					{
						echo json_encode(['status' => 'error', 'message' => 'Tanggal ada yang kosong']);
						exit;
					}
				}
			}

			if (!empty($data)) {
				$res = $this->model->generateJadwalPeriksa($data);
				echo json_encode($res);
			}
		}
		else
		{
			$this->load->helper('token');

            $data['dataBiaya'] = $this->welcome->getBiaya();
			$data['dataJalur'] = $this->model->getJalurActive();
			$data['dataTable'] = $this->model->getDataTable($data['dataBiaya']);

			$this->layout->render('ubah_v', $data);
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
