<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Klinik extends MY_Controller {

	private $modul = 'klinik';

	public function __construct() {
		parent::__construct();

		$this->load->model('Klinik_m', 'model');

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
          // $data['selectTahun'] = $this->model->selectTahun();
			// $this->layout->render('index', $data);
			$this->layout->render('index_2', $data);
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

	function getHasil($id = null)
	{
		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')){
			echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
		}

		if ($this->input->is_ajax_request()) 
		{
			$data = $this->model->getHasil($id);

			echo json_encode($data);
		}
	}


    /*
     * ------------------------------------------------------
     *  Callback Form Validation
     * ------------------------------------------------------
     */

    public function cek_kriteria($str)
    {

    	$hasil =  $this->input->post('hasil', true);
    	$kriteriaId = @array_column($hasil, 'bobotKriteria');
    	$_isSame = false;
    	$_isKosong = false;

    	if (empty($kriteriaId)) 
    	{
    		$this->form_validation->set_message(__FUNCTION__, 'Hasil Pemeriksaan wajib di isi');
    		return FALSE;
    	}
    	else
    	{
    		foreach ($hasil as $key => $value) 
    		{
	    		if ($value['value'] == '') 
	    		{
	    			$_isKosong = true;
	    		}
    		}

	    	foreach ($kriteriaId as $key1 => $value1) 
	    	{
	    		foreach ($kriteriaId as $key2 => $value2) 
	    		{
	    			if ($value1 === $value2 && $key1 !== $key2) 
	    			{
	    				$_isSame = true;
	    			}
	    		}
	    	}
    	}

    	if ($_isSame) 
    	{
    		$this->form_validation->set_message(__FUNCTION__, 'Terdapat bobot kriteria yang sama');
    		return FALSE;
    	}
    	else if ($_isKosong) 
    	{
    		$this->form_validation->set_message(__FUNCTION__, 'Keterangan hasil ada yang kosong');
    		return FALSE;
    	}
    	else
    	{
    		return TRUE;
    	}
    }

    /* ----------------------   END  ----------------------*/

}
