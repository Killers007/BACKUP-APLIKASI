<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends MY_Controller {

	private $modul = 'tagihan';

	public function __construct() {
		parent::__construct();

		$this->load->model('Tagihan_m', 'model');

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
			$data['dataBiaya'] = $this->model->getBiaya();
			$data['dataJalur'] = $this->model->getJalurActive();
			$data['isBiaya'] = $this->model->isBiayaTidakTerisi();
			$data['isTagihan'] = $this->model->isTagihan();

			$this->layout->render('index', $data);
		}

	}

	private function convertMonth($date)
	{
		$month = array(
			'Januari' => '01',
			'Februari' => '02',
			'Maret' => '03',
			'April' => '04',
			'Mei' => '05',
			'Juni' => '06',
			'Juli' => '07',
			'Agustus' => '08',
			'September' => '09',
			'Oktober' => '10',
			'November' => '11',
			'Desember' => '12',
		);

		$dateArr = explode(' ', $date);
		@$dateArr[1] = @$month[@$dateArr[1]];
		$date = @("$dateArr[0]-$dateArr[1]-$dateArr[2] $dateArr[3]");

		return date('Y-m-d H:i', strtotime($date));
	}

	function generateTagihan()
	{
		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis'))
		{
			echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
		}
		else if (!$this->acl->cek_akses_module($this->role, $this->modul, 'update'))
		{
			echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
		}

		if ($this->model->isTagihan()) 
		{
			echo json_encode(['status' => 'error', 'message' => 'Tagihan sebelumnya sudah pernah di generate']);exit;
		}

		if ($this->input->is_ajax_request()) 
		{
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<span class="help-block" style="font-style: italic;">', '</span>');
			$this->form_validation->set_rules($this->model->rules());

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
				$waktu_berlaku = $this->convertMonth($this->input->post('waktu_berlaku'));
				$waktu_berakhir = $this->convertMonth($this->input->post('waktu_berakhir'));

				$data = $this->model->generateTagihan($waktu_berlaku, $waktu_berakhir);

				echo json_encode($data);

				//Kirim Pesan 
				// $this->load->library('background');
				// $this->background->addThread(base_url('sender/send_message?X-API-KEY=ptik123'), array('noRegis' => $data['data']));
			}
		}
	}

	function getDetailSms()
	{
		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis'))
		{
			echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
		}

		if ($this->input->is_ajax_request()) 
		{
			$data = $this->model->getDetailSms();
			echo json_encode($data);
		}
	}

	function sendSms()
	{
		if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis'))
		{
			echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
		}

		if ($this->input->is_ajax_request()) 
		{
			$noRegis = $this->input->post('noRegis');

			if ($noRegis == null) {
				$noRegis = $this->model->currentNoRegis();
			}

			$nextNoRegis = $this->model->nextNoRegis($noRegis);
			$this->sender($noRegis);

			echo json_encode(array_merge($this->model->getDetailSms(), ['nextNoRegis' => $nextNoRegis]));
		}
	}

	function sender($noRegis)
	{
		$this->load->helper('telegram');
		// $this->model->updatePesan($noRegis, 0);return 0;


		$dataTagihan = $this->model->getDataById($noRegis);

		if (!empty($dataTagihan)) 
		{
			// ini_set('max_execution_time', 0);
			$_message = "Kepada Peserta Tes Kesehatan ULM diharapkan login ke Portal Tes Kesehatan ULM untuk mendapatkan info lebih lanjut. Silahkan klik link berikut : lmmc.ulm.ac.id";

			// $res = send_sms($dataTagihan->pesertaNohp, $_message);
			$res = kirim_chat($_message);

			if ($res) {
				$this->model->updatePesan($dataTagihan->pesertaNoregis, 1);

				return true;
			}
			else
			{
				$this->model->updatePesan($dataTagihan->pesertaNoregis, 0);
			}

			return false;
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

    public function cek_tanggal_mulai()
    {
    	$waktu_berlaku = $this->convertMonth($this->input->post('waktu_berlaku'));
    	$waktu_berakhir = $this->convertMonth($this->input->post('waktu_berakhir'));
		$now = date('Y-m-d');
    	
    	if ($now > $waktu_berlaku) 
    	{
    		$this->form_validation->set_message(__FUNCTION__, "Waktu berlaku kurang dari tanggal sekarang");
    		return FALSE;
    	}
    	else if ($waktu_berlaku > $waktu_berakhir) 
    	{
    		$this->form_validation->set_message(__FUNCTION__, "Waktu berlaku kurang dari tanggal berakhir");
    		return FALSE;
    	}
    	else
    	{
    		return TRUE;
    	}
    }

    /* ----------------------   END  ----------------------*/

}
