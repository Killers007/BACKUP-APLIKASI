<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jaga_klinik extends MY_Controller {

	private $modul = 'jaga_klinik';

	public function __construct() {
		parent::__construct();

		$this->load->model('Jaga_klinik_m', 'model');

	}

	public function index() 
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			$_jagaTahun = $this->input->get('jagaTahun');
			$res = $this->model->getDataGrid($this->input->get(), 'renderDatatable', array($_jagaTahun));
			$this->modifDatatable($res);

			echo json_encode($res);
		}
		else
		{
			$data['dataJalur'] = $this->model->getJalurActive();
			$data['selectTahun'] = $this->model->selectTahun();
			$this->layout->render('index', $data);
		}
	}

	private function modifDatatable(&$arr)
	{
		$this->load->helper('datetime');

		foreach ($arr['data'] as $key => $value) 
		{
			$_convert = date_convert($value->jagaTanggal);
			$arr['data'][$key]->jagaTanggal = $_convert->dayName.', '.$_convert->default;
		}
	}

	function ubah($id)
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'update')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		if ($this->input->is_ajax_request()) 
		{
			if ($this->input->post('status')  == 'getListDokter') 
			{
				$klinikId = $this->input->post('klinikId');
				$jagaTanggal = $this->input->post('tanggal');
				$data = $this->model->getListDokter($klinikId, $jagaTanggal, FALSE);

				echo json_encode($data);
			}
			else
			{
				$this->replaceData($id);
			}
		}
		else
		{
			$data['label'] = 'Ubah';
			$data['dataKlinik'] = $this->model->getDataById($id);
			$data['selectKlinik'] = $this->model->selectKlinik();

			$this->layout->render('ubah', $data);
		}
	}

	function tambah()
	{
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);
			
		if ($this->input->is_ajax_request()) 
		{
			if ($this->input->post('status')  == 'getListDokter') 
			{
				$klinikId = $this->input->post('klinikId');
				$jagaTanggal = $this->input->post('tanggal');
				$data = $this->model->getListDokter($klinikId, $jagaTanggal);

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
			$data['selectKlinik'] = $this->model->selectKlinik();

			$this->layout->render('ubah', $data);
		}
	}

	function replaceData($id = null)
	{

		if ($this->input->is_ajax_request()) 
		{
			$this->load->library('form_validation');

            $this->form_validation->set_error_delimiters('<span class="help-block" style="font-style: italic;">', '</span>');
			$this->form_validation->set_rules($this->model->rules($id));

			if(!$this->form_validation->run())
			{
				$res = array();

				$res['status'] = false;

				foreach ($this->model->rules() as $value) 
				{
					$res['error'][str_replace('[]', '', $value['field'])] = form_error($value['field']);
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
