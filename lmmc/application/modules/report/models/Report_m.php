<?php

class Report_m extends MY_Model {

    private $simari;
    public $_jalurId;

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

    function renderDatatable($klinikId, $kategoriId, $_queryJumPeserta, $_querySudahPeriksa)
    {
        $this->db->select('fakNamaResmi, fakNamaSingkat, jurNamaResmi, prodiNamaResmi, prodiKode');
        $this->db->select("({$_queryJumPeserta})as jumPeserta");
        $this->db->select("({$_querySudahPeriksa})as sudahPeriksa");
        $this->db->from("{$this->simari}.sia_m_fakultas");
        $this->db->join("{$this->simari}.sia_m_jurusan", 'jurFakKode = fakKode');
        $this->db->join('sia_m_prodi', "prodiJurKode = {$this->simari}.sia_m_jurusan.jurKode");

        if ($kategoriId == self::EKSAKTA_FK) 
        {
            $this->db->where_in('prodiKode', self::DOKTER);
        }
        else if ($kategoriId == self::EKSAKTA_FKG) 
        {
            $this->db->where_in('prodiKode', self::DOKTER_GIGI);
        }
        else if($kategoriId == self::EKSAKTA)
        {
            $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
            $this->db->where_not_in('prodiKode', $_dokterCombine);
            $this->db->where('prodiIsEksakta', '1');
        }
        else
        {
            $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
            $this->db->where_not_in('prodiKode', $_dokterCombine);
            $this->db->where('prodiIsEksakta', '0');
        }

        return $this->db->get();
    }

    public function _queryJumPeserta()
    {
        $this->db->select('COUNT(pesertaNoregis)');
        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        $this->db->where('pesertaProdiid = prodiKode');
        return $this->db->get_compiled_select('lmmc_m_peserta');
    }

    public function _querySudahPeriksa($klinikId)
    {
        $this->db->select('COUNT(hasilId)');
        $this->db->join('lmmc_t_hasilpemeriksaan', "hasilPesertaid = pesertaNoregis");
        $this->db->join('lmmc_m_klinikdetil', "knkdtId = hasilKnkdtid");

        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        $this->db->where('knkdtKlinikid', $klinikId);
        $this->db->where('prodiKode = pesertaProdiid');

        return $this->db->get_compiled_select('lmmc_m_peserta');
    }

