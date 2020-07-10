<?php

/**
 * Description of MY_Controller
 *
 * @author azmi.adhani@ulm.ac.id
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Pemeriksaan extends MY_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->model("Pemeriksaan_m", "db_mecha");
     }

     public function index()
     {
          $kriteria = $this->db_mecha::kriteria;
          $package = array(
               'kriteria' => json_encode($kriteria)
          );
          $this->layout->render('Pemeriksaan_v', $package);
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

          $validasi = $this->db_mecha->val_hasil();
          if ($validasi['status'] !== 'validasi') {
               $divPeserta = $this->db_mecha->pesertaTemplate($validasi['hasilBarcode']);

               $validasi['html'] = $divPeserta;
          }

          echo json_encode($validasi);
     }

     public function update_hasil()
     {
          $validasi = $this->db_mecha->val_update_hasil();
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
