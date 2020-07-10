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

class Laporan extends MY_Controller {

	private $panduanId = NULL;
	private $modul = 'laporan';

	public function __construct() {
		parent::__construct();

		$this->load->model('Laporan_m', 'model');
		$this->load->library('Excel');
		
		if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

	}

	public function index() 
	{

		if ($this->input->is_ajax_request()) 
		{
			$status =  $this->input->post('status');

			if ($status == 'getKlinik') 
			{
				$kategoriId = $this->input->post('kategoriId');
				$res = $this->model->selectKlinik($kategoriId);
			}
			else
			{
				$klinikId = $this->input->get('klinikId', TRUE);
				$kategoriId = $this->input->get('kategoriId', TRUE);
				$_queryJumPeserta = $this->model->_queryJumPeserta();
				$_querySudahPeriksa = $this->model->_querySudahPeriksa($klinikId);
				$res = $this->model->getDataGrid($this->input->get(), 'renderDatatable', array($klinikId, $kategoriId, $_queryJumPeserta, $_querySudahPeriksa));
			}

			echo json_encode($res);
		}
		else
		{
			$data['selectKategori'] = $this->model->selectKategori();
			$data['selectKlinik'] = $this->model->selectKlinik(@key($data['selectKategori']));
			$data['dataJalur'] = $this->model->getJalurActive();

			$this->layout->render('report_baru/index', $data);
		}
	}

