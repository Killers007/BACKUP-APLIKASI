<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Biaya extends MY_Controller {

    private $modul = 'biaya';

	public function __construct() {
		parent::__construct();

		$this->load->model('Biaya_m', 'model');

	}

	public function index() 
	{
        if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

		$_jalurActive = $this->model->getJalurActive();
		if ($this->input->is_ajax_request()) 
		{
			$_biayaTahun = $this->input->get('biayaTahun');
			$res = $this->model->getDataGrid($this->input->get(), 'renderDatatable', array(@($_jalurActive->jalurId)));

			echo json_encode($res);
		}
		else
		{
			$data['selectkategori'] = $this->model->selectkategori();
			$data['label'] = @($_jalurActive->jalurNama);
			$data['dataJalur'] = $this->model->getJalurActive();
			
			$this->layout->render('index', $data);
		}

	}

	function replaceData($id = null)
	{
        if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')){
        	echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
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
