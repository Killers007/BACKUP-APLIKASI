<?php

/**
 * Description of MY_Controller
 *
 * @author azmi.adhani@ulm.ac.id
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi_akhir extends MY_Controller
{
     private $modul = 'verifikasi_akhir';

     public function __construct()
     {
          parent::__construct();

          $this->load->model("Va_m", "mdb");
     }

     public function index()
     {

          $kriteria = $this->mdb::kriteria;

          $package = array(
               'kriteria' => json_encode($kriteria),
               'modul' => $this->modul,
          );
          $this->layout->render('Va_v', $package);
     }

     function image($path = '', $fileName = '')
     {
          $this->load->library(
               'Handle_file',
               array(
                    'upload_path' => $this->config->item($path),
                    'allowed_mimes' => ['image/jpeg', 'image/png', 'image/jpg'],
               ),
               'handle'
          );

          echo $this->handle->do_download($fileName);
     }

     public function request_barcode()
     {

          $validasi = $this->mdb->val_hasil();
          if ($validasi['status'] !== 'validasi') {
               $divPeserta = $this->mdb->pesertaTemplate($validasi['hasilBarcode']);

               $validasi['html'] = $divPeserta;
          }

          echo json_encode($validasi);
     }

     public function update_hasil()
     {

          $validasi = $this->mdb->val_update_hasil();
          echo json_encode($validasi);
     }

     public function laporan_pdf()
     {

          $data = array(
               "dataku" => array(
                    "nama" => "Petani Kode",
                    "url" => "http://petanikode.com"
               )
          );

          $this->load->library('pdf');

          $this->pdf->setPaper('A4', 'potrait');
          $this->pdf->filename = "laporan-petanikode.pdf";
          $this->pdf->load_view('laporan_pdf', $data);
     }
}