    function reportJumlah($klinikId, $kategoriId = '3')
    {

        $_queryJumPeserta   = $this->_queryJumPeserta();
        $_querySudahPeriksa = $this->_querySudahPeriksa($klinikId);

        $this->db->select('fakNamaResmi, fakNamaSingkat, jurNamaResmi, prodiNamaResmi, prodiKode');
        $this->db->select("({$_queryJumPeserta})as jumPeserta");
        $this->db->select("({$_querySudahPeriksa})as sudahPeriksa");
        $this->db->from("{$this->simari}.sia_m_fakultas");
        $this->db->join("{$this->simari}.sia_m_jurusan", 'jurFakKode = fakKode');
        $this->db->join('sia_m_prodi', "prodiJurKode = {$this->simari}.sia_m_jurusan.jurKode");

        if ($kategoriId == self::EKSAKTA_FK) 
        {
            $this->db->where_in('prodiKode', self::DOKTER);
        }
        else if ($kategoriId == self::EKSAKTA_FKG) 
        {
            $this->db->where_in('prodiKode', self::DOKTER_GIGI);
        }
        else if($kategoriId == self::EKSAKTA)
        {
            $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
            $this->db->where_not_in('prodiKode', $_dokterCombine);
            $this->db->where('prodiIsEksakta', '1');
        }
        else
        {
            $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
            $this->db->where_not_in('prodiKode', $_dokterCombine);
            $this->db->where('prodiIsEksakta', '0');
        }

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

    private function headerTanggal($klinikId, $kategoriId)
    {
        $this->db->join('sia_m_prodi', "prodiKode = pesertaProdiid");
        $this->db->join('lmmc_t_hasilpemeriksaan', "hasilPesertaid = pesertaNoregis");
        $this->db->join('lmmc_m_klinikdetil', "knkdtId = hasilKnkdtid");
        $this->db->join('lmmc_m_klinik', "knkdtKlinikid = klinikId");

        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        $this->db->where('klinikId', $klinikId);
        $this->db->order_by('hasilTanggal', 'asc');

        if ($kategoriId == self::EKSAKTA_FK) 
        {
            $this->db->where_in('prodiKode', self::DOKTER);
        }
        else if ($kategoriId == self::EKSAKTA_FKG) 
        {
            $this->db->where_in('prodiKode', self::DOKTER_GIGI);
        }
        else if($kategoriId == self::EKSAKTA)
        {
            $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
            $this->db->where_not_in('prodiKode', $_dokterCombine);
            $this->db->where('prodiIsEksakta', '1');
        }
        else
        {
            $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
            $this->db->where_not_in('prodiKode', $_dokterCombine);
            $this->db->where('prodiIsEksakta', '0');
        }

        $data = $this->db->get('lmmc_m_peserta')->result();

        foreach ($data as $key => $value) {
            $data[$key] = date('d/m/Y', strtotime($value->hasilTanggal));
        }

        return $data;
    }   

    private function getJumlahPadaTanggal($klinikId, $prodiId)
    {

        $this->db->select('COUNT(DATE(hasiltanggal)) jumlah');
        $this->db->select('DATE(hasiltanggal) hasilTanggal');

        $this->db->select('pesertaNoregis, pesertaNoregis, pesertaNama, pesertaJalurid, klinikId');
        $this->db->select('knkdtNamahasil, klinikNama, hasilTanggal');

        $this->db->join('sia_m_prodi', "pesertaProdiid = prodiKode");
        $this->db->join('lmmc_t_hasilpemeriksaan', "hasilPesertaid = pesertaNoregis");
        $this->db->join('lmmc_m_klinikdetil', "knkdtId = hasilKnkdtid");
        $this->db->join('lmmc_m_klinik', "knkdtKlinikid = klinikId");

        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        $this->db->where('prodiKode', $prodiId);
        $this->db->where('klinikId', $klinikId);
        $this->db->order_by('hasilTanggal', 'asc');

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

        if ($kategoriId == self::EKSAKTA_FK) 
        {
            $this->db->where_in('prodiKode', self::DOKTER);
        }
        else if ($kategoriId == self::EKSAKTA_FKG) 
        {
            $this->db->where_in('prodiKode', self::DOKTER_GIGI);
        }
        else if($kategoriId == self::EKSAKTA)
        {
            $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
            $this->db->where_not_in('prodiKode', $_dokterCombine);
            $this->db->where('prodiIsEksakta', '1');
        }
        else
        {
            $_dokterCombine = array_merge(self::DOKTER, self::DOKTER_GIGI);
            $this->db->where_not_in('prodiKode', $_dokterCombine);
            $this->db->where('prodiIsEksakta', '0');
        }

        $res = $this->db->get('sia_m_prodi')->result();

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

            $isEsakta = $this->db->get_where('sia_m_prodi', ['prodiKode' => $prodiId])->row();

            if (in_array($prodiId, self::DOKTER)) 
            {
                $_reskategori  = @$this->getKategoriNama(self::EKSAKTA_FK)->kategoriNama;
            }
            else if (in_array($prodiId, self::DOKTER_GIGI)) 
            {
                $_reskategori  = @$this->getKategoriNama(self::EKSAKTA_FKG)->kategoriNama;
            }
            else if(@$isEsakta->prodiIsEksakta)
            {
                $_reskategori  = @$this->getKategoriNama(self::EKSAKTA)->kategoriNama;
            }
            else
            {
                $_reskategori  = @$this->getKategoriNama(self::NON_EKSAKTA)->kategoriNama;
            }

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
        $this->db->join('sia_m_prodi', "prodiJurKode = {$this->simari}.sia_m_jurusan.jurKode");
        $this->db->where('prodiKode', $prodiId);

        return $this->db->get()->row();
    }

}
