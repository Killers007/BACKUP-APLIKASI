<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mpeserta extends MY_Controller {

     private $modul = 'mpeserta';

     private $noReg = null;

     public function __construct() 
     {
          parent::__construct();

          $this->load->model('Peserta_m', 'model');
          $this->load->library('Excel');

     }

     function image($fileName = '')
     {
          if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);
          
          $this->load->library('Handle_file', 
               array(
                    'upload_path' => $this->model->imagePeserta, 
                    'allowed_mimes' => ['image/jpeg', 'image/png', 'image/jpg'], 
               ), 'handle'
          );

          echo $this->handle->do_download($fileName);

     }

     public function index() 
     {
          if  (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')) show_error("Tidak ada otoritas mengakses halaman ini!", 401);

          if ($this->input->is_ajax_request()) 
          {
               $_jalurId = $this->model->getJalurActive();
               $res = $this->model->getDataGrid($this->input->get(), 'renderDatatable', array(@($_jalurId->jalurId)));

               echo json_encode($res);
          }
          else
          {
               $data['selectProdi'] = $this->model->selectProdi();
               $data['selectJK'] = $this->model->selectJK();
               $data['dataJalur'] = $this->model->getJalurActive();

               $this->layout->render('index', $data);
          }

     }

     function uploadData()
     {
          if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')){
               echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
          } 

          if ($this->input->is_ajax_request()) 
          {
               $this->load->library('uploads');

               $this->uploads->setLocation($this->model->imageLocation);
               $data = $this->uploads->uploadFile('file');

               if ($data->status) 
               {
                    $_res = ['status' => 'success', 'message' => 'Data berhasil di upload'];

                    echo json_encode($_res);
               }
               else
               {
                    $_res = ['status' => 'error', 'message' => $data->message];

                    echo json_encode($_res);
               }
          }
     }

     function download()
     {
          $field = [
               '1' => 'Nomor Peserta',
               '2' => 'Nama Peserta', 
               '3' => 'No Hp', 
               '4' => 'Kode Prodi',
               '5' => 'Tanggal Lahir',
               '6' => 'Nomor KIP',
               '7' => 'Alamat',
               '8' => 'Tempat Lahir',
               '9' => 'Jenis Kelamin',
               '10' => 'Email',
          ];
          $arr = [];
          $arr = [
               array(
                    '1' => '1234455678',
                    '2' => 'Muhammad',
                    '3' => '085212345678',
                    '4' => '65201',
                    '5' => '31-12-1998',
                    '6' => '123.456.789.123',
                    '7' => 'Jl. Ayani',
                    '8' => 'Kandangan',
                    '9' => 'L',
                    '10' => 'muhammad@gmail.com',
               ),
          ];
          // foreach ($data as $key => $value) {
          //      $arr[$key] = (array)$value;
          //      $arr[$key]['pesertaTanggalLahir'] = $value->pesertaTempatLahir.', '.date_convert($value->pesertaTanggalLahir)->default;
          //      $arr[$key]['pesertaNohp'] = '+62 '.$value->pesertaNohp;
          //      $arr[$key]['pesertaNama'] = $value->pesertaGelarDepan.' '.$value->pesertaNama.' '.$value->pesertaGelarBelakang;
          // }

          $this->excel->generateExcel($arr, 'Template_peserta', $field);
     }

     function view_data_import()
     {
          if(is_file($this->model->imageLocation.'data_peserta.xlsx')) 
          {
               $excelreader = new PHPExcel_Reader_Excel2007();
               $loadexcel = $excelreader->load($this->model->imageLocation.'data_peserta.xlsx'); 
               $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

               $numrow = 1;
               $data = array();
               $no = 1;

               $_prodi = $this->model->getProdi();
               $_arrNoReg = $this->model->arrNoRegis();

               foreach($sheet as $row){
                    
                    $list = array();
                    if($numrow > 1){

                         $_prodiId = $row['D'];
                         $_search = current(array_filter($_prodi, function($e) use($_prodiId) { return $e->prodiKode==$_prodiId; }));

                         $list['pesertaNoregis'] = $row['A'];
                         $list['pesertaNama'] = $row['B'];
                         $list['pesertaNohp'] = $row['C'];
                         $list['pesertaTanggallahir'] = date('Y-m-d', strtotime($row['E']));
                         $list['pesertaProdiid'] = isset($_search->prodiNamaResmi)?$_search->prodiNamaResmi:'<span class ="label label-info">Kode Prodi Tidak Valid</span>';
                         $list['pesertaNomorKIP'] = $row['F'];
                         $list['pesertaAlamat'] = $row['G'];
                         $list['pesertaTempatlahir'] = $row['H'];
                         $list['pesertaJK'] = $row['I'];
                         $list['pesertaEmail'] = $row['J'];
                         $list['availabeInDatabase'] = @(in_array($list['pesertaNoregis'], $_arrNoReg));
                    
                         $data[] = $list;
                    }
                    $numrow++;
               }

               $output = [
                    "data" => $data,
               ];

               echo json_encode($output);
          }
     }

     function saveImport()
     {
          if (!$this->acl->cek_akses_module($this->role, $this->modul, 'tulis')){
               echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
          }

          if(is_file($this->model->imageLocation.'data_peserta.xlsx')) 
          {
               $this->load->helper('token');

               $excelreader = new PHPExcel_Reader_Excel2007();
               $loadexcel = $excelreader->load($this->model->imageLocation.'data_peserta.xlsx'); 
               $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

               $numrow = 1;
               $data = array();
               $no = 1;

               $_prodi = $this->model->getProdi();
               $_jalurId = $this->model->getJalurActive();
               $_arrNoReg = $this->model->arrNoRegis();

               date_default_timezone_set('Asia/Kuala_Lumpur');

               foreach($sheet as $row){
                    $pesNoUjian = $row['A']; 
          
                    $list = array();

                    if($numrow > 1)
                    {
                         $_prodiId = $row['D'];
                         $_search = current(array_filter($_prodi, function($e) use($_prodiId) { return $e->prodiKode==$_prodiId; }));

                         if (!isset($_search->prodiNamaResmi)) {
                              continue;
                         }

                         $list['pesertaNoregis'] = $row['A'];
                         $list['pesertaNama'] = $row['B'];
                         $list['pesertaNohp'] = $row['C'];
                         $list['pesertaProdiid'] = $row['D'];
                         $list['pesertaTanggallahir'] = date('Y-m-d', strtotime($row['E']));
                         $list['pesertaNomorKIP'] = (trim($row['F']))?$row['F']:NULL;
                         $list['pesertaTanggalinput'] = date('Y-m-d H:i:s');
                         $list['pesertaImporter'] = $this->session->user['username'];
                         $list['pesertaJalurid'] = @($_jalurId->jalurId);

                         $list['pesertaAlamat'] = $row['G'];
                         $list['pesertaTempatlahir'] = $row['H'];
                         $list['pesertaJK'] = $row['I'];
                         $list['pesertaEmail'] = $row['J'];
                         // $list['pesertaToken'] = uuidV4();

                         if (!in_array($list['pesertaNoregis'], $_arrNoReg)) 
                         {
                              $data[] = $list;
                         }
                    }

                    $numrow++;
               }

               if (!empty($data)) 
               {
                    $_countPes = count($data);
                    $res = $this->model->saveImportPeserta($data);
                    echo json_encode(['status' => 'success', 'message' => "{$_countPes} data peserta berhasil di import"]);
                    @unlink($this->model->imageLocation.'data_peserta.xlsx');

                    // //Kirim Pesan 
                    // $this->load->library('background');
                    // $this->background->addThread();

               }
               else
               {
                    echo json_encode(['status' => 'info', 'message' => "Tidak ada data yang di import"]);
               }

          }
          else
          {
               echo json_encode(['status' => 'info', 'message' => "Silahkan upload file excel"]);
          }
     }

     function replaceData($id = null)
     {
          $this->noReg = $id;

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

     public function cek_no_registrasi($str)
     {
          $noRegis  = $this->input->post('pesertaNoregis', true);

          $_dataPes = $this->model->cekNoRegis($noRegis);

          if ($this->noReg == null) 
          {
               if (!empty($_dataPes)) 
               {
                    $this->form_validation->set_message(__FUNCTION__, "Nomor Peserta sudah tersedia");
                    return FALSE;
               }
               else
               {
                    return TRUE;
               }
          }
          else
          {
               return TRUE;
          }
     }

    /* ----------------------   END  ----------------------*/

}
