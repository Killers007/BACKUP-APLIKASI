<?php

class Bypass_m extends MY_Model {

    private $table  = 'lmmc_t_bypass';
    private $key    = 'bypassId';

    private $simari;
    private $h2h;

    public $imageLocation = NULL;
    public $imagePeserta = NULL;

    public function __construct() {
        parent::__construct();

        $this->simari = $this->load->database('default', TRUE)->database;
        $this->h2h      = $this->load->database('h2h', TRUE);

        $this->imageLocation = $this->config->item("path_temp_excel");
        $this->imagePeserta = $this->config->item("path_foto_peserta");
        date_default_timezone_set('Asia/Kuala_Lumpur');
    }

    public function rules($update = null) {

        $rules = array(
            array('field' => 'noRegis', 'label' => 'Nomor Peserta', 'rules' => 'required|trim|callback_cek_no_registrasi'),
            array('field' => 'alasanBypass', 'label' => 'Alasan Bypass', 'rules' => 'required|trim'),
            array('field' => 'noTagihan', 'label' => 'Nomor tagihan', 'rules' => 'required|trim'),
        );

        return $rules;
    }

    function renderDatatable($_jalurId = NULL)
    {
        $this->db->select('peserta.*');
        $this->db->select('pr.prodiNamaResmi');
        $this->db->select('fk.fakNamaResmi');
        $this->db->select('tagihan.*');
        $this->db->select('lmmc_t_bypass.*');
        $this->db->where('pesertaJalurid', $_jalurId);

        $this->db->join("{$this->simari}.lmmc_m_peserta peserta", 'pesertaNoregis = bypassNoRegis');
        $this->db->join("{$this->simari}.lmmc_t_tagihan tagihan", 'pesertaNoregis = tagihanNoRegis');
        $this->db->join("{$this->simari}.sia_m_prodi pr", 'pesertaProdiid = prodiKode');
        $this->db->join("{$this->simari}.sia_m_jurusan jr", 'jurKode = prodiJurKode');
        $this->db->join("{$this->simari}.sia_m_fakultas fk", 'jurFakKode = fakKode');
      
        return $this->db->get($this->table);
    }

    function saveImportPeserta($data = array())
    {
        $this->db->insert_batch('lmmc_t_bypass', $data);

        return $data;
    }

    function replaceData($id = null)
    {
        $data = [];
        $data['bypassUsername'] = $this->session->user['username'];
        $data['bypassNoRegis'] = $this->input->post('noRegis', TRUE);
        $data['bypassAlasan'] = $this->input->post('alasanBypass', TRUE);

        if ($this->isLunas($data['bypassNoRegis'])) 
        {
            return ['status' => 'info', 'message' => 'Tagihan Sudah Lunas'];
        }

        if (!$this->db->get_where($this->table, ['bypassNoRegis' => $data['bypassNoRegis']])->num_rows()) 
        {
            $_successBypass = $this->bypassPembayaran($data['bypassNoRegis'], $data['bypassAlasan']);

            if ($_successBypass) {
                $this->db->insert($this->table, $data);
                return ['status' => 'success', 'message' => 'Tagihan H2H Berhasil Di Bypass'];
            }
            else
            {
                return ['status' => 'info', 'message' => 'Tagihan H2H Gagal Di Bypass, karena sudah ada pembayaran'];
            }
        }
        else
        {
            return ['status' => 'info', 'message' => 'Tagihan Sudah Di Bypass Sebelumnya'];
        }
    }

    function isLunas($noRegis)
    {
        $this->db->where('tagihanNoRegis', $noRegis);
        return $this->db->get_where('lmmc_t_tagihan', ['tagihanIslunas' => 1])->num_rows();
    }

    function isAvailabeH2hPembayaran($tagihanVoucher)
    {
        $this->h2h->where('id_record_tagihan', $tagihanVoucher);
        return $this->h2h->get('pembayaran')->num_rows();
    }

