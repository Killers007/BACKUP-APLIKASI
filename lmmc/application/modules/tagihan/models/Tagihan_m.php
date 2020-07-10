<?php

class Tagihan_m extends MY_Model {

    private $table  = 'lmmc_t_tagihan';
    private $key    = 'tagihanNoRegis';

    public $_jalurId;
    public $kodeLMMC;

    private $simari = '';
    private $h2h    = '';

    public function __construct() {
        parent::__construct();

        $this->simari   = $this->load->database('default', TRUE)->database;
        $this->h2h      = $this->load->database('h2h', TRUE);
        $this->_jalurId = @$this->getJalurActive();
        $this->kodeLMMC = '94';
    }

    public function rules($update = null) {

        $rules = array(
            array('field' => 'waktu_berlaku', 'label' => 'Waktu Berlaku', 'rules' => 'required|callback_cek_tanggal_mulai'),
            array('field' => 'waktu_berakhir', 'label' => 'Waktu Berakhir', 'rules' => 'required'),
        );

        return $rules;
    }

    function renderDatatable($nim = NULL)
    {
        $this->db->select('*');
        $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);
        $this->db->join("{$this->simari}.sia_m_prodi", 'prodiKode = tagihanProdikode');
        // $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        // $this->db->join('lmmc_m_peserta', 'pesertaNoregis = tagihanNoRegis', 'right');
        // $this->db->join("{$this->simari}.sia_m_prodi", 'prodiKode = pesertaProdiid');

