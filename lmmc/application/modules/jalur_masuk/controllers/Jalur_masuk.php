<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jalur_masuk extends MY_Controller
{

	private $modul = 'jalur_masuk';

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Jalur_masuk_m', 'model');
	}

	public function upload_berkas()
	{

		if (!$this->input->post('upload_id')) {
			// Jika formdata upload_id tidak ada

			$validasi['status'] = 'validasi';
			$validasi['msg'] = 'no upload_id';
		} else {
			// Jika ada formdata upload_id
			$validasi['status'] = 'SIP';
			$id = $this->input->post('upload_id');

			foreach ($_FILES as $key => $value) {

				$upload = $this->model->upload_berkas($key);

				if ($upload['status'] == 'ok') {
					$update = $this->model->update_jalur_file($id, $upload);
					if ($update == 0) {
						$validasi['status'] = 'validasi';
						$validasi['msg'] = 'gagal memasukan data ke database';
					}
				} else {
					$validasi['status'] = 'validasi';
					$validasi['msg'] = $upload['nama_file']['error'];
				}
			}
		}
		echo json_encode($validasi);
	}

	function file($path = '', $fileName = '')
	{


		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		$this->load->library(
			'Handle_file',
			array(
				'upload_path' => $this->config->item($path),
				'allowed_mimes' => ['application/pdf'],
			),
			'handle'
		);

		echo $this->handle->do_download($fileName);
	}

	private function form()
	{
		return array(
			array(
				// 'inputType' => $this->layout::TEXTBOX,
				'inputType' => 'textbox',
				'label' 	=> 'Jalur Nama',
				'type' 		=> 'text',
				'rules'		=> 'required',
				'field' 	=> 'jalurNama',
				// 'addon' 	=> '<span class="fa fa-pencil"></span>|depan',
				// 'rounded' 	=> true,
				// 'attribute' => array('readonly' => 'true', 'value' => 'sipp'),
			),
			array(
				'inputType' => 'textbox',
				'label' 	=> 'Jalur Tahun',
				'type' 		=> 'number',
				'rules'		=> 'required|numeric',
				'field' 	=> 'jalurTahun',
			),
			// array(
			// 	'inputType' => $this->layout::CHECKBOX,
			// 	'label' 	=> 'Jenis Kelamin',
			// 	'type' 		=> 'checkbox',
			// 	'required' 	=> true,
			// 	'rules'		=> 'required',
			// 	'field' 	=> 'jk',
			// 	'data' 		=> array('L' => 'Laki - Laki', 'P' => 'Perempuan'),
			// ),
		);
	}


	public function index()
	{
		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) {
			$_biayaTahun = $this->input->get('biayaTahun');
			$res = $this->model->getDataGrid($this->input->get(), 'renderDatatable', array($_biayaTahun));

			echo json_encode($res);
		} else {

			// $this->layout->addTextbox(['label' => 'Nama Jalur', 'field' => 'jalurNama', 'type' => 'text', 'required' => true]);
			// $this->layout->addTextbox(['label' => 'Tahun', 'field' => 'jalurTahun', 'type' => 'number', 'required' => true]);
			// $this->layout->addCheckbox(['data' => ['0' => 'Satu'], 'type' => 'radio' ]);

			$data['formLayout'] = $this->layout->setVertical()->getLayout();
			$data['formInput']  = $this->layout->generateForm($this->form());

			$this->layout->render('index', $data);
		}
	}

	function replaceData($id = null)
	{
		if ($id == null) {
			if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')) {
				echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);
				exit;
			}
		} else {
			if (!$this->acl->cek_akses_module($this->role, $this->modul, 'update')) {
				echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);
				exit;
			}
		}

		if ($this->input->is_ajax_request()) {
			$this->load->library('form_validation');

			// $this->form_validation->set_error_delimiters('<span class="help-block alert alert-danger" style="font-style: italic; width: fit-content; padding: 5px">', '</span>');
			$this->form_validation->set_error_delimiters('<span class="help-block" style="font-style: italic;">', '</span>');
			$this->form_validation->set_rules($this->form());

			if (!$this->form_validation->run()) {
				$res = array();

				$res['status'] = false;

				foreach ($this->form() as $value) {
					$res['error'][$value['field']] = form_error($value['field']);
				}

				echo json_encode($res);
			} else {
				$data = $this->model->replaceData($id);

				echo json_encode($data);
			}
		}
	}

	function deleteData($id = null)
	{
		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'hapus')) {
			echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);
			exit;
		}

		if ($this->input->is_ajax_request()) {
			$data = $this->model->deleteData($id);

			echo json_encode($data);
		}
	}

	function setActive($id = null)
	{
		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'update')) {
			echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);
			exit;
		}

		if ($this->input->is_ajax_request()) {
			$data = $this->model->setActive($id);

			echo json_encode($data);
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

		if (!is_numeric($harga)) {
			$this->form_validation->set_message(__FUNCTION__, "Harus berisi angka {$harga}");
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function cek_kategori_tahun()
	{
		$_tahun = $this->input->post('biayaTahun', true);
		$_kategoriId = $this->input->post('biayaKategoriid', true);

		if ($this->model->cek_kategori_tahun($_tahun, $_kategoriId)) {
			$this->form_validation->set_message(__FUNCTION__, "Kategori tahun {$_tahun} sudah tersedia");
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/* ----------------------   END  ----------------------*/
}
