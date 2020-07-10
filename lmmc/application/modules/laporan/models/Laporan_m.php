<?php

class Laporan_m extends MY_Model {

    private $simari;
    public $_jalurId;

    // const DOKTER        =  ['11201', // PENDIDIKAN DOKTER
    //                         '11706', // ANESTESIOLOGI
    //                         '11707', // ILMU BEDAH
    //                         '11708', // OBSTETRI DAN GINEKOLOGI
    //                         '11709', // PULMONOLOGI
    //                         '11711', // KESEHATAN ANAK
    //                         '11901']; // PROFESI DOKTER

    // const DOKTER_GIGI   = ['12201', // PENDIDIKAN DOKTER GIGI
    //                        '12901']; // PROFESI DOKTER GIGI

    // const NON_EKSAKTA   = '1';
    // const EKSAKTA       = '2';
    // const EKSAKTA_FK    = '3';
    // const EKSAKTA_FKG   = '4';

    public function __construct() {
        parent::__construct();

        $this->simari = $this->load->database('default', TRUE)->database;
        $this->_jalurId = @$this->getJalurActive();

    }

    function selectKategori()
    {
        $out = [];
        $res = $this->db->get('lmmc_r_kategori')->result();
        
        foreach ($res as $key => $value) {
            $out[$value->kategoriId] = $value->kategoriNama;
        }

        return $out;
    }

     function selectKlinik($kategoriId = null)
    {
        $out = [];
        if ($kategoriId != null) 
        {
            $this->db->where('tKlinikTahun', $this->_jalurId->jalurTahun);
            $this->db->where('tKategoriId', $kategoriId);
            $this->db->join('lmmc_t_kategori_klinik', 'tKlinikId = klinikId');
        }

        $res = $this->db->get('lmmc_m_klinik')->result();
        
        foreach ($res as $key => $value) {
            $out[$value->klinikId] = $value->klinikNama;
        }

        return $out;
    }

    function pembayaran()
    {
        $this->db->select('*');
        $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);
        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        $this->db->join("{$this->simari}.sia_m_prodi", 'prodiKode = tagihanProdikode');
        $this->db->join("lmmc_m_peserta", 'pesertaNoregis = tagihanNoRegis');