    function bypassPembayaran($noRegis, $alasan)
    {
        $_jalurId = $this->model->getJalurActive();
        $_periode = @$_jalurId->jalurTahun.'1';

        $dataPembayaran = $this->_getTagihan($noRegis);

        $insertH2HPembayaran = array(
            'id_record_pembayaran' => $dataPembayaran->tagihanVoucher.'-lmmc-'.$_periode,
            'id_record_tagihan' => $dataPembayaran->tagihanVoucher,
            'waktu_transaksi' => date('Y-m-d H:i:s'),
            'nomor_pembayaran' => $dataPembayaran->tagihanVoucher,
            'kode_bank' => 'BYPASS',
            'kanal_bayar_bank' => 'SI LMMC',
            'kode_terminal_bank' => $this->session->user['username'],
            'total_nilai_pembayaran' => $dataPembayaran->tagihanBiaya,
            'status_pembayaran' => '1',
            'metode_pembayaran' => 'lmmc',
            'catatan' => $alasan,
            'key_val_1' => $dataPembayaran->tagihanVoucher, // No Voucher
            'key_val_2' => $dataPembayaran->tagihanVoucher, // No Voucher
            'key_val_3' => $dataPembayaran->tagihanVoucher, // No Voucher
            'key_val_4' => $dataPembayaran->tagihanBiaya, // Biaya
            'key_val_5' => $_periode,
        );

        if ($this->isAvailabeH2hPembayaran($dataPembayaran->tagihanVoucher)) 
        {
            return false;
        }
        else
        {
            $this->h2h->insert("pembayaran", $insertH2HPembayaran);
            return true;
        }
    }

    private function _getTagihan($noRegis)
    {
        $this->db->select('*');

        $_jalurId = $this->model->getJalurActive();
        $this->db->where('tagihanNoRegis', $noRegis);
        $this->db->where('tagihanJalurId', $_jalurId->jalurId);
        $this->db->join('lmmc_m_peserta', 'pesertaNoregis = tagihanNoRegis');

        return $res = $this->db->get("lmmc_t_tagihan")->row();
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

    public function arrNoRegis()
    {
        // $_jalurId = $this->model->getJalurActive();

        $this->db->select('*');
        // $this->db->where('pesertaJalurid', ($_jalurId->jalurId));

        $res = $this->db->get('lmmc_t_tagihan')->result();

        if (!empty($res)) 
        {
            return array_column($res, 'tagihanNoRegis');
        }

        return [];

    }

    function cariNoRegis($id)
    {
        $this->db->where('tagihanNoRegis', $id);

        $this->db->join("{$this->simari}.lmmc_m_peserta", 'pesertaNoregis = tagihanNoRegis');
        $this->db->join("{$this->simari}.sia_m_prodi", 'pesertaProdiid = prodiKode');
        $this->db->join("{$this->simari}.sia_m_jurusan", 'jurKode = prodiJurKode');
        $this->db->join("{$this->simari}.sia_m_fakultas", 'jurFakKode = fakKode');

        $data = $this->db->get('lmmc_t_tagihan')->row();

        if (empty($data)) 
        {
            return ['status' => 'error', 'message' => 'Data Tidak Ditemukan, Tagihan belum digenerate'];
        }

        return ['status' => 'success', 'message' => 'Data Ditemukan', 'data' => $data];

    }

    public function getTagihan()
    {
        $this->db->select('*');

        $_jalurId = $this->model->getJalurActive();
        $this->db->where('tagihanJalurId', $_jalurId->jalurId);
        $this->db->join('lmmc_m_peserta', 'pesertaNoregis = tagihanNoRegis');
        $this->db->join('lmmc_t_bypass', 'tagihanNoRegis = bypassNoRegis', 'left');

        return $res = $this->db->get("lmmc_t_tagihan")->result();
    } 

    function cekNoRegis($noRegis)
    {
        $_jalurId = $this->model->getJalurActive();

        $this->db->select('*');
        $this->db->where('tagihanNoRegis', $noRegis);
        // $this->db->where('pesertaJalurid', $_jalurId->jalurId);

        return $this->db->get('lmmc_t_tagihan')->row();
    }
}
