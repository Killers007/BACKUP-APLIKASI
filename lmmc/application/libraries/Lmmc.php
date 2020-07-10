<?php

class Lmmc {

    private $ci;
    private $key = "4336c1ba641b8f6c98d647915e722f4a";

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->file('application/component/Blowfish.php');
    }

    public function hashPassword($pass)
    {
        $pass = md5($pass);
        return md5($pass.$this->key);
    }

    /**
     * @param int $length
     * @return string
     */
    function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public function encrypt($data) {
        $enc = new Blowfish($this->key, Blowfish::BLOWFISH_MODE_EBC, Blowfish::BLOWFISH_PADDING_NONE);
        $cipher = $enc->encrypt($data, $this->key, Blowfish::BLOWFISH_MODE_EBC);
        return $this->safe_b64encode($cipher);
    }

    public function decrypt($data) {
        $cipher = $this->safe_b64decode($data);
        $enc = new Blowfish($this->key, Blowfish::BLOWFISH_MODE_EBC, Blowfish::BLOWFISH_PADDING_NONE);
        $plain = $enc->decrypt($cipher, $this->key, Blowfish::BLOWFISH_MODE_EBC);
        return $plain;
    }

    private function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    private function safe_b64decode($string) {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
}
