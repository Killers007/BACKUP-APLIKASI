<?php

class Sinkron_m extends MY_Model
{

    /**
     * @var CI_DB_query_builder
     */
    protected $dbBni;
    private $pathConfig = APPPATH;

    public function __construct()
    {
        parent::__construct();
        $this->dbBni = $this->load->database('h2h', TRUE);
        $this->pathConfig .= "config/sinkron.json";
    }

    public function sinkron($start_date = null, $end_date = null)
    {
        $this->load->library('background');
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $range = ($start_date != null && $end_date != null);
        if ($start_date == null)
            $start_date = $this->getLast();

        $date = new DateTime();

        if ($end_date == null)
            $end_date = $date->format('Y-m-d H:i:s');


        // Select LMMC untuk dicompare ke h2h
        $this->db->select('tagihanVoucher');
        $this->db->from('lmmc_t_tagihan');
        $this->db->order_by('tagihanVoucher');
        $lmmc = $this->db->get();
        $tagihan_lmmc = [];
        foreach ($lmmc->result() as $l) {
            $tagihan_lmmc[] = $l->tagihanVoucher;
        }

        $this->dbBni->select('pembayaran.nomor_pembayaran as tagihanVoucher, total_nilai_pembayaran');
        $this->dbBni->from('tagihan');
        $this->dbBni->join('pembayaran', 'tagihan.id_record_tagihan = pembayaran.id_record_tagihan');
        $this->dbBni->order_by('tagihanVoucher');
        $this->dbBni->where('waktu_transaksi BETWEEN "' . $start_date . '" and "' . $end_date . '"');
        $this->db->where_in('tagihanVoucher', $tagihan_lmmc);

        // waktu tidak ada di tabel pembayaran
        // $this->db->group_by('tagihanVoucher');

        $r = $this->dbBni->get();


        $pem = $r->result_array();

        $success = array();
        $this->db->save_queries = FALSE;

        foreach ($pem as $row) {

            $noregis = $this->getMechaTagihan($row['tagihanVoucher']);
            // if (isset($r->tagihanBiaya)) {

            # code...
            if ($noregis->num_rows()) {
                $r = $noregis->row();
                if ($r->tagihanBiaya == $row['total_nilai_pembayaran']) {

                    //Kirim Pesan 
                    if ($r->tagihanIslunas != "1") {
                        // $this->background->addThread(base_url('Sender/send_message_pembayaran/?X-API-KEY=ptik123'), ['data' => $r]);
                        $this->send_message_pembayaran($r);
                    }

                    $r->tagihanIslunas = "1";
                } else {
                    $r->tagihanIslunas = "2";
                }

                if ($this->db->replace('lmmc_t_tagihan', $r)) {
                    $success[] = $r;
                }
            }

            // }

        }
        if ($range === false) {
            $date->modify("-120 minutes");
            $end_date = $date->format('Y-m-d H:i:s');
            $this->setLast($end_date);
        }
        return $success;
    }

    public function getMechaTagihan($voucher)
    {
        $this->db->select('*');
        $this->db->from('lmmc_t_tagihan');
        $this->db->where('tagihanVoucher', $voucher);
        $r = $this->db->get();
        return $r;
    }

    public function getLast()
    {
        $stringJson = file_get_contents($this->pathConfig);
        $json = json_decode($stringJson, true);
        return $json['last'];
    }

    public function setLast($last)
    {
        $stringJson = file_get_contents($this->pathConfig);
        $json = json_decode($stringJson, true);
        $json['last'] = $last;
        $fp = fopen($this->pathConfig, 'w');
        fwrite($fp, json_encode($json));
        fclose($fp);
    }

    function send_message_pembayaran($data)
    {
        $this->load->helper('telegram');
    
        ini_set('max_execution_time', 0);

        // $_biaya = 'Rp. '.number_format($data->tagihanBiaya,2,',','.');
        $_noHp  = $this->getNoHp($data->tagihanNoRegis);

        // $_message = '';
        // $_message .= "Nama : {$data->tagihanPesertaNama}";
        // $_message .= "Program Studi : {$data->tagihanProdiNama}";
        // $_message .= "Biaya tagihan : {$_biaya}";
        // $_message .= "Status Pembayaran : Lunas";
        // $_message .= "Nomor Telp : {$_noHp}";

        $_message = "Tagihan Anda Dengan Nomor Token {$data->tagihanVoucher} sudah kami terima (Lunas) Terima Kasih";
        
        if ($_noHp) {
            // send_sms($_noHp, $_message);
            kirim_chat($_message);
        }
    }

    function getNoHp($pesertaNoRegis)
    {
        $jalur = $this->getJalurActive();

        $this->db->where('pesertaNoregis', $pesertaNoRegis);
        $res = $this->db->get('lmmc_m_peserta')->row();

        return @$res->pesertaNohp;
    }
}
