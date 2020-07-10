<?php

/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

/**
* Description of Welcome_m
*
* @author 
*/
class Welcome_m extends MY_Model {

    private $_jalurId;
    private $simari;

    public function __construct() {
        parent::__construct();

        $this->simari = $this->load->database('default', TRUE)->database;
        $this->_jalurId = @$this->getJalurActive();
    }

    function getDetailPembayaran()
    {
        $this->db->select('SUM(IF(tagihanBiaya = 0, 1, 0)) as pesertaBeasiswa');
        $this->db->select('SUM(IF(tagihanIsLunas = 1 and tagihanBiaya != 0, 1, 0)) as pembayaranLunas');
        $this->db->select('SUM(IF(tagihanIsLunas = 0, 1, 0)) as pembayaranBelumLunas');

        $this->db->join('lmmc_m_peserta', 'pesertaNoRegis = tagihanNoRegis');
        $this->db->where('tagihanJalurId', $this->_jalurId->jalurId);
        return $this->db->get('lmmc_t_tagihan')->row();
    }

    function getBiaya()
    {
        $this->db->join('lmmc_r_kategori', "kategoriId = biayaKategoriid and biayaJalurid = '{$this->_jalurId->jalurId}'", 'right');
        $dataBiaya =  $this->db->get('lmmc_t_biaya')->result();

        foreach ($dataBiaya as $key => $value) 
        {
            // if ($value->kategoriId == self::EKSAKTA_FK) 
            // {
            //     $this->db->where_in('prodiKode', self::DOKTER);
            // }
            // else if ($value->kategoriId == self::EKSAKTA_FKG) 
            // {
            //     $this->db->where_in('prodiKode', self::DOKTER_GIGI);
            // }
            // else if($value->kategoriId == self::EKSAKTA)
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
            // 
            
            $this->db->where('ktgprdKategoriId', $value->kategoriId);
            $this->db->select('ktgprdProdiId');
            $queryPeserta = $this->db->get_compiled_select("lmmc_t_kategori_prodi");

            $this->db->where_in('pesertaProdiid', $queryPeserta, FALSE);
            $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
            $this->db->join("{$this->simari}.sia_m_prodi", 'prodiKode = pesertaProdiid');
            $dataBiaya[$key]->jumPeserta = $this->db->get('lmmc_m_peserta')->num_rows();
        }

        return $dataBiaya;

    }

    function getProdi($kategoriId, $_queryJumPeserta)
    {
        $this->db->select("fakNamaResmi, fakNamaSingkat, jurNamaResmi, prodiNamaResmi, prodiKode, prodiJjarKode");
        $this->db->select('IFNULL(jumPeserta.jumPeserta, 0) as jumPeserta');

        $this->db->from("{$this->simari}.sia_m_fakultas");
        $this->db->join("{$this->simari}.sia_m_jurusan", 'jurFakKode = fakKode');
        $this->db->join("{$this->simari}.sia_m_prodi", "prodiJurKode = {$this->simari}.sia_m_jurusan.jurKode");

        $this->db->join("({$_queryJumPeserta}) as jumPeserta", 'jumPeserta.pesertaProdiid = prodiKode', 'left');
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

        return $this->db->get()->result();
    }

}
