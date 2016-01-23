<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;

/**
 * Description of laundry
 *
 * @author fachrul.choliluddin
 */
class Laundry {
    public function get_sekitar($f3){
        echo 'Ambil laundry sekitar';
    }
    
    public function get_profile($f3){
        $laundry_id = $f3->get('PARAMS.laundry_id');
        echo 'ambil profilnya si '.$laundry_id;
    }
}
