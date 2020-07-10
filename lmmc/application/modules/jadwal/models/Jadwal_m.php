<?php

class Jadwal_m extends MY_Model {

    private $table  = 'lmmc_m_dokter';
    private $key    = 'dokterId';
    private $_jalurId = '';
    private $simari = '';

    public function __construct() {
        parent::__construct();

        $this->simari = $this->load->database('default', TRUE)->database;
        $this->_jalurId = @$this->getJalurActive();

    }

    public function rules($update = null) {

        $rules = array(
            array('field' => 'dokterNama', 'label' => 'Nama Dokter', 'rules' => 'required|trim'),
            array('field' => 'dokterNip', 'label' => 'NIP Dokter', 'rules' => 'trim'),
        );

        return $rules;
    }

    function renderDatatable($nim = NULL)
    {
        $this->db->select('*');
      
        return $this->db->get($this->table);
    }

    function getDataTable($dataKategori)
    {
        $res = [];

        $this->db->select('COUNT(*), pesertaTanggalperiksa');
        $this->db->group_by('pesertaTanggalperiksa');
        $this->db->where('pesertaJalurid', $this->_jalurId->jalurId);
        $this->db->where('pesertaTanggalperiksa IS NOT NULL');

        $data = $this->db->get('lmmc_m_peserta')->result();

        foreach ($data as $key => $value) 
        {
            $res[$key]['tanggalPeriksa'] = $value->pesertaTanggalperiksa;

            foreach ($dataKategori as $kategori) 
            {
                $kategoriId = $kategori->kategoriId;

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

                $this->db->where('ktgprdKategoriId', $kategoriId);
                $this->db->select('ktgprdProdiId');
                $queryPeserta = $this->db->get_compiled_select("lmmc_t_kategori_prodi");

                $this->db->where_in('pesertaProdiid', $queryPeserta, FALSE);

                $this->db->where('pesertaTanggalperiksa', $value->pesertaTanggalperiksa);
                $this->db->where('pesertaJalurid', $this->_jalurId->jalurId);
                $this->db->join('lmmc_m_peserta', 'pesertaProdiid = prodiKode');
                $_subQuery = $this->db->get("{$this->simari}.sia_m_prodi")->num_rows();

                $res[$key][$kategoriId] = $_subQuery;
            }

            // $this->db->get('lmmc_m_peserta')->num_rows();
        }

        return $res;
    }

    function generateJadwalPeriksa($data)
    {
        $this->db->where('pesertaJalurid', $this->_jalurId->jalurId);
        $this->db->update('lmmc_m_peserta', ['pesertaTanggalperiksa' => NULL]);

        $result = [];

        // Data dengan uuid per row
        foreach ($data['data'] as $key => $value) 
        {
            $_tanggalPeriksa = date('Y-m-d', strtotime($value['tanggalPemeriksaan']));

            foreach ($value['jumlahPeserta'] as $kategoriId => $jumPeserta) 
            {

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
                // else if($kategoriId == self::NON_EKSAKTA)
                // {
                //     $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
                //     $this->db->where_not_in('prodiKode', $_dokterCombine);
                //     $this->db->where('prodiIsEksakta', '0');
                // }

                $this->db->where('ktgprdKategoriId', $kategoriId);
                $this->db->select('ktgprdProdiId');
                $queryPeserta = $this->db->get_compiled_select("lmmc_t_kategori_prodi");

                $this->db->where_in('pesertaProdiid', $queryPeserta, FALSE);

                $this->db->select('pesertaNoregis');
                $this->db->limit($jumPeserta);
                $this->db->where('pesertaTanggalperiksa', null);
                $this->db->where('pesertaJalurid', $this->_jalurId->jalurId);
                $this->db->join('lmmc_m_peserta', 'pesertaProdiid = prodiKode');
                $_subQuery = $this->db->get("{$this->simari}.sia_m_prodi")->result();

                if (!empty($_subQuery)) {
                    $_subQuery = array_column($_subQuery, 'pesertaNoregis');
                    $this->db->where_in("pesertaNoregis", $_subQuery);
                    $this->db->update('lmmc_m_peserta', ['pesertaTanggalperiksa' => $_tanggalPeriksa]);
                }
            }

        }

        return ['status' => 'success', 'message' => 'Pembaharuan berhasil'];
    }

    /**
     * Ambil 1 data
     * @return object [description]
     */
    public function getDataById($id)
    {
        // $id = $this->db->escape($id);

        $this->db->select('*');
        $this->db->where($this->key, $id);

        return $this->db->get($this->table)->row();
    } 
}