	function report($_klinikId = null, $kategoriId, $_kodeProdi = null)
	{
		if ($_klinikId == null) {
			show_404();
		}

		$isPdf = false;
		// $_klinikId	 = '5';
		// $_kodeProdi	 = '11201';

		$data['datas'] = $this->model->reportPerKlinik($_klinikId, $kategoriId, $_kodeProdi);
		$data['isPdf'] = $isPdf;

		if ($isPdf) {
			$html = $this->load->view('report_baru/report4_pdf_v.php', $data, $isPdf);

			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'portrait');
			$dompdf->render();

			$pdf_gen = $dompdf->output();

			$dompdf->stream('Laporan.pdf', array('Attachment' => 0));
		}
		else
		{
			$this->load->view('report_baru/report4_v.php', $data, $isPdf);
		}
		
	}

	function report_excel($_klinikId = null, $kategoriId, $_kodeProdi = null)
	{
		if ($_klinikId == null) {
			show_404();
		}

		$datas = $this->model->reportPerKlinik($_klinikId, $kategoriId, $_kodeProdi);

		$_templateFile = './assets/template/template_klinik_prodi.xlsx';
		$_savePath = './exported_file.xlsx';

		if (empty($datas)) {
			exit;
		}
		else if(count($datas) == 1)
		{
			$_savePath = './'.@$datas[0]['jalur']->jalurNama.'_'.@$datas[0]['jalur']->jalurTahun.'_'.@$datas[0]['kategori'].'_'.@$datas[0]['klinik']->klinikNama.'_'.@$datas[0]['fakultas']->prodiJjarKode.'_'.@$datas[0]['fakultas']->prodiNamaResmi.'.xlsx';
		}
		else
		{
			$_savePath = './'.@$datas[0]['jalur']->jalurNama.'_'.@$datas[0]['jalur']->jalurTahun.'_'.@$datas[0]['kategori'].'_'.@$datas[0]['klinik']->klinikNama.'_SEMUA PRODI'.'.xlsx';
		}

		define('STRING_TYPE', CellSetterStringValue::class);
		define('ARRAY_TYPE', CellSetterArrayValue::class);
		define('ARRAY_2D_TYPE', CellSetterArray2DValue::class);

		$spreadsheet = new SpreadSheet();//IOFactory::load($_templateFile);
		$templateVarsArr = $spreadsheet->getActiveSheet(0)->toArray();
		$templateSheet = clone $spreadsheet->getActiveSheet();

		// $sheet1 = $spreadsheet->getSheet(0);
		$callbacks = [];
		$events = [];

		$_colorPositif = 'FFf0f8ff';
		$_colorTidakHadir = 'FFfaebd7';

		foreach ($datas as $index => $data) {

			if (empty($data['peserta'])) 
			{
				continue;
			}
			
			$sheet1 = $spreadsheet->getSheet(0);
			$sheet1 = clone $templateSheet;
			$sheet1->setTitle(@$data['fakultas']->prodiJjarKode.' - '.substr(@$data['fakultas']->prodiNamaResmi, 0, 24));
			$spreadsheet->addSheet($sheet1);

			$params = [];/*[
				'{klinik}' => new ExcelParam(STRING_TYPE, @$data['klinik']->klinikNama),
				'{kategori}' => new ExcelParam(STRING_TYPE, @$data['kategori']),
				'{jalur}' => new ExcelParam(STRING_TYPE, @$data['jalur']->jalurNama),
				'{tahun}' => new ExcelParam(STRING_TYPE, @$data['jalur']->jalurTahun),
				'{fakultas}' => new ExcelParam(STRING_TYPE, @$data['fakultas']->fakNamaResmi),
			];*/

			// PhpExcelTemplator::renderWorksheet($sheet1, $templateVarsArr, $params, $callbacks, $events);

			$A = 321;
			$_start = 'A';
			$_numStart = 8;

			$sheet1->setCellValue('A8', 'NO');

			$A++;  // B
			$sheet1->setCellValue('B8', 'NOMOR PENDAFTARAN');

			$A++;  // C
			$sheet1->setCellValue('C8', 'NAMA');

			$A++;  // D
			$sheet1->setCellValue('D8',  @$data['klinik']->klinikNama);

			$_numStart += 1;
			$_numStartSum = $_numStart;
			foreach ($data['peserta'] as $key => $value) 
			{
				$sheet1->setCellValue('A'.$_numStart, ($key + 1));
				$sheet1->setCellValue('B'.$_numStart, $value->pesertaNoregis);
				$sheet1->setCellValue('C'.$_numStart, $value->pesertaNama);
				$sheet1->setCellValue('D'.$_numStart, $value->knkdtNamahasil);

				if ($value->knkdtNamahasil == 'Positif') 
				{
					$sheet1->getStyle('A'.$_numStart.':'.'D'.$_numStart)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($_colorPositif);
				}
				else if ($value->knkdtNamahasil == '') 
				{
					$sheet1->getStyle('A'.$_numStart.':'.'D'.$_numStart)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($_colorTidakHadir);
				}

				$_numStart++;
			}

			// $A++;
			$_numStart--;
			$sheet1->getStyle('A8:'.chr($A).$_numStart)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$sheet1->getStyle('A8:'.chr($A).$_numStart)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet1->getStyle('A8:'.chr($A).$_numStart)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$sheet1->getStyle('B9:'.'B'.($_numStart))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$sheet1->getStyle('C9:'.'C'.($_numStart))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

			$sheet1->setCellValue('B'.($_numStart + 3), 'KETERANGAN');
			$sheet1->setCellValue('B'.($_numStart + 4), ' TIDAK HADIR UNTUK MELAKUKAN PEMERIKSAAN');
			$sheet1->setCellValue('B'.($_numStart + 5), ' NAPZA POSITIF');

			$sheet1->getStyle('A'.($_numStart + 4))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($_colorTidakHadir);
			$sheet1->getStyle('A'.($_numStart + 5))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($_colorPositif);

			$sheet1->mergeCells('A1:'.chr($A).'1');
			$sheet1->mergeCells('A2:'.chr($A).'2');
			$sheet1->mergeCells('A3:'.chr($A).'3');
			$sheet1->mergeCells('A4:'.chr($A).'4');
			$sheet1->mergeCells('A5:'.chr($A).'5');

			$styleArray = array(
				'font'  => array(
					'bold'  => true,
					'size'  => 15,
					'name'  => 'Roboto'
				));
			$styleArray2 = array(
				'font'  => array(
					'bold'  => true,
					// 'color' => array('rgb' => 'FF0000'),
					'size'  => 13,
					'name'  => 'Roboto'
				));

			$sheet1->setCellValue('A1', 'LAPORAN HASIL PEMERIKSAAN KESEHATAN ('.@$data['klinik']->klinikNama.')');
			$sheet1->setCellValue('A2', 'MAHASISWA BARU UNIVERSITAS LAMBUNG MANGKURAT ('.@$data['kategori'].')');
			$sheet1->setCellValue('A3', 'FAKULTAS '.@$data['fakultas']->fakNamaResmi.'');
			$sheet1->setCellValue('A4', 'JALUR '.@$data['jalur']->jalurNama.'');
			$sheet1->setCellValue('A5', 'TAHUN '.@$data['jalur']->jalurTahun.'');

			$sheet1->getStyle('A1')->applyFromArray($styleArray);
			$sheet1->getStyle('A2:A5')->applyFromArray($styleArray2);

			$sheet1->getStyle('A1:'.chr($A).'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet1->getStyle('A2:'.chr($A).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet1->getStyle('A3:'.chr($A).'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet1->getStyle('A4:'.chr($A).'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet1->getStyle('A5:'.chr($A).'5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$sheet1->getStyle('B'.$_numStartSum.':B'.$_numStart.'')->getNumberFormat()->setFormatCode('0');

			// foreach(range('A8',chr($A).'8') as $columnID)
			// {
			// 	if (in_array($columnID, ['B8', 'C8'])) {
			// 		continue;
			// 	}
			// 	$sheet1->getColumnDimension($columnID)->setAutoSize(true);
			// }

			$sheet1->getColumnDimension('A')->setWidth(5);
			$sheet1->getColumnDimension('B')->setWidth(51);
			$sheet1->getColumnDimension('C')->setWidth(45);
			$sheet1->getColumnDimension('D')->setWidth(20);

			// $sheet2 = clone $sheet1;
			
			PhpExcelTemplator::renderWorksheet($sheet1, $templateVarsArr, $params, $callbacks, $events);

			// $sheet3 = clone $templateSheet;
			// $sheet3->setTitle('Workshet 3');
			// $spreadsheet->addSheet($sheet3);
			// PhpExcelTemplator::renderWorksheet($sheet3, $templateVarsArr, $params, $callbacks, $events);


		}
		$spreadsheet->removeSheetByIndex(0);
		
		PhpExcelTemplator::outputSpreadsheetToFile($spreadsheet, $_savePath);

	}

	function report_jumlah($_klinikId = null, $_kodeKategori = null)
	{
		if ($_klinikId == null || $_kodeKategori == null) {
			show_404();
		}

		$isPdf = false;
		// $_klinikId		= '5';
		// $_kodeKategori	= $this->model::EKSAKTA_FK;

		$data['data'] = $this->model->reportJumlah($_klinikId, $_kodeKategori);
		$data['isPdf'] = $isPdf;

		$html = $this->load->view('report_baru/report5_v.php', $data, $isPdf);

		if ($isPdf) {
			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'landscape');
			$dompdf->render();

			$pdf_gen = $dompdf->output();

			$dompdf->stream('Laporan.pdf', array('Attachment' => 1));
		}
	}

	function report_jumlah_excel($_klinikId = null, $_kodeKategori = null)
	{
		if ($_klinikId == null || $_kodeKategori == null) {
			show_404();
		}

		$data = $this->model->reportJumlah($_klinikId, $_kodeKategori);


		$_templateFile = './assets/template/template_klinik_jumlah.xlsx';
		$_savePath = './exported_file.xlsx';

		if (empty($data)) 
		{
			exit;
		}
		else
		{
			$_savePath = './'.@$data['jalur']->jalurNama.'_'.@$data['jalur']->jalurTahun.'_'.@$data['kategori'].'_'.@$data['klinik'].'.xlsx';
		}

		define('STRING_TYPE', CellSetterStringValue::class);
		define('ARRAY_TYPE', CellSetterArrayValue::class);
		define('ARRAY_2D_TYPE', CellSetterArray2DValue::class);
		$params = [];
		// [
		// 	'{klinik}' => new ExcelParam(STRING_TYPE, @$data['klinik']),
		// 	'{kategori}' => new ExcelParam(STRING_TYPE, @$data['kategori']),
		// 	'{jalur}' => new ExcelParam(STRING_TYPE, @$data['jalur']->jalurNama),
		// 	'{tahun}' => new ExcelParam(STRING_TYPE, @$data['jalur']->jalurTahun),
		// ];

		$spreadsheet =  new SpreadSheet();//IOFactory::load($_templateFile);
		$templateVarsArr = $spreadsheet->getActiveSheet(0)->toArray();
		$callbacks = [];
		$events = [];

		$sheet1 = $spreadsheet->getSheet(0);
		// PhpExcelTemplator::renderWorksheet($sheet1, $templateVarsArr, $params, $callbacks, $events);

		$A = 321;
		$_start = 'A';
		$_numStart = 8;

		$sheet1->mergeCells('A8:A9');
		$sheet1->setCellValue('A8', 'NO');

		$A++;  // B
		$sheet1->mergeCells('B8:B9');
		$sheet1->setCellValue('B8', 'FAKULTAS / PROGRAM STUDI');

		$A++;  // C
		$sheet1->mergeCells('C8:C9');
		$sheet1->setCellValue('C8', 'JUMLAH PESERTA');

		foreach ($data['header_tanggal'] as $key => $value) {
			$A++;// D
			$sheet1->setCellValue(chr($A).'9' , $value);
		}

		if (!empty($data['header_tanggal'])) 
		{
			$sheet1->mergeCells('D8:'.chr($A).'8');
			$sheet1->setCellValue('D8', 'TANGGAL / PEMERIKSAAN');
		}
		
		$A++;
		$sheet1->mergeCells(chr($A).'8:'.chr($A + 1).'8');
		$sheet1->setCellValue(chr($A).'8', 'JUMLAH');
		$sheet1->setCellValue(chr($A).'9' , 'SUDAH PERIKSA');
		$sheet1->setCellValue(chr($A + 1).'9' , 'BELUM PERIKSA');

		$_numStart += 2;
		$_numStartSum = $_numStart;
		foreach ($data['prodi'] as $key => $value) 
		{
			$D = 324;
			$sheet1->setCellValue('A'.$_numStart, ($key + 1));
			$sheet1->setCellValue('B'.$_numStart, "{$value->fakNamaResmi} / {$value->prodiJjarKode} - {$value->prodiNamaResmi}");
			$sheet1->setCellValue('C'.$_numStart, $value->jumPeserta);

			foreach ($data['header_tanggal'] as $keys => $tanggal) 
			{
				$sheet1->setCellValue(chr($D).$_numStart, intval(@$value->dataTanggal[$tanggal]));
				$D++;
			}

			$sheet1->setCellValue(chr($D).$_numStart, $value->sudahPeriksa);
			$D++;
			$sheet1->setCellValue(chr($D).$_numStart, ($value->jumPeserta - $value->sudahPeriksa));

			$_numStart++;
		}
		$sheet1->setCellValue('B'.$_numStart, 'Jumlah');
		$sheet1->setCellValue('C'.$_numStart, '=SUM(C'.$_numStartSum.':C'.$_numStart.')');

		$D = 324;
		foreach ($data['header_tanggal'] as $keys => $tanggal) 
		{
			$sheet1->setCellValue(chr($D).$_numStart, '=SUM('.chr($D).$_numStartSum.':'.chr($D).$_numStart.')');
			$D++;
		}
		$sheet1->setCellValue(chr($D).$_numStart, '=SUM('.chr($D).$_numStartSum.':'.chr($D).$_numStart.')');
		$D++;
		$sheet1->setCellValue(chr($D).$_numStart, '=SUM('.chr($D).$_numStartSum.':'.chr($D).$_numStart.')');

		$A++;
		$sheet1->getStyle('A8:'.chr($A).$_numStart)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$sheet1->getStyle('A8:'.chr($A).$_numStart)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet1->getStyle('A8:'.chr($A).$_numStart)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$sheet1->getStyle('B10:'.'B'.($_numStart - 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'size'  => 15,
				'name'  => 'Roboto'
			));
		$styleArray2 = array(
			'font'  => array(
				'bold'  => true,
				// 'color' => array('rgb' => 'FF0000'),
				'size'  => 13,
				'name'  => 'Roboto'
			));

		$sheet1->setCellValue('A1', 'LAPORAN HASIL PEMERIKSAAN KESEHATAN ('.@$data['klinik'].')');
		$sheet1->setCellValue('A2', 'MAHASISWA BARU UNIVERSITAS LAMBUNG MANGKURAT ('.@$data['kategori'].')');
		$sheet1->setCellValue('A3', 'JALUR '.@$data['jalur']->jalurNama.'');
		$sheet1->setCellValue('A4', 'TAHUN '.@$data['jalur']->jalurTahun.'');

		$sheet1->getStyle('A1')->applyFromArray($styleArray);
		$sheet1->getStyle('A2:A4')->applyFromArray($styleArray2);

		$sheet1->mergeCells('A1:'.chr($A).'1');
		$sheet1->mergeCells('A2:'.chr($A).'2');
		$sheet1->mergeCells('A3:'.chr($A).'3');
		$sheet1->mergeCells('A4:'.chr($A).'4');
		$sheet1->mergeCells('A5:'.chr($A).'5');

		$sheet1->getStyle('A1:'.chr($A).'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet1->getStyle('A2:'.chr($A).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet1->getStyle('A3:'.chr($A).'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet1->getStyle('A4:'.chr($A).'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet1->getStyle('A5:'.chr($A).'5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		foreach(range('A8',chr($A).'8') as $columnID)
		{
			$sheet1->getColumnDimension($columnID)->setAutoSize(true);
		}

		PhpExcelTemplator::outputSpreadsheetToFile($spreadsheet, $_savePath);
		exit;

	}
}
