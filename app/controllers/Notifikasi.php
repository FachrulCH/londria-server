<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;

/**
 * Description of Notifikasi
 *
 * @author kurawall
 */
class Notifikasi {

    //put your code here
    public $penerima;
    public $pesan;
    public $error_log;
    public $gcm;

    function __construct()
    {
        $apiKey = "AIzaSyB1Xv5kIpUS3h_bZmUcBZKnxsEHHFIYMkU";
        $this->gcm = new GCMPushMessage($apiKey);
    }

    public function kirim_notif($f3, $id_user = 1)
    {
        $user = new \models\UsersM;
        $google_id = $user->get_google_id($user_id);
        
        
        if ($status == 1) {
            $data = array(
                "title" => "Kami siap menjemput pakaian kamu",
                "message" => "Kurir kami sedang menuju ke lokasi kamu",
                //"image" => "https://dl.dropboxusercontent.com/u/887989/antshot.png",
                "content-available" => "1",
                "tautan" => "pg-tracking.html",
                "waktu" => $f3->get('sekarang'),
                "detailan" => "",
                "gambar" => "http://traksindo.com/londria-server/img/profile/delivery.jpg"
            );
        }
        
        $this->gcm->setDevices($google_id);
        $response = $this->gcm->send("Notifikasi", $data);

        return $response;
    }

}
