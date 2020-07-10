<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function telegram1($judul,$chat_id) {

    $pesan = $judul;
    $postdata = http_build_query(
        array(
            'chat_id'  => $chat_id,
            'pesan'    => $pesan,
        )
    );
    $opts = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata,
        ),
    );

    $url = 'http://ptik-bot.herokuapp.com/api/telegram_bot/kirim_pesan';
    $context = stream_context_create($opts);
    $result  = file_get_contents($url, false, $context);
}

function kirim_chat($pesan) 
{
    $bot_token = "1069470990:AAGXC3EcEl2p-fIeem_lzQ5h48DPKSbr94A";
    $group = "391228607";
    $url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage?chat_id=-{$group}&text=" . $pesan;
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result,true);
    return (@$response['ok'] == 1);
}

function send_sms($no_hp,$pesan){
    $data = [
        'username='.urlencode("ulminfo"),
        'password='.urlencode("3384Th92"),
        'sender='.urlencode('ULM INFO'),
        'msisdn='.urlencode($no_hp),
        'message='.urlencode($pesan)
    ];

    $res = file_get_contents("https://portal.smsblast.id/api/sendsingle.json?".implode("&",$data));
    $response = json_decode($res,true);
    return ($response['code'] === 1);
}



?>