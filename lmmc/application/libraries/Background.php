<?php defined('BASEPATH') or exit('No direct script access allowed');

class Background
{
    private $ci;
    function __construct()
    {
        $this->ci = &get_instance();;
    }
 
    function addThread($urlTarget = null, $data = array())
    {
        if ($urlTarget == null) $urlTarget = base_url('sender/send_message?X-API-KEY=ptik123');

        ini_set('max_execution_time', 0);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERAGENT, rand(0, 1000));
        curl_setopt($curl, CURLOPT_URL, $urlTarget);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);
        curl_setopt($curl, CURLOPT_NOBODY,1);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

        $ret = curl_exec($curl);
        curl_close($curl);

        echo $ret;
    }
}
