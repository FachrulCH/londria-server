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

    public function set_code($code) {
        $this->result_code = $code;
    }

    public function set_msg($msg) {
        $this->result_msg = $msg;
    }

    public function set_data($name, $data) {
        $this->result_data = [$name => $data];
    }

    public function return_json() {
        header('Content-type:application/json;charset=utf-8');
        $data["result_code"] = $this->result_code;
        $data["result_msg"] = $this->result_msg;
        $data["result_data"] = $this->result_data;
        echo json_encode($data);
    }

}
