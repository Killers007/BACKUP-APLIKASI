<?php

class Kategori_klinik_m extends MY_Model {

    private $table  = 'lmmc_t_kategori_klinik';
    private $key    = 'tKategoriKlinikId';

    private $simari;

    public function __construct() {
        parent::__construct();

        $this->simari = $this->load->database('default', TRUE)->database;
    }

    public function rules($update = null) {

        $cek_tahun = '';
        $rules = [];
        if ($update == null)
        {
            $cek_tahun = '|callback_cek_kategori_tahun';
            // $rules[] = array('field' => 'tKlinikTahun', 'label' => 'Tahun', 'rules' => 'required|numeric'.$cek_tahun);
            $rules[] = array('field' => 'tKategoriId', 'label' => 'Kategori', 'rules' => 'required');
            $rules[] = array('field' => 'tKlinikId[]', 'label' => 'Klinik', 'rules' => 'required');
        } 
        else
        {
            $rules[] = array('field' => 'tKlinikId[]', 'label' => 'Klinik', 'rules' => 'required');
        }

        return $rules;
    }

    function selectkategori()
    {
        $_jalurAktif = $this->getJalurActive();

        $this->db->select('tKategoriId');
        $this->db->where('tKlinikTahun', @$_jalurAktif->jalurTahun);
        $subQuery = $this->db->get_compiled_select('lmmc_t_kategori_klinik');

        $out = [];

        $this->db->where("kategoriId NOT IN ({$subQuery})", NULL, FALSE);
        $res = $this->db->get('lmmc_r_kategori')->result();

        $out[''] = NULL;
        foreach ($res as $key => $value) {
            $out[$value->kategoriId] = $value->kategoriNama;
        }

        return $out;
    }

    function selectKlinik()
    {
        $out = [];
        $res = $this->db->get('lmmc_m_klinik')->result();

        foreach ($res as $key => $value) {
            $out[$value->klinikId] = $value->klinikNama;
        }

        return $out;
    }

     function getListKlinik($tKategoriId = NULL, $tahun = NULL, $ubah = true)
    {
        $res['listKlinik'] = $this->db->get('lmmc_m_klinik')->result();

        $this->db->where('tKategoriId', $tKategoriId);        
        $this->db->where('tKlinikTahun', $tahun); 
        $this->db->select('tKategoriKlinikid', FALSE);
        $_availabe = $this->db->get_compiled_select('lmmc_t_kategori_klinik');
        
        $this->db->where("tKategoriKlinikid in ({$_availabe})", NULL, FALSE);
        $res['listDipakai'] = $this->db->get('lmmc_t_kategori_klinik')->result();


        return $res;
    }

    function selectTahun()
    {
        $out = [];
        $this->db->order_by('tKlinikTahun', 'desc');
        $res = $this->db->get($this->table)->result();

        $out[date('Y')] = date('Y');
        foreach ($res as $key => $value) {
            $out[$value->tKlinikTahun] = $value->tKlinikTahun;
        }

        return $out;
    }

    function renderDatatable($tahun)
    {
        $this->db->select("CONCAT('<ul>', GROUP_CONCAT(CONCAT('<li>', (klinikNama),'</li>') SEPARATOR ''), '</ul>') AS klinikNama");
        $this->db->select($this->table.'.*, kt.kategoriNama');
        $this->db->where('tKlinikTahun', $tahun);
        $this->db->group_by('kategoriId');
        $this->db->order_by('kategoriId', 'asc');

        $this->db->join('lmmc_r_kategori kt', 'kategoriId = tKategoriId', 'left');
        $this->db->join('lmmc_m_klinik kl', 'klinikId = tKlinikId');
      
        $res = $this->db->get($this->table);

        return $res;
    }