        return $this->db->get($this->table);
    }

    function getBiaya()
    {
        $this->db->join('lmmc_r_kategori', "kategoriId = biayaKategoriid and biayaJalurid = {$this->_jalurId->jalurId}", 'right');
        return $this->db->get('lmmc_t_biaya')->result();
    }

    function isBiayaTidakTerisi()
    {
        $this->db->where('biayaId', null);
        $this->db->join('lmmc_r_kategori', "kategoriId = biayaKategoriid and biayaJalurid = {$this->_jalurId->jalurId}", 'right');

        return $this->db->get('lmmc_t_biaya')->num_rows();
    }

    function isTagihan()
    {
        $this->db->select('tagihanNoRegis');;
        $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);
        $_querytagihan = $this->db->get_compiled_select('lmmc_t_tagihan');

        $this->db->where_not_in("pesertaNoregis", $_querytagihan, FALSE);
        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);
        
        $_num = $this->db->get('lmmc_m_peserta')->num_rows();

        return $_num > 0 ? false : true;
    }

    function generateTagihan($waktu_berlaku, $waktu_berakhir)
    {
        if ($this->isBiayaTidakTerisi()) 
        {
            return ['status' => 'info', 'message' => 'Lengkapi pengaturan biaya terlebih dahulu'];
        }

        // $_voucherAwal = $this->kodeLMMC.substr(date('Y'), 2);
        $_voucherAwal = $this->kodeLMMC;

        $this->db->select('tagihanNoRegis');;
        $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);
        $_querytagihan = $this->db->get_compiled_select('lmmc_t_tagihan');

        $this->db->where_not_in("pesertaNoregis", $_querytagihan, FALSE);
        $this->db->where('pesertaJalurid', @$this->_jalurId->jalurId);

        $this->db->group_start();
        $this->db->where('prodiJjarKode', 'S1');
        $this->db->or_where('prodiJjarKode', 'D3');
        $this->db->group_end();
        
        $this->db->join("{$this->simari}.sia_m_prodi", "pesertaProdiid = prodiKode");
        $this->db->join("{$this->simari}.sia_m_jurusan", "prodiJurKode = {$this->simari}.sia_m_jurusan.jurKode");
        $this->db->join("{$this->simari}.sia_m_fakultas", 'jurFakKode = fakKode');
        // $this->db->limit(9, 0);
        $_dataPeserta = $this->db->get('lmmc_m_peserta')->result();

        $_dataBiaya = $this->getBiaya();
        // $_semester = $this->getSemesterAktif();

        $_insertTagihan = [];
        $_pesNoRegis = [];

        foreach ($_dataPeserta as $key => $value) 
        {
            $_biayaTagihan = null;
            // $_search = [];

            // if (in_array($value->pesertaProdiid, self::DOKTER)) 
            // {
            //     $_kategoriId = self::EKSAKTA_FK;
            //     $_search = current(array_filter($_dataBiaya, function($e) use($_kategoriId) { return $e->biayaKategoriid==$_kategoriId; }));

            //     $_biayaTagihan = @$_search->biayaHarga;
            // }
            // else if (in_array($value->pesertaProdiid, self::DOKTER_GIGI)) 
            // {
            //     $_kategoriId = self::EKSAKTA_FKG;
            //     $_search = current(array_filter($_dataBiaya, function($e) use($_kategoriId) { return $e->biayaKategoriid==$_kategoriId; }));

            //     $_biayaTagihan = @$_search->biayaHarga;

            // }
            // else if($value->prodiIsEksakta)
            // {
            //     $_kategoriId = self::EKSAKTA;
            //     $_search = current(array_filter($_dataBiaya, function($e) use($_kategoriId) { return $e->biayaKategoriid==$_kategoriId; }));

            //     $_biayaTagihan = @$_search->biayaHarga;
            // }
            // else
            // {
            //     $_kategoriId = self::NON_EKSAKTA;
            //     $_search = current(array_filter($_dataBiaya, function($e) use($_kategoriId) { return $e->biayaKategoriid==$_kategoriId; }));

            //     $_biayaTagihan = @$_search->biayaHarga;
            // }

            #Get Kategori
            $this->db->where('biayaJalurid', $this->_jalurId->jalurId);
            $this->db->where('ktgprdProdiId', $value->pesertaProdiid);
            $this->db->join('lmmc_t_biaya', 'biayaKategoriid = ktgprdKategoriId');
            $_kategori = $this->db->get('lmmc_t_kategori_prodi')->row();
            $_biayaTagihan = @$_kategori->biayaHarga;

            $_pesNoRegis[] = $value->pesertaNoregis;
            
            $_noKipNull = ($value->pesertaNomorKIP == '');
            
            $_insertTagihan[$key] = array(
                'tagihanNoRegis' => $value->pesertaNoregis,
                'tagihanPesertaNama' => $value->pesertaNama,
                'tagihanProdiNama' => $value->prodiNamaResmi,
                'tagihanBiaya' => $_noKipNull?$_biayaTagihan:0,
                'tagihanProdikode' => $value->prodiKode,
                // 'tagihanKategori' => $_search->kategoriNama,
                // 'tagihanFakultas' => $value->fakNamaResmi,
                'tagihanVoucher' => $_voucherAwal.$value->pesertaNoregis,
                'tagihanJalurId' => @$this->_jalurId->jalurId,
                'tagihanWaktuberlaku' => $waktu_berlaku,
                'tagihanWaktuberakhir' =>$waktu_berakhir,
                'tagihanIslunas' => $_noKipNull?0:1,
            );

            if ($_noKipNull) 
            {
                $periode = @$this->_jalurId->jalurTahun.'1';

                $_insertH2H[$key] = array(
                    // 'nomor_induk' => $value->pesertaNoregis,
                    'id_record_tagihan' => $_voucherAwal.$periode.$value->pesertaNoregis,
                    'nomor_pembayaran' => $value->pesertaNoregis,
                    'waktu_berlaku' => date('Y-m-d H:i:s', strtotime($waktu_berlaku)),
                    'waktu_berakhir' => date('Y-m-d H:i:s', strtotime($waktu_berakhir)),
                    'strata' => $value->prodiJjarKode,
                    'kode_periode' => $periode,
                    'nama_periode' => @$this->_jalurId->jalurTahun.' - '.'Ganjil',
                    'voucher_nama_periode' => @$this->_jalurId->jalurTahun.' - '.'Ganjil',
                    'nama' => $value->pesertaNama,
                    'kode_fakultas' => $value->fakKode,
                    'nama_fakultas' => $value->fakNamaResmi,
                    'kode_prodi' => $value->prodiKode,
                    'nama_prodi' => $value->prodiNamaResmi,
                    'is_tagihan_aktif' => 1,
                    'total_nilai_tagihan' => $_biayaTagihan,
                    'pembayaran_atau_voucher' => 'VOUCHER',
                    'voucher_nama' => $value->pesertaNama,
                    'voucher_nama_fakultas' => $value->fakNamaResmi,
                    'voucher_nama_prodi' => $value->prodiNamaResmi,
                );
            }
        }


        // return $_insertTagihan;
        $this->db->trans_begin();

        // $this->db->select('tagihanVoucher');
        // $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);
        // $_queryVoucher = $this->db->get_compiled_select('lmmc_t_tagihan');

        // $this->db->where_in('id_record_tagihan', $_queryVoucher, FALSE);
        // $this->db->delete("{$this->h2h}.tagihan");

        // $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);
        // $this->db->delete('lmmc_t_tagihan');

        $count = count($_insertTagihan);

        if (!empty($_insertTagihan)) {
            $this->db->insert_batch('lmmc_t_tagihan', $_insertTagihan);
        }

        if (!empty($_insertH2H)) {
            $this->h2h->insert_batch("tagihan", $_insertH2H);
        }

        if ($this->db->trans_status()) 
        {
            $this->db->trans_commit();


            return ['status' => 'success', 'message' => $count.' Tagihan Selesai Digenerate', 'data' => $_pesNoRegis];
        }
        else
        {
            $this->db->trans_rollback();

            return ['status' => 'error', 'message' => 'Gagal Generate Tagihan'];
        }
    }

    private function getSemesterAktif()
    {
        $_aktif = $this->db->get("{$this->simari}.sia_t_semester_aktif")->row();
        $_semAktif = @$_aktif->semaktifSemester;

        $_tahun = substr($_semAktif, 0, 4);
        $_noSemester = substr($_semAktif, 4, 5);
        
        $this->db->where('semNmsemrId', $_noSemester);
        $this->db->where('semTahun', $_tahun);
        $this->db->join("{$this->simari}.sia_r_nama_semester", 'nmsemrId = semNmsemrId');
        $data = $this->db->get("{$this->simari}.sia_t_semester")->row();
        $data->tahun = $_tahun;
        $data->noSemester = $_noSemester;
        $data->semaktifSemester = $_semAktif;

        return $data;
    }

    function getDetailSms($minify = false)
    {
        $this->db->select('SUM(IF(tagihanPesanIsTerkirim = 1, 1, 0)) terkirim, SUM(IF(tagihanPesanIsTerkirim = 0, 1, 0)) gagal, COUNT(*) total');
        $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);
        $countDown = $this->db->get('lmmc_t_tagihan')->row_array();

        return $countDown;
    }

    function updatePesan($noRegis, $status)
    {
        $this->db->where('tagihanNoRegis', $noRegis);
        $this->db->update('lmmc_t_tagihan', ['tagihanPesanIsTerkirim' => $status]);
    }

    function nextNoRegis($noRegis = null)
    {
        if ($noRegis == null) {
            return null;
        }

        $this->db->limit(1);
        $this->db->order_by('tagihanNoRegis', 'asc');
        $this->db->where('tagihanNoRegis >', $noRegis);

        $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);

        $this->db->group_start();
        $this->db->where('tagihanPesanIsTerkirim', 0);
        $this->db->or_where('tagihanPesanIsTerkirim', null);
        $this->db->group_end();
        $this->db->select('tagihanNoRegis as noRegis');
        $dataPeserta = $this->db->get('lmmc_t_tagihan')->row();

        return @$dataPeserta->noRegis;
    }

    function currentNoRegis()
    {
        $this->db->order_by('tagihanNoRegis', 'asc');

        $this->db->where('tagihanJalurId', @$this->_jalurId->jalurId);

        $this->db->group_start();
        $this->db->where('tagihanPesanIsTerkirim', 0);
        $this->db->or_where('tagihanPesanIsTerkirim', null);
        $this->db->group_end();
        $this->db->select('tagihanNoRegis as noRegis');

        $dataPeserta = $this->db->get('lmmc_t_tagihan')->row();

        return @$dataPeserta->noRegis;
    }

    /**
     * Ambil 1 data
     * @return object [description]
     */
    public function getDataById($id)
    {
        // $id = $this->db->escape($id);

        $this->db->select('*');
        $this->db->join('lmmc_m_peserta', 'pesertaNoregis = tagihanNoRegis');
        $this->db->where($this->key, $id);

        return $this->db->get($this->table)->row();
    } 
}
