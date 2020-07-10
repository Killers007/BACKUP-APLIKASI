<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bypass_reguler extends MY_Controller {

     private $modul = 'bypass_reguler';

     private $noReg = null;

     public function __construct() 
     {
          parent::__construct();

          $this->load->model('Bypass_m', 'model');
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
               $this->uploads->setName('data_bypass');
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
               '2' => 'Alasan Bypass',
          ];
          $arr = [];
          $arr = [
               array(
                    '1' => '1234455678',
                    '2' => 'Karena Bidikmisi',
               ),
          ];

          $this->excel->generateExcel($arr, 'Template_bypass', $field);
     }

     function view_data_import()
     {
          if(is_file($this->model->imageLocation.'data_bypass.xlsx')) 
          {
               $excelreader = new PHPExcel_Reader_Excel2007();
               $loadexcel = $excelreader->load($this->model->imageLocation.'data_bypass.xlsx'); 
               $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

               $numrow = 1;
               $data = array();
               $no = 1;

               $_tagihan = $this->model->getTagihan();
               $_arrNoReg = $this->model->arrNoRegis();

               foreach($sheet as $row){
                    
                    $list = array();
                    if($numrow > 1){

                         $_noRegis = $row['A'];
                         $_datatagihan = current(array_filter($_tagihan, function($e) use($_noRegis) { return $e->tagihanNoRegis==$_noRegis; }));

                         $list['bypassNoRegis'] = $row['A'];
                         $list['bypassAlasan'] = $row['B'];
                         $list['availabeInDatabase'] = @(in_array($list['bypassNoRegis'], $_arrNoReg));
                         
                         $list['dataTagihan'] = $_datatagihan;

                         $list['tagihanBiaya'] = @$_datatagihan->tagihanBiaya;
                         $list['tagihanNama'] = @$_datatagihan->pesertaNama;
                         $list['tagihanProdi'] = @$_datatagihan->tagihanProdiNama;
                         $list['tagihanIslunas'] = @$_datatagihan->tagihanIslunas;
                         $list['tagihanIsBypass'] = ($_datatagihan->bypassUsername)?1:0;
                    
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

          if(is_file($this->model->imageLocation.'data_bypass.xlsx')) 
          {
               $this->load->helper('token');

               $excelreader = new PHPExcel_Reader_Excel2007();
               $loadexcel = $excelreader->load($this->model->imageLocation.'data_bypass.xlsx'); 
               $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

               $numrow = 1;
               $data = array();
               $no = 1;

               $_tagihan = $this->model->getTagihan();
               $_jalurId = $this->model->getJalurActive();
               $_arrNoReg = $this->model->arrNoRegis();

               date_default_timezone_set('Asia/Kuala_Lumpur');

               foreach($sheet as $row){
                    $pesNoUjian = $row['A']; 
          
                    $list = array();

                    if($numrow > 1)
                    {
                         $_noRegis = $row['A'];
                         $_datatagihan = current(array_filter($_tagihan, function($e) use($_noRegis) { return $e->tagihanNoRegis==$_noRegis; }));

                         if (!$_datatagihan) {
                              continue;
                         }
                         else if($_datatagihan->tagihanIslunas)
                         {
                              continue;
                         }

                          $_noRegis = $row['A'];

                          $list['bypassNoRegis'] = $row['A'];
                          $list['bypassAlasan'] = $row['B'];
                          $list['bypassUsername'] = $this->session->user['username'];

                          $_isBypass = ($_datatagihan->bypassUsername)?1:0;

                          $_successBypass = false;
                          if (!$_isBypass) {
                             $_successBypass = $this->model->bypassPembayaran($row['A'], $list['bypassAlasan']);
                          }
                          
                          if ($_successBypass) {
                             $data[] = $list;
                          }
                    }

                    $numrow++;
               }

               if (!empty($data)) 
               {
                    $_countPes = count($data);
                    $res = $this->model->saveImportPeserta($data);
                    echo json_encode(['status' => 'success', 'message' => "{$_countPes} data tagihan berhasil di bypass"]);
                    @unlink($this->model->imageLocation.'data_bypass.xlsx');
               }
               else
               {
                    echo json_encode(['status' => 'info', 'message' => "Tidak ada data yang di bypass"]);
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

     function cariNoRegis($id = null)
     {
          if (!$this->acl->cek_akses_module($this->role, $this->modul, 'baca')){
               echo json_encode(['status' => 'error', 'message' => 'Tidak ada otoritas mengakses fungsi ini!']);exit;
          }

          if ($this->input->is_ajax_request()) 
          {
               $data = $this->model->cariNoRegis($id);

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
          $_dataPes = $this->model->cekNoRegis($str);

          if (empty($_dataPes)) 
          {
               $this->form_validation->set_message(__FUNCTION__, "Nomor Registrasi Tidak Terdaftar Di Tagihan");
               return FALSE;
          }
          else
          {
               return TRUE;
          }
     }

    /* ----------------------   END  ----------------------*/

}
