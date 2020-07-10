<?php

/**
 * @property Layout $layout Library layout
 * @property Sinkron_m $SinkronM Model */
class Sinkron extends MY_Controller
{

    private $modul = 'sinkron';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sinkron_m', 'SinkronM');
    }

    public function index()
    {
        $aksi_modul = 'tulis';
        if (!$this->acl->cek_akses_module($this->role, $this->modul, $aksi_modul))
            show_error('Anda tidak memiliki akses', 401);
        $masuk = NULL;
        if ($this->input->post('Submit')) {
            $masuk = $this->SinkronM->sinkron();
        }
        $lastSinkron = $this->SinkronM->getLast();

        $this->load->library('form_validation');
        $this->layout->render('index', array('lastSinkron' => $lastSinkron, 'masuk' => $masuk));
    }

    public function ajax()
    {
        $aksi_modul = 'tulis';
        if (!$this->acl->cek_akses_module($this->role, $this->modul, $aksi_modul)) {
            if ($this->input->is_ajax_request())
                echo '{"hapus":false,"pesan":"Anda tidak memiliki otorisasi untuk mengakses !"}';
            else
                show_error("", 401);
        } else {
            if ($this->input->is_ajax_request()) {
                $start = $this->input->get('start');
                $end = $this->input->get('end');
                $masuk = $this->SinkronM->sinkron($start, $end);
                echo json_encode(array('data' => $masuk, 'last' => $this->SinkronM->getLast()));
            } else {
                redirect(base_url('sinkron'));
            }
        }
    }

    public function set_last()
    {
        $aksi_modul = 'update';
        if (!$this->acl->cek_akses_module($this->role, $this->modul, $aksi_modul)) {
            if ($this->input->is_ajax_request())
                echo '{"hapus":false,"pesan":"Anda tidak memiliki otorisasi untuk mengakses !"}';
            else
                show_error("", 401);
        } else {
            if ($this->input->is_ajax_request()) {
                $last = $this->input->post('last');
                if ($this->validateMysqlDate($last)) {
                    $this->SinkronM->setLast($last);
                    echo json_encode(array('status' => true, 'last' => $this->SinkronM->getLast()));
                } else {
                    echo json_encode(array('status' => false));
                }
            } else {
                redirect(base_url('sinkron'));
            }
        }
    }

    protected function validateMysqlDate($date)
    {
        if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date, $matches)) {
            if (checkdate($matches[2], $matches[3], $matches[1])) {
                return true;
            }
        }
        return false;
    }
}
