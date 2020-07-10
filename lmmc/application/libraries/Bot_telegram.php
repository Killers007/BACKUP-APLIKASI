<?php

define('HS', true);
include APPPATH.'/libraries/Bot/bot-api-config.php';
include APPPATH.'/libraries/Bot/bot-api-fungsi.php';

include APPPATH.'/libraries/Bot/bot-api-proses.php';

class Bot_telegram
{
    private $ci;
    function __construct()
    {
        $this->ci = &get_instance();;
    }
 
    function sendMessage($to, $message)
    {
        header('Content-Type: application/json');

        $to = str_replace('g', '-', $to);
        sendApiAction($to);
        sendApiMsg($to, $message);

        return json_encode(['status' => true, 'message' => 'Pesan berhasil dikirim']);
    }

    private function __poling()
    {
        global $debug;

        $idfile = 'botposesid.txt';
        $update_id = 0;

        if (file_exists($idfile)) {
            $update_id = (int) file_get_contents($idfile);
            echo '-';
        }

        $updates = getApiUpdate($update_id);

        foreach ($updates as $message) {
            $update_id = prosesApiMessage($message);

            if ($message['message']['text'] == '/stop') {
                file_put_contents($idfile, $update_id + 1);
                exit;
            }

        }

        file_put_contents($idfile, $update_id + 1);
    }
}
