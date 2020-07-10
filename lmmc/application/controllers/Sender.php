<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sender extends MY_Controller {

	private $simari;
	private $ci;

    public function __construct() {
        parent::__construct();

        $this->ci = &get_instance();;
        $this->simari = $this->load->database('default', TRUE)->database;
    }

    function send_telegram()
    {
    	$this->load->helper('telegram');

    	$res = kirim_chat('Tes Get Response');

    	echo "<pre>";
    	print_r(json_decode($res, true));
    	echo "</pre>";
    }

    function send_sms()
    {
    	$this->load->helper('telegram');

    	$res = send_sms('085391860735', 'Tes Get Response');

    	echo "<pre>";
    	print_r(json_decode($res, true));
    	echo "</pre>";
    }

    function tes()
    {
    	$this->load->library('background');
    	echo $this->background->addThread(base_url('sender/send_telegram?X-API-KEY=ptik123'), array('tes' => 'tes'));
    }

	function send_message()
	{
		$key = $this->input->get('X-API-KEY');

		if ($key == 'ptik123') 
		{
			$_data = $this->input->post('noRegis', TRUE);

			if (!empty($_data)) 
			{
				$_jalurId = $this->getJalurActive();

				$this->ci->db->select('*');
				$this->ci->db->where('pesertaJalurid', @$_jalurId->jalurId);

				$this->db->where_in('pesertaNoregis', $_data);

				$this->ci->db->join("{$this->simari}.sia_m_prodi", 'pesertaProdiid = prodiKode', 'left');
				$this->ci->db->join("{$this->simari}.sia_m_jurusan", 'jurKode = prodiJurKode');
				$this->ci->db->join("{$this->simari}.sia_m_fakultas", 'jurFakKode = fakKode');

				$data = $this->ci->db->get('lmmc_m_peserta')->result();

				$this->load->helper('telegram');
	        
				ini_set('max_execution_time', 0);
				$_message = "Yth Peserta Tes Kesehatan ULM diharapkan login ke Portal Tes Kesehatan ULM untuk mendapatkan info lebih lanjut. Silahkan klik link berikut : lmmc.ulm.ac.id";
				foreach ($data as $key => $value) 
				{
					$_message = "Yth {$value->pesertaNama} Tes Kesehatan ULM diharapkan login ke Portal Tes Kesehatan ULM untuk mendapatkan info lebih lanjut. Silahkan klik link berikut : lmmc.ulm.ac.id";

					// echo $value->pesertaNama."</br>";
					//$res = send_sms($value->pesertaNohp, $_message);
					$res = kirim_chat($_message);

					if ($res) {
						$this->setPesanTerkirim($value->pesertaNoregis);
					}
				}
			}
		}
	}

	function send_message_pembayaran()
	{
		$key = $this->input->get('X-API-KEY');

		if ($key == 'ptik123') 
		{
			$this->load->helper('telegram');
        
			ini_set('max_execution_time', 0);
			// Post data yang asalnya object jadi array
			$data = $this->input->post('data', TRUE);

			$_biaya = 'Rp. '.number_format($data['tagihanBiaya'],2,',','.');
			$_noHp  = $this->getNoHp($data['tagihanNoRegis']);

			$_message = '';
			$_message .= "Nama : {$data['tagihanPesertaNama']}";
			$_message .= "Program Studi : {$data['tagihanProdiNama']}";
			$_message .= "Biaya tagihan : {$_biaya}";
			$_message .= "Status Pembayaran : Lunas";
			$_message .= "Nomor Telp : {$_noHp}";
			
			if ($_noHp) {
				// send_sms($_noHp, 'Tes LMMC');
				kirim_chat(urlencode($_message));
			}
		}
	}

	function getJalurActive()
    {
        $this->ci->db->where('jalurIsactive', '1');
        return $this->ci->db->get('lmmc_m_jalur')->row();
    }

    function setPesanTerkirim($noRegis)
    {
        $this->ci->db->where('tagihanNoRegis', $noRegis);
        return $this->ci->db->update('lmmc_t_tagihan', ['tagihanPesanIsTerkirim' => 1]);
    }

    function getNoHp($pesertaNoRegis)
    {
    	$jalur = $this->getJalurActive();

        $this->ci->db->where('pesertaNoregis', $pesertaNoRegis);
        // $this->ci->db->where('pesertaJalurid', @$jalur->jalurId);
        $res = $this->ci->db->get('lmmc_m_peserta')->row();

        return @$res->pesertaNohp;
    }

}
