<?php


defined('BASEPATH') OR exit('No direct script access allowed');

// use Spatie\Async\Pool;

class Bot extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('background');
		$this->load->helper('file');
		$this->load->helper('telegram');

	}

	function index()
	{
		$data = array(
			'nama'
		);

		$this->generateFile($data);

		$res = kirim_chat('tes');

		echo $res;
	}

	function generateFile($data = [], $path = 'tes.json', $mode = 'w')
	{
		$file  = read_file(FCPATH.'/tes.json');;
		$json  = json_decode($file);
		$stack = (is_array($json))?$json:[];
		array_push($stack, $data);

		write_file($path, json_encode($stack, JSON_PRETTY_PRINT), $mode);
	}

	function getSession()
	{
		// header('Content-Type: application/json');
		echo read_file(FCPATH.'/tes.json');
	}

	function background()
	{
		echo $this->background->addThread(base_url('bot/addSession'));
		$this->session->sess_destroy();
	}

	function addSession()
	{
			// sleep(2);
		$data = [];
		foreach (range(1,3) as $key => $value) {
			sleep(2);

			$file = read_file(FCPATH.'/tes.json');;
			$json = json_encode($file);
			$stack = (is_array($json))?$json:[];
			array_push($stack, $value);

			write_file(FCPATH.'/tes.json', json_encode($stack), 'a');
		}

	}

	function kirim()
	{
		echo "string";
		$this->db->insert('lmmc_t_detail', ['detailKet' => date('Y-m-d H:i:s')]);
		// $this->load->helper('telegram');
		// kirim_chat('tes');
	}

	function tes()
	{
		$this->load->view('tes');
	}

	public function spatie()
	{
		$pool = Pool::create();

		for($i = 0; $i < 10000; $i++) {
			$pool->add(function() use ($i) {
				echo '<br>'.$res = rand(0, 100);
				return $res;
			})->then(function($output) use ($pool) {
				if ($output === 100) {
					echo $output;
					$pool->stop();
				}
			});
		}

		$pool->wait();
	}

	public function poll()
	{
		$pool = Pool::create();

		ini_set('max_execution_time', 0);
		$this->load->helper('telegram');
		foreach (range(1, 10) as $thing) {
			// $pool->add(function () use ($thing) {
				// kirim_chat($thing);
				echo "$thing<br>";
			// })->then(function ($output) {
			// 	echo $output;
			// })->catch(function (Throwable $exception) {
				// echo "error";
			// });
		}

		// echo "string";

		// $pool->wait();

	}

	function backgrounds()
	{
		// $host = base_url('bot/poll');
		// $fp = fsockopen('localhost', 80);

		// $req = '';
		// $req .= 'GET/HTTP/1.1\\r';
		// $req .= "Host: {$host}\\r";
		// $req .= 'Connection: close\\r';

		// fwrite($fp, $req);

		// echo "<pre>";
		// print_r(stream_get_meta_data($fp));
		// echo "</pre>";

		// ini_set('max_execution_time ', 1);
		// set_time_limit(1);
		$cr = curl_init();

		curl_setopt($cr, CURLOPT_USERAGENT, rand(0, 1000));
		curl_setopt($cr, CURLOPT_URL, base_url('bot/poll'));
		curl_setopt($cr, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($cr, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($cr, CURLOPT_TIMEOUT, 1);
		curl_setopt($cr, CURLOPT_FRESH_CONNECT, TRUE);
		curl_setopt($cr, CURLOPT_NOBODY,1);

		$ret = curl_exec($cr);
		echo "$ret";
		curl_close($cr);

	}


}
