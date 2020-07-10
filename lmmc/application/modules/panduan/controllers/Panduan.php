<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Panduan extends MY_Controller {

	private $panduanId = NULL;

	private $modul = 'panduan';

	public function __construct() {
		parent::__construct();

		$this->load->model('Panduan_m', 'model');

	}

	function image($fileName = '')
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);
		
		$this->load->library('Handle_file', 
			array(
				'upload_path' => $this->model->imageLocation, 
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
			$res = $this->model->getDataGrid($this->input->get(), 'renderDatatable', array(NULL));
			// $this->modifRes($res);

			echo json_encode($res);
		}
		else
		{
			$data['selectTahun'] = [];
			$this->layout->render('index', $data);
		}
	}

	function modifRes(&$res)
	{
		foreach ($res['data'] as $key => $value) {
			$res['data'][$key]->panduanDeskripsi = $value->panduanDeskripsi;
		}
	}

	function ubah($id)
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'update')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			$this->replaceData($id);
		}
		else
		{
			$data['label'] = 'Ubah';
			$data['dataPanduan'] = $this->model->getDataById($id);

			$this->layout->render('ubah', $data);
		}
	}

	function tambah()
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			$this->replaceData();
		}
		else
		{
			$data['label'] = 'Tambah';
			$data['selectKlinik'] = $this->model->selectKlinik();

			$this->layout->render('ubah', $data);
		}
	}

	function replaceData($id = null)
	{
		if ($this->input->is_ajax_request()) 
		{
			$this->panduanId = $id;
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<span class="help-block" style="font-style: italic;">', '</span>');
			$this->form_validation->set_rules($this->model->rules($id));

			if(!$this->form_validation->run())
			{
				$res = array();

				$res['status'] = false;

				foreach ($this->model->rules() as $value) {

					if ($value['field'] == 'dokterId[]') {
						$res['error']['dokterId'] = form_error($value['field']);
					}
					else
					{
						$res['error'][$value['field']] = form_error($value['field']);
					}

				}

				echo json_encode($res);

			}
			else
			{
				$this->load->library('Uploads');
				$this->uploads->setLocation($this->model->imageLocation);
                $this->uploads->setType('jpeg|png|jpg');

				$imageName = NULL;
				if ($id == NULL) 
				{
					$image = $this->uploads->uploadImage('panduanGambar', true);
				}
				else
				{
					$image = $this->uploads->uploadImage('panduanGambar', false);
				}

				if (!$image->status) 
				{
					$res['status'] = false;

					$res['error']['panduanGambar'] = $image->message;

					echo json_encode($res);
					exit;
				}
				else
				{
					$imageName = $image->imageName;
				}

				$data = $this->model->replaceData($id, $imageName);

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

public function cek_panduan()
{
	$_tahun = $this->input->post('panduanTahun', true);
	$_versi = $this->input->post('panduanVersi', true);

	if ($this->model->cek_panduan($_tahun, $_versi, $this->panduanId)) 
	{
		$this->form_validation->set_message(__FUNCTION__, "Panduan versi {$_versi} dan tahun {$_tahun} sudah tersedia");
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}

/* ----------------------   END  ----------------------*/

}
