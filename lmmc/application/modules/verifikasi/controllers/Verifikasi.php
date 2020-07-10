<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends MY_Controller {

	private $modul = 'verifikasi';

	public function __construct() 
	{
		parent::__construct();

        $this->load->model('mpeserta/Peserta_m', 'peserta');
		$this->load->model('Verifikasi_m', 'model');
	}

	function image($fileName = '')
     {
          if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);
          
          $this->load->library('Handle_file', 
               array(
                    'upload_path' => $this->peserta->imagePeserta, 
                    'allowed_mimes' => ['image/jpeg', 'image/png', 'image/jpg'], 
               ), 'handle'
          );

          echo $this->handle->do_download($fileName);

     }

	public function index() 
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			if ($this->input->post('status') == 'getPeserta') 
			{
				$_pesertaKey = $this->input->post('key', TRUE);

				$res = $this->model->getDetailPeserta($_pesertaKey);

				echo json_encode($res);
			}
			else if ($this->input->post('status') == 'setValidasi') 
			{
				if (!$this->acl->cek_akses_module($this->role, $this->modul, 'update'))
				{
					echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
				}

				$_pesertaKey = $this->input->post('pesertaNoregis', TRUE);
				if ($this->model->isLunas($_pesertaKey)) 
				{
					$_validasiValue = 1; //$this->input->post('value', TRUE);

					$res = $this->model->setValidasiPeserta($_pesertaKey,  $_validasiValue);

					echo json_encode($res);
				}
				else
				{
					echo json_encode(['status' => 'error', 'message' => 'Pembayaran belum lunas']);exit;
				}
				
			}
			else
			{
				$_jalurId = $this->model->getJalurActive();
				$_status = $this->input->get('status', TRUE);
				$res = $this->model->getDataGrid($this->input->get(), 'renderDatatable', array($_status, @$_jalurId->jalurId));

				echo json_encode($res);
			}
		}
		else
		{
			$data['dataJalur'] = $this->model->getJalurActive();

               // $data['selectProdi'] = $this->model->selectProdi();
               // $data['selectJK'] = $this->model->selectJK();

			$this->layout->render('verifikasi_v', $data);
		}
	}

}
