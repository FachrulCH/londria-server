<?php

namespace controllers;

/**
 * Description of LaundryC
 *
 * @author fachrul.choliluddin
 */
class Londria {
    /*
     * Status 00=success 01=error
     * 
     */

    private $result_code = "00";
    private $result_msg = "";
    private $result_data = [];
    private $key = "londria";

    public function set_code($code)
    {
        $this->result_code = $code;
    }

    public function set_msg($msg)
    {
        $this->result_msg = $msg;
    }

    public function set_data($name, $data)
    {
        $this->result_data = [$name => $data];
    }

    public function return_json()
    {
        header('Content-type:application/json;charset=utf-8');
        $data["result_code"] = $this->result_code;
        $data["result_msg"] = $this->result_msg;
        $data["result_data"] = $this->result_data;
        echo json_encode($data);
    }

    public function diencode($data)
    {
        //return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
        return rtrim(strtr(base64_encode($this->key.$data), '+/', '-_'), '=');
    }

    public function didecode($data)
    {
        //return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
        return str_replace($this->key, "", base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)));
    }

}
