<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;

/**
 * Description of Debug
 *
 * @author fachrul.choliluddin
 */
class Debug {

    //put your code here
    public function koneksi($f3)
    {
        echo '<pre>';
        print_r($f3);
    }

    public function getlayanan()
    {
        $id = 1;
        $get_layanan = new \models\LayananM();
        $list = $get_layanan->get_data($id);
        echo '<pre>';
        $layanans = [];
        foreach ($list as $row) {
            $layanan["id"] = $row->id_layanan;
            if ($row->tipe == "1") {
                $layanan["harga_kiloan"] = $row->harga;
            } else if ($row->tipe == "2") {
                $layanan["harga_satuan"] = $row->harga;
            } else if ($row->tipe == "3") {
                $layanan["harga_dc"] = $row->harga;
            }
            array_push($layanans, $layanan);
        }

        print_r($layanans);
        //print_r($list);
    }

    public function status($f3)
    {
        //$f3->error(401);
    }

    public function header($f3)
    {
        $header = $f3->get("HEADERS");
        $post = $f3->get('POST');
        
        echo $post['nama']. " ". $header['Regid'];
    }

    public function sekitar($f3)
    {
        $lokasi = [];
        $laundry = new \models\LaundryM();
        $list = $laundry->get_sekitar($lokasi);
        echo '<pre>';
        print_r($list);
    }

    function rating()
    {
        $id = 1;
        $rate = new \models\RatingM();
        $r = $rate->get_rating2($id);
        echo '<pre>';
        print_r($r);

        //$key = array_search(5, array_column($r, 'rate'));
        //print_r($key);
    }

    function komen()
    {
        echo '<pre>';
        $kom = new \models\CommentsM();
        print_r($kom->get_komen(1));
    }

    function tracking()
    {
        $order = new \models\OrdersM();

        $data = $order->get_tracking('11');

        foreach ($data as $k) {
            $list[] = $k->cast();
        }

        echo '<pre>';
        //echo "ini dia: ".$data[0]->id_user;
        print_r($list);
    }

    function hapusorder()
    {
        $order = new \models\OrdersM();
        $a = $order->set_delete(5);
        var_dump($a);
    }

    function login()
    {
        $log = new \models\UsersM();
        $login = $log->masuk("kura@wall", "111");

        echo '<pre>';
        $result = is_null($login->id);
        var_dump($result);
        
        
        //print_r($login->cast());
    }

    function notif($f3)
    {
        $apiKey = "AIzaSyB1Xv5kIpUS3h_bZmUcBZKnxsEHHFIYMkU";
        $message = "Langsung dari kampus";
        //$devices = "dvvFRo7ZWHY:APA91bE0Ey_0DRJ6iJV0h5TM75-SI8sP8GcOaNMchpnXESEWzmL8dCX-EWCTPA7b_px9EnCdM_dTDhwyAMbC0xLdarHUeEBOhBsoCIR9UDo7R4E7qkm0AI76O5f52joX8-xBi09nKdI5";
        $devices = "fVTWGRj2K3o:APA91bH9n5sRButOqJKTik4dTgeSjZ4LERpUxgXcq2RcZ8Lynh9LNq4dn9zvGkwzBkFE4a4Der1Wt_NkTaP3WJOtU6gSedyGpDRZOYhE1BdKyfxT8AcMKsUot080_kKqVnCQiFz6pqSm";
        
        $data = array(
            "title" => "Oke baiklah",
            "message" => "Kurir kami sedang menuju ke lokasi kamu",
            //"image" => "https://dl.dropboxusercontent.com/u/887989/antshot.png",
            "content-available" => "1",
            "tautan" => "pg-tracking.html",
            "waktu" => $f3->get('sekarang'),
            "detailan" => "ini adalah detail info",
            "gambar" => "https://dl.dropboxusercontent.com/u/887989/antshot.png"
        );


        $notif = new \controllers\GCMPushMessage($apiKey);
        $notif->setDevices($devices);
        $response = $notif->send($message, $data);

        echo $response;
    }
    
    function tersembunyi(){
        $londria = new \controllers\Londria();
        $msg = 1;
        $a = $londria->diencode($msg);
        echo $a;
        echo '<hr/>';
        echo $londria->didecode($a);
    }
    
    function ftp(){
        
        echo "Mantap ";
        echo "sukses";
    }

}