    function renderDatatableListFakultasProdi($kategoriId)
    {
        // $this->db->select('fakNamaResmi, fakNamaSingkat, jurNamaResmi, prodiNamaResmi, prodiKode, prodiJjarKode');

        // $this->db->group_start();
        // $this->db->where('prodiJjarKode', 'S1');
        // $this->db->or_where('prodiJjarKode', 'D3');
        // $this->db->group_end();

        // $this->db->from("{$this->simari}.sia_m_fakultas");
        // $this->db->join("{$this->simari}.sia_m_jurusan", 'jurFakKode = fakKode');
        // $this->db->join("{$this->simari}.sia_m_prodi", "prodiJurKode = {$this->simari}.sia_m_jurusan.jurKode");

        // if ($kategoriId == self::EKSAKTA_FK) 
        // {
        //     $this->db->where_in('prodiKode', self::DOKTER);
        // }
        // else if ($kategoriId == self::EKSAKTA_FKG) 
        // {
        //     $this->db->where_in('prodiKode', self::DOKTER_GIGI);
        // }
        // else if($kategoriId == self::EKSAKTA)
        // {
        //     $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
        //     $this->db->where_not_in('prodiKode', $_dokterCombine);
        //     $this->db->where('prodiIsEksakta', '1');
        // }
        // else
        // {
        //     $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
        //     $this->db->where_not_in('prodiKode', $_dokterCombine);
        //     $this->db->where('prodiIsEksakta', '0');
        // }

        // return $this->db->get();
    }

    function deleteData($kategoriId, $tahun)
    {
        $this->db->trans_begin();
        $this->db->where('tKategoriId', $kategoriId);
        $this->db->where('tKlinikTahun', $tahun);
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

    function replaceData($kategoriId = null, $tahun)
    {
        $_jalurAktif = $this->getJalurActive();

        if ($kategoriId == NULL) 
        {
            $_klinik =  $this->input->post('tKlinikId', TRUE);

            $this->db->where('tKategoriId', $this->input->post('tKategoriId', TRUE));
            $this->db->where('tKlinikTahun',  @$_jalurAktif->jalurTahun);

            $this->db->delete($this->table);

            $data = [];
            foreach ($_klinik as $key => $value) 
            {
                $data[] = array(
                    'tKategoriId' => $this->input->post('tKategoriId', TRUE),
                    'tKlinikTahun' =>  @$_jalurAktif->jalurTahun,
                    'tKlinikId' => $value,
                );
            }

            $this->db->insert_batch($this->table, $data);

            return ['status' => 'success', 'message' => 'Data berhasil ditambahkan'];
        }
        else
        {
            $this->db->where('tKategoriId', $kategoriId);
            $this->db->where('tKlinikTahun',  @$_jalurAktif->jalurTahun);

            $this->db->delete($this->table);

            $_klinik =  $this->input->post('tKlinikId', TRUE);

            $data = [];
            foreach ($_klinik as $key => $value) 
            {
                $data[] = array(
                    'tKategoriId' => $kategoriId,
                    'tKlinikTahun' =>  @$_jalurAktif->jalurTahun,
                    'tKlinikId' => $value,
                );
            }

            $this->db->insert_batch($this->table, $data);

            return ['status' => 'success', 'message' => 'Data berhasil diperbaharui'];
        }
    }

    function getkategoriKlinik($kategoriId, $tahun)
    {
        $this->db->join('lmmc_r_kategori', 'tKategoriId = kategoriId');
        $this->db->where('tKategoriId', $kategoriId, FALSE);
        $this->db->where('tKlinikTahun', $tahun, FALSE);
        return $this->db->get('lmmc_t_kategori_klinik')->row();
    }


    /**
     * Ambil 1 data
     * @return object [description]
     */
    public function getDataById($id)
    {
        $this->db->select('*');
        $this->db->where($this->key, $id);

        return $this->db->get($this->table)->row();
    } 

    public function cek_kategori_tahun($tahun, $kategoriId)
    {
        $this->db->where('tKlinikTahun', $tahun);
        $this->db->where('tKategoriId', $kategoriId);

        return $this->db->get($this->table)->num_rows();
    } 
}
