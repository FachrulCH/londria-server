<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;

/**
 * Description of User
 *
 * @author fachrul.choliluddin
 */
class UserC {
    public function tracking($f3) {
        $user_id = $f3->get('PARAMS.user_id');
        echo 'ambil profilnya si '.$user_id;
    }
    
    public function baru($f3){
        $obj_user = new \models\UsersM();
//        $obj_user->reset();
        $obj_user->nama_lengkap = "kiki";
        $obj_user->cek = "ogi";
        $simpen = $obj_user->save();
        echo "<pre>";
        //var_dump($obj_user->load());
        //$return = $obj_user->load();
        //$return = $obj_user->populate();
        print_r($simpen);
    }
}
