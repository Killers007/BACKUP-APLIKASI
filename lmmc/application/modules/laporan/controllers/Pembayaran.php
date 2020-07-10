<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;
use alhimik1986\PhpExcelTemplator\params\ExcelParam;
use alhimik1986\PhpExcelTemplator\params\CallbackParam;
use alhimik1986\PhpExcelTemplator\setters\CellSetterStringValue;
use alhimik1986\PhpExcelTemplator\setters\CellSetterArrayValue;
use alhimik1986\PhpExcelTemplator\setters\CellSetterArray2DValue;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Pembayaran extends MY_Controller {

	private $modul = 'laporan';

	public function __construct() {
		parent::__construct();

		$this->load->model('Pembayaran_m', 'model');
		$this->load->model('Laporan_m', 'laporan');
		$this->load->library('Excel');

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

			$this->layout->render('pembayaran_v', $data);
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

	function cetak_pembayaran()
	{
		$data['dataJalur'] = $this->laporan->getJalurActive();
		$data['datas'] = $this->laporan->pembayaran();

		$html = $this->load->view('report_baru/pembayaran.php', $data, true);

		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		$pdf_gen = $dompdf->output();

		$dompdf->stream('Laporan.pdf', array('Attachment' => 0));
	}

	function excel()
	{
		$jalur = $this->laporan->getJalurActive();
		$data = $this->laporan->pembayaran();
		
		$_savePath = "./{$jalur->jalurNama}_{$jalur->jalurTahun}.xlsx";

		$params = [];
	
		$spreadsheet =  new SpreadSheet();//IOFactory::load($_templateFile);
		$templateVarsArr = $spreadsheet->getActiveSheet(0)->toArray();
		$events = [];

		$sheet1 = $spreadsheet->getSheet(0);

		$_numEnd = $_numStart = 6;

		$_biayaAll = 0;
		$_biayaLunas = 0;
		$_biayaBelumLunas = 0;

		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'name'  => 'Roboto'
			));

		$sheet1->getStyle("A{$_numStart}:G{$_numStart}")->applyFromArray($styleArray);

		$sheet1->setCellValue("A{$_numStart}", 'NO');
		$sheet1->setCellValue("B{$_numStart}", 'No Peserta');
		$sheet1->setCellValue("C{$_numStart}", 'Nama Peserta');
		$sheet1->setCellValue("D{$_numStart}", 'Program Studi');
		$sheet1->setCellValue("E{$_numStart}", 'Biaya');
		$sheet1->setCellValue("F{$_numStart}", 'Status');
		$sheet1->setCellValue("G{$_numStart}", 'Asuransi Kesehatan');

		foreach ($data as $key => $value) 
		{
			$_numEnd++;

			($value->tagihanIslunas)?$_biayaLunas += $value->tagihanBiaya:$_biayaBelumLunas += $value->tagihanBiaya;
			$_biayaAll += $value->tagihanBiaya;

			$sheet1->setCellValue("A{$_numEnd}", $key + 1);
			$sheet1->setCellValue("B{$_numEnd}", $value->pesertaNoregis);
			$sheet1->setCellValue("C{$_numEnd}", $value->pesertaNama);
			$sheet1->setCellValue("D{$_numEnd}", $value->prodiNamaResmi);
			$sheet1->setCellValue("E{$_numEnd}", 'Rp. '.number_format($value->tagihanBiaya));
			$sheet1->setCellValue("F{$_numEnd}", ($value->tagihanIslunas)?'Lunas':'Belum Lunas');
			$sheet1->setCellValue("G{$_numEnd}", $value->pesertaIsBpjs?'BPJS':'Tidak Bersedia');
		}


		$sheet1->getStyle("A{$_numStart}:G{$_numEnd}")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$sheet1->getStyle("A{$_numStart}:G{$_numEnd}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet1->getStyle("A{$_numStart}:G{$_numEnd}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$_numEnd += 2;
		$sheet1->setCellValue("B{$_numEnd}", 'Lunas');
		$sheet1->setCellValue("C{$_numEnd}", 'Rp. '.number_format($_biayaLunas));

		$_numEnd += 1;
		$sheet1->setCellValue("B{$_numEnd}", 'Belum Lunas');
		$sheet1->setCellValue("C{$_numEnd}", 'Rp. '.number_format($_biayaBelumLunas));

		$_numEnd += 1;
		$sheet1->setCellValue("B{$_numEnd}", 'Total Keseluruhan');
		$sheet1->setCellValue("C{$_numEnd}", 'Rp. '.number_format($_biayaAll));

		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'size'  => 15,
				'name'  => 'Roboto'
			));

		$styleArray2 = array(
			'font'  => array(
				'bold'  => true,
				'size'  => 13,
				'name'  => 'Roboto'
			));

		$sheet1->setCellValue('A1', 'LAPORAN PEMBAYARAN DAN ASURANSI KESEHATAN JALUR '.strtoupper($jalur->jalurNama));
		$sheet1->setCellValue('A2', 'MAHASISWA BARU UNIVERSITAS LAMBUNG MANGKURAT');
		$sheet1->setCellValue('A3', 'TAHUN '.$jalur->jalurTahun);
		$sheet1->mergeCells('A1:G1');
		$sheet1->mergeCells('A2:G2');
		$sheet1->mergeCells('A3:G3');

		$sheet1->getStyle('A1')->applyFromArray($styleArray);
		$sheet1->getStyle('A2:A3')->applyFromArray($styleArray2);

		$sheet1->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet1->getStyle('A2:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet1->getStyle('A3:G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		foreach(range('A','G') as $columnID)
		{
			$sheet1->getColumnDimension($columnID)->setAutoSize(true);
		}

		PhpExcelTemplator::outputSpreadsheetToFile($spreadsheet, $_savePath);
		exit;

	}

    /* ----------------------   END  ----------------------*/

}
