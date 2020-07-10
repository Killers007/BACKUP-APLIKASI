<?php

class Jaga_klinik_m extends MY_Model {

    private $table  = 'lmmc_t_jagaklinik';
    private $key    = 'jagaId';

    public $_jalurId;

     public function __construct() {
        parent::__construct();

        $this->_jalurId = @$this->getJalurActive();

    }    

    public function rules($update = null) {

        $rules = array(
            array('field' => 'jagaKlinikid', 'label' => 'Klinik', 'rules' => 'required'),
            array('field' => 'jagaTanggal', 'label' => 'Tanggal', 'rules' => 'required'),
            array('field' => 'dokterNip[]', 'label' => 'Dokter', 'rules' => 'required'),
        );

        return $rules;
    }

    function selectKlinik()
    {
        $out = [];
        $res = $this->db->get('lmmc_m_klinik')->result();

        $out[''] = '';
        foreach ($res as $key => $value) {
            $out[$value->klinikId] = $value->klinikNama;
        }

        return $out;
    }

    function selectTahun()
    {
        $out = [];
        $this->db->order_by('jagaTanggal', 'desc');
        $res = $this->db->get($this->table)->result();

        $out[date('Y')] = date('Y');
        foreach ($res as $key => $value) {
            $out[date('Y', strtotime($value->jagaTanggal))] = date('Y', strtotime($value->jagaTanggal));
        }

        return $out;
    }

    function getListDokter($klinikId = '1', $jagaTanggal = '2020-01-10', $ubah = true)
    {
        $this->db->where('jagaJalurid', @$this->_jalurId->jalurId);
        $this->db->where('jagaKlinikid', $klinikId);        
        $this->db->where('jagaTanggal', date('Y-m-d', strtotime($jagaTanggal)));        
        $res['jagaKlinik'] = $this->db->get('lmmc_t_jagaklinik')->result();

        if ($ubah) 
        {
            $this->db->where('jagaJalurid', @$this->_jalurId->jalurId);
            $this->db->where('jagaTanggal', date('Y-m-d', strtotime($jagaTanggal)));        
            $_availabe = $this->db->get('lmmc_t_jagaklinik')->result_array();
            $_availabe = array_column($_availabe, 'jagaDokterid');

            // if (!empty($_availabe)) 
            // {
            //     $this->db->where_not_in('dokterId', $_availabe);
            // }
        }

        $res['dokter'] = $this->db->get('lmmc_m_dokter')->result();

        return $res;
    }

    function renderDatatable($tahun)
    {
        $this->db->where('jagaJalurid', @$this->_jalurId->jalurId);
        // $this->db->where('YEAR(jagaTanggal)', $tahun);
        $this->db->join('lmmc_m_dokter dk', 'dokterNip = jagaDokterid');
        $this->db->join('lmmc_m_klinik kl', 'klinikId = jagaKlinikid');
       
        $this->db->select("CONCAT('<ul>', GROUP_CONCAT(CONCAT('<li>', (dokterNama),'</li>') SEPARATOR ''), '</ul>') AS listDokter");
        $this->db->select($this->table.'.*, dk.dokterNama, kl.klinikNama');
        $this->db->group_by('klinikId');
        $this->db->group_by('jagaTanggal');
      
        return $this->db->get($this->table);
    }

    function deleteData($id)
    {
        $this->db->trans_begin();
        $fill = $this->getDataById($id);

        $this->db->where('jagaJalurid', @$this->_jalurId->jalurId);
        $this->db->where('jagaKlinikid', $fill->jagaKlinikid);
        $this->db->where('jagaTanggal', $fill->jagaTanggal);
        $this->db->delete($this->table);

        if ($this->db->trans_status()) 
        {
            $this->db->trans_commit();

            return ['status' => 'success', 'message' => 'Data berhasil dihapus'];
        }
        else
        {
            $this->db->trans_rollback();

            return ['status' => 'error', 'message' => 'Data gagal dihapus'];

        }

    }

    function replaceData($id = null)
    {
        $data = $this->input->post(NULL, TRUE);

        // if ($id == NULL) 
        // {
            $res = [];
            $_klinikId = $this->input->post('jagaKlinikid', TRUE);
            $_jagaTanggal = date('Y-m-d', strtotime($this->input->post('jagaTanggal', TRUE)));

            $dokter = $this->input->post('dokterNip', TRUE);
            $dokter = !is_array($dokter)?[]:$dokter;

            $this->db->where('jagaJalurid', @$this->_jalurId->jalurId);
            $this->db->where_not_in('jagaKlinikid', $_klinikId);
            $this->db->where('jagaTanggal', $_jagaTanggal);
            $this->db->where_in('jagaDokterid', $dokter);
            $_availabe = $this->db->get($this->table)->result();

            if (!empty($_availabe)) 
            {
                $_dokterId = array_column($_availabe, 'jagaDokterid');
                $_error = [];

                foreach ($_dokterId as $key => $value) {
                    $_error[$value] = 'Dokter sudah ada pada klinik lain';
                }

                echo json_encode(['status' => false, 'error' => $_error ]);
                exit;
            }

            // @$this->deleteData($id);
            $this->db->where('jagaKlinikid', $_klinikId);
            $this->db->where('jagaTanggal', $_jagaTanggal);
            $this->db->delete($this->table);

            foreach ($dokter as $dokterId) 
            {
                $res = array(
                    'jagaKlinikid' => $_klinikId,
                    'jagaTanggal' => $_jagaTanggal,
                    'jagaDokterid' => $dokterId,
                    'jagaJalurid' => $this->_jalurId->jalurId,
                );

                $this->db->insert($this->table, $res);
            }

            return ['status' => 'success', 'message' => 'Data berhasil ditambahkan'];
        // }
        // else
        // {

        //     $dokter = $this->input->post('dokterId', TRUE);
        //     $dokter = !is_array($dokter)?[]:$dokter;

        //     foreach ($dokter as $dokterId) 
        //     {
              
        //         $this->db->where('jagaKlinikid', $this->input->post('jagaKlinikid', TRUE));
        //         $this->db->where('jagaTanggal', date('Y-m-d', strtotime($this->input->post('jagaTanggal', TRUE))));
        //         $this->db->update($this->table, ['jagaDokterid' => $dokterId]);
        //     }

        //     return ['status' => 'success', 'message' => 'Data berhasil diperbaharui'];
        // }
    }


    /**
     * Ambil 1 data
     * @return object [description]
     */
    public function getDataById($id)
    {
        $this->db->select('*');
        $this->db->join('lmmc_m_klinik', 'klinikId = jagaKlinikid');
        $this->db->where($this->key, $id);

        return $this->db->get($this->table)->row();
    } 

    public function cek_kategori_tahun($tahun, $kategoriId)
    {
        $this->db->where('biayaTahun', $tahun);
        $this->db->where('biayaKategoriid', $kategoriId);

        return $this->db->get($this->table)->num_rows();
    } 
}
