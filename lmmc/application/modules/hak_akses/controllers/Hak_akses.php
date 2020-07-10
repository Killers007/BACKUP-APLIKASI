<?php
/** @property HakAksesM $HakAksesM */
class Hak_akses extends MY_Controller{
    private $modul = 'hak_akses';
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Hakakses_m','HakAksesM');
    }
    
    public function index($role = NULL) {
        $aksi_modul = 'baca';
        if(!$this->acl->cek_akses_module($this->role, $this->modul, $aksi_modul))
            show_error("Anda tidak memiliki otorisasi untuk membuka halaman ini ",401);
        
        if($this->input->is_ajax_request()&& isset($_GET['draw'])){
            $role = urldecode($role);
            $request = $this->input->get();
            $data = $this->HakAksesM->getDataGrid($request,$role);
            echo json_encode($data);
        }else{
            $this->load->model('role/Role_m','roleM');
            $this->load->model('Modul');
            $this->load->library('form_validation');
            $model = $this->HakAksesM->getArrayProperty();
            $listRole = $this->roleM->getListData('role','role');
            $listModul = $this->Modul->getListData('modul','modul');
            $data['roleList'] = $this->roleM->getAll();
            $data['listRole'] = $listRole;
            $data['listModul'] = $listModul;
            $data['model'] = $model;
            $this->layout->render('index',$data);
        }
    }
    
    public function tambah() {
        $aksi_modul = 'tulis';
        if(!$this->acl->cek_akses_module($this->role, $this->modul, $aksi_modul)){
            if($this->input->is_ajax_request())
                echo '{"tambah":false,"pesan":"Anda tidak memiliki otorisasi untuk menghapus !"}';
            else
                show_error("",401);
        }
        if($this->input->is_ajax_request()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules($this->HakAksesM->rules());
            $model = $this->input->post();
            if ($this->form_validation->run()){
                $this->HakAksesM->insert($model);
                echo '{"tambah":true,"pesan":"Hak akses berhasil ditambahkan","role":"'.$model['role'].'"}';
            }else{
                $data['tambah'] = false;
                $data['pesan'] = validation_errors();
                echo json_encode($data);
            }
        }else
            redirect(base_url('hak_akses'));
    }
    
    public function hapus(){
        $aksi_modul = 'hapus';
        if(!$this->acl->cek_akses_module($this->role, $this->modul, $aksi_modul)){
            if($this->input->is_ajax_request())
                echo '{"hapus":false,"pesan":"Anda tidak memiliki otorisasi untuk menghapus !"}';
            else
                show_error('',401);
        }else {
            if($this->input->is_ajax_request()){
                $id = $this->input->get();
                if($this->HakAksesM->delete($id))
                    echo '{"hapus":true,"pesan":"Hak akses berhasil dihapus !"}';
                else
                    echo '{"hapus":false,"pesan":"Hak akses gagal dihapus !"}';
            }
        }
    }
    
    public function simpan(){
        $aksi_modul = 'update';
        // if(!$this->acl->cek_akses_module($this->role, $this->modul, $aksi_modul))
        //     show_error("",401);
        if($this->input->post('Submit')){
            $data = $this->input->post('Hak');
            $this->HakAksesM->update_hak($data);
        }
        redirect(base_url('hak_akses'));
    }
}
