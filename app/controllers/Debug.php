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
        print_r($f3->get("HEADERS"));
    }
    
    public function sekitar($f3)
    {
        $lokasi = [];
        $laundry = new \models\LaundryM();
        $list = $laundry->get_sekitar($lokasi);
        echo '<pre>';
        print_r($list);
    }

}
