<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Dokter_m', 'model');

    }

    public function index() 
    {
        if ($this->input->is_ajax_request()) 
        {
            $res = $this->model->getDataGrid($this->input->get(), 'renderDatatable', array(NULL));

            echo json_encode($res);
        }
        else
        {
            $this->layout->render('index');
        }
        
    }

    function replaceData($id = null)
    {
        if ($this->input->is_ajax_request()) 
        {
            $this->load->library('form_validation');

            $this->form_validation->set_error_delimiters('<span class="form-text text-danger">', '</span>');
            $this->form_validation->set_rules($this->model->rules($id));

            if(!$this->form_validation->run())
            {
                $res = array();

                $res['status'] = false;

                foreach ($this->model->rules() as $value) {

                    if ($value['field'] == 'diklatPengajar[]') {
                        $res['error']['diklatPengajar'] = form_error($value['field']);
                    }
                    else
                    {
                        $res['error'][$value['field']] = form_error($value['field']);
                    }

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

  //   public function cek_pendaftaran($str)
  //   {
        // $tanggalPendaftaran   = explode(' - ', $this->input->post('tanggalPendaftaran', true));

  //    if (date('Y-m-d', strtotime($tanggalPendaftaran[0])) > date('Y-m-d')) 
  //    {
  //        $this->form_validation->set_message(__FUNCTION__, "Tanggal $tanggalPendaftaran[0] kurang dari tanggal sekarang");
  //        return FALSE;
  //    }
  //    else
  //    {
  //        return TRUE;
  //    }
  //   }

    /* ----------------------   END  ----------------------*/

}