        return $this->db->get('lmmc_t_tagihan')->result();
    }

    /**
     * Datatable ke controller
     * @param  [type] $klinikId           [description]
     * @param  [type] $kategoriId         [description]
     * @param  [type] $_queryJumPeserta   [Sub Query Model -> Controller -> Param]
     * @param  [type] $_querySudahPeriksa [Sub Query]
     * @return [type]                     [CI DB MYSQL]
     */
    function renderDatatable($klinikId, $kategoriId, $_queryJumPeserta, $_querySudahPeriksa)
    {
        $this->db->select('fakNamaResmi, fakNamaSingkat, jurNamaResmi, prodiNamaResmi, prodiKode, prodiJjarKode');
        $this->db->select('IFNULL(jumPeserta.jumPeserta, 0) as jumPeserta, IFNULL(sudahPeriksa.sudahPeriksa, 0) AS sudahPeriksa, IFNULL((jumPeserta.jumPeserta - IFNULL(sudahPeriksa.sudahPeriksa, 0)), 0) AS belumPeriksa');

        $this->db->from("{$this->simari}.sia_m_fakultas");
        $this->db->join("{$this->simari}.sia_m_jurusan", 'jurFakKode = fakKode');
        $this->db->join("{$this->simari}.sia_m_prodi", "prodiJurKode = {$this->simari}.sia_m_jurusan.jurKode");

        $this->db->join("({$_queryJumPeserta}) as jumPeserta", 'jumPeserta.pesertaProdiid = prodiKode', 'left');
        $this->db->join("({$_querySudahPeriksa}) as sudahPeriksa", 'sudahPeriksa.pesertaProdiid = prodiKode', 'left');
        $this->db->join('lmmc_t_kategori_prodi', 'ktgprdProdiId = prodiKode');
        $this->db->where('ktgprdKategoriId', $kategoriId);

        $this->db->group_start();
        $this->db->where('prodiJjarKode', 'S1');
        $this->db->or_where('prodiJjarKode', 'D3');
        $this->db->group_end();

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

        return $this->db->get();
    }

    /**
     * Query untuk di joinkan untuk mendapatkan jumlah peserta
     * @return [type] [description]
     */
    public function _queryJumPeserta()
    {
        $this->db->select('pesertaProdiid, COUNT(pesertaNoregis) AS jumPeserta');
        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        $this->db->group_by('pesertaProdiid');
        return $this->db->get_compiled_select('lmmc_m_peserta');
    }

    /**
     * Query untuk di joinkan untuk mendapatkan jumlah peserta yang sudah periksa
     * @return [type] [description]
     */
    public function _querySudahPeriksa($klinikId)
    {
        $this->db->select('pesertaProdiid, COUNT(hasilId) AS sudahPeriksa');
        $this->db->join('lmmc_t_hasilpemeriksaan', "hasilPesertaid = pesertaNoregis", 'left');
        $this->db->join('lmmc_m_klinikdetil', "knkdtId = hasilKnkdtid");
        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        $this->db->where('knkdtKlinikid', $klinikId);
        $this->db->group_by('pesertaProdiid');

        return $this->db->get_compiled_select('lmmc_m_peserta');
    }

    function reportJumlah($klinikId, $kategoriId = '3')
    {

        $_queryJumPeserta   = $this->_queryJumPeserta();
        $_querySudahPeriksa = $this->_querySudahPeriksa($klinikId);

        $this->db->select('fakNamaResmi, fakNamaSingkat, jurNamaResmi, prodiNamaResmi, prodiKode, prodiJjarKode');

        $this->db->group_start();
        $this->db->where('prodiJjarKode', 'S1');
        $this->db->or_where('prodiJjarKode', 'D3');
        $this->db->group_end();
        
        $this->db->select('IFNULL(jumPeserta.jumPeserta, 0) as jumPeserta, IFNULL(sudahPeriksa.sudahPeriksa, 0) AS sudahPeriksa');
        $this->db->from("{$this->simari}.sia_m_fakultas");
        $this->db->join("{$this->simari}.sia_m_jurusan", 'jurFakKode = fakKode');
        $this->db->join("{$this->simari}.sia_m_prodi", "prodiJurKode = {$this->simari}.sia_m_jurusan.jurKode");

        $this->db->join("({$_queryJumPeserta}) as jumPeserta", 'jumPeserta.pesertaProdiid = prodiKode', 'left');
        $this->db->join("({$_querySudahPeriksa}) as sudahPeriksa", 'sudahPeriksa.pesertaProdiid = prodiKode', 'left');
        $this->db->join('lmmc_t_kategori_prodi', 'ktgprdProdiId = prodiKode');
        $this->db->where('ktgprdKategoriId', $kategoriId);

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

        $_resPeserta = $this->db->get()->result();
      
        foreach ($_resPeserta as $key => $value) {
            $_resPeserta[$key]->dataTanggal = $this->getJumlahPadaTanggal($klinikId, $value->prodiKode);
        }

        $_reskategori  = @$this->getKategoriNama($kategoriId)->kategoriNama;

        return array(
            'prodi'             => $_resPeserta,
            'kategori'          => $_reskategori,
            'jalur'             => $this->_jalurId,
            'klinik'            => @$this->getKlinik($klinikId)->klinikNama,
            'header_tanggal'    =>  $this->headerTanggal($klinikId, $kategoriId),
        );
    }

    /**
     * Untuk data pada header tanggal sesuai tanggal (HEADERNYA AJA)
     * @param  [type] $klinikId   [description]
     * @param  [type] $kategoriId [description]
     * @return [type]             [description]
     */
    private function headerTanggal($klinikId, $kategoriId)
    {
        $this->db->where('ktgprdKategoriId', $kategoriId);
        $this->db->select('ktgprdProdiId');
        $queryPeserta = $this->db->get_compiled_select("lmmc_t_kategori_prodi");

        $this->db->join("{$this->simari}.sia_m_prodi", "prodiKode = pesertaProdiid");
        $this->db->join('lmmc_t_hasilpemeriksaan', "hasilPesertaid = pesertaNoregis");
        $this->db->join('lmmc_m_klinikdetil', "knkdtId = hasilKnkdtid");
        $this->db->join('lmmc_m_klinik', "knkdtKlinikid = klinikId");

        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        $this->db->where('klinikId', $klinikId);
        $this->db->order_by('hasilTanggal', 'asc');
        $this->db->group_by('DATE(hasilTanggal)');

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

        $this->db->where_in('pesertaProdiid', $queryPeserta, FALSE);

        $data = $this->db->get('lmmc_m_peserta')->result();

        foreach ($data as $key => $value) {
            $data[$key] = date('d/m/Y', strtotime($value->hasilTanggal));
        }

        return $data;
    }   

    /**
     * Data untuk mengisikan value sesuai header
     * @param  [type] $klinikId [description]
     * @param  [type] $prodiId  [description]
     * @return [type]           [description]
     */
    private function getJumlahPadaTanggal($klinikId, $prodiId)
    {

        $this->db->select('COUNT(DATE(hasiltanggal)) jumlah');
        $this->db->select('DATE(hasiltanggal) hasilTanggal');

        $this->db->select('pesertaNoregis, pesertaNoregis, pesertaNama, pesertaJalurid, klinikId');
        $this->db->select('knkdtNamahasil, klinikNama, hasilTanggal');

        $this->db->join("{$this->simari}.sia_m_prodi", "pesertaProdiid = prodiKode");
        $this->db->join('lmmc_t_hasilpemeriksaan', "hasilPesertaid = pesertaNoregis");
        $this->db->join('lmmc_m_klinikdetil', "knkdtId = hasilKnkdtid");
        $this->db->join('lmmc_m_klinik', "knkdtKlinikid = klinikId");

        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        $this->db->where('prodiKode', $prodiId);
        $this->db->where('klinikId', $klinikId);
        $this->db->order_by('hasilTanggal', 'asc');
        $this->db->group_by('DATE(hasiltanggal)');

        $data = $this->db->get('lmmc_m_peserta')->result();

        $result = [];
        foreach ($data as $key => $value) {
            $result[date('d/m/Y', strtotime($value->hasilTanggal))] = $value->jumlah;
        }

        return $result;
    }   

    private function getProdi($prodiId = null, $kategoriId)
    {
        if ($prodiId != null) 
        {
            $this->db->where('prodiKode', $prodiId);
        }

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
        $this->db->join("lmmc_t_kategori_prodi", 'ktgprdProdiId = prodiKode');
        $res = $this->db->get("{$this->simari}.sia_m_prodi")->result();

        return array_column($res, 'prodiKode');
    }

    function reportPerKlinik($klinikId, $kategoriId, $prodiIds = null)
    {
        $all = [];
        $prodi =  $this->getProdi($prodiIds, $kategoriId);
        $_resKlinik = @$this->getKlinik($klinikId);

        foreach ($prodi as $key => $prodiId) 
        {
            $this->db->select('knkdtNamahasil');
            $this->db->join('lmmc_m_klinikdetil', 'hasilKnkdtid = knkdtId');
            $this->db->where('hasilPesertaid = pesertaNoregis');
            $this->db->where('knkdtKlinikid', $klinikId);
            $_subQuery = $this->db->get_compiled_select('lmmc_t_hasilpemeriksaan');

            $this->db->select('lmmc_m_peserta.*');
            $this->db->select("({$_subQuery}) as knkdtNamahasil");

            $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
            $this->db->where('pesertaProdiid', $prodiId);
            $this->db->group_by('pesertaNoregis');
            $_resPeserta = $this->db->get('lmmc_m_peserta')->result();

            $_resFakultas = $this->getFakultas($prodiId);

            $isEsakta = $this->db->get_where("{$this->simari}.sia_m_prodi", ['prodiKode' => $prodiId])->row();

            // if (in_array($prodiId, self::DOKTER)) 
            // {
            //     $_reskategori  = @$this->getKategoriNama(self::EKSAKTA_FK)->kategoriNama;
            // }
            // else if (in_array($prodiId, self::DOKTER_GIGI)) 
            // {
            //     $_reskategori  = @$this->getKategoriNama(self::EKSAKTA_FKG)->kategoriNama;
            // }
            // else if(@$isEsakta->prodiIsEksakta)
            // {
            //     $_reskategori  = @$this->getKategoriNama(self::EKSAKTA)->kategoriNama;
            // }
            // else
            // {
            //     $_reskategori  = @$this->getKategoriNama(self::NON_EKSAKTA)->kategoriNama;
            // }

            $this->db->where('ktgprdProdiId', $prodiId);
            $this->db->join('lmmc_r_kategori', 'kategoriId = ktgprdKategoriId');
            $_kategori = $this->db->get('lmmc_t_kategori_prodi')->row();
            $_reskategori = $_kategori->kategoriNama;

            $all[] =  array(
                'peserta' => $_resPeserta,
                'kategori' => $_reskategori,
                'jalur' => $this->_jalurId,
                'fakultas' => $_resFakultas,
                'klinik' => $_resKlinik,
            );
        }

        return $all;
    }

    function getKategoriNama($idKategori)
    {
        $this->db->where('kategoriId', $idKategori);
        return $this->db->get('lmmc_r_kategori')->row();
    }

    function getKlinik($klinikId)
    {
        $this->db->select('klinikNama');
        $this->db->where('klinikId', $klinikId);
        return $this->db->get('lmmc_m_klinik')->row();
    }

    function getFakultas($prodiId)
    {
        $this->db->from("{$this->simari}.sia_m_fakultas");

        $this->db->join("{$this->simari}.sia_m_jurusan", 'jurFakKode = fakKode');
        $this->db->join("{$this->simari}.sia_m_prodi", "prodiJurKode = {$this->simari}.sia_m_jurusan.jurKode");
        $this->db->where('prodiKode', $prodiId);

        return $this->db->get()->row();
    }

}
