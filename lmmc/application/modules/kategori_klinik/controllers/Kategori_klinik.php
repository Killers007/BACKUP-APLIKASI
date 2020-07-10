<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_klinik extends MY_Controller {

	private $modul = 'kategori_klinik';

	public function __construct() 
	{
		parent::__construct();

		$this->load->model('Kategori_klinik_m', 'model');

	}

	public function index() 
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			$_biayaTahun = $this->input->get('biayaTahun');
			$res = $this->model->getDataGrid($this->input->get(), 'renderDatatable', array($_biayaTahun));

			echo json_encode($res);
		}
		else
		{
			$data['selectkategori'] = $this->model->selectkategori();
			$data['selectTahun'] = $this->model->selectTahun();
			$data['selectKlinik'] = $this->model->selectKlinik();
			$this->layout->render('index', $data);
		}
	}

	function list_fakultas_prodi()
	{
		if ($this->input->is_ajax_request()) 
		{
			$_kategoriId = $this->input->get('kategoriId');
			$res = $this->model->getDataGrid($this->input->get(), 'renderDatatableListFakultasProdi', array($_kategoriId));

			echo json_encode($res);
		}

	}

	function ubah($kategoriId, $tahun)
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'update')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			if ($this->input->post('status')  == 'getListKlinik') 
			{
				$data = $this->model->getListKlinik($kategoriId, $tahun, TRUE);

				echo json_encode($data);
			}
			else
			{
				$this->replaceData($kategoriId, $tahun);
			}
		}
		else
		{
			$data['label'] = 'Ubah';

			$data['selectkategori'] = $this->model->selectkategori();
			$data['selectTahun'] = $this->model->selectTahun();
			$data['selectKlinik'] = $this->model->selectKlinik();

			$data['dataKategoriKlinik'] = $this->model->getkategoriKlinik($kategoriId, $tahun);
			$this->layout->render('ubah', $data);
		}
	}

	function tambah()
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			if ($this->input->post('status')  == 'getListKlinik') 
			{
				$klinikId = $this->input->post('klinikId');
				$tahun = $this->input->post('tahun');
				$data = $this->model->getListKlinik($klinikId, $tahun, FALSE);

				echo json_encode($data);
			}
			else
			{
				$this->replaceData();
			}
		}
		else
		{
			$data['label'] = 'Tambah';

			$data['selectkategori'] = $this->model->selectkategori();
			$data['selectKlinik'] = $this->model->selectKlinik();

			$this->layout->render('ubah', $data);
		}
	}

	function replaceData($kategoriId = null, $tahun = null)
	{
		if ($this->input->is_ajax_request()) 
		{
			$this->load->library('form_validation');

            $this->form_validation->set_error_delimiters('<span class="help-block" style="font-style: italic;">', '</span>');
			$this->form_validation->set_rules($this->model->rules($kategoriId));

			if(!$this->form_validation->run())
			{
				$res = array();

				$res['status'] = false;

				foreach ($this->model->rules($kategoriId) as $value) 
				{
					$res['error'][str_replace('[]', '', $value['field'])] = form_error($value['field']);
				}

				echo json_encode($res);

			}
			else
			{
				$data = $this->model->replaceData($kategoriId, $tahun);

				echo json_encode($data);
			}
		}
	}

	function deleteData($kategoriId = null, $tahun = null)
	{
		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'hapus')){
			echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
		}
		
		if ($this->input->is_ajax_request()) 
		{
			$data = $this->model->deleteData($kategoriId, $tahun);

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
