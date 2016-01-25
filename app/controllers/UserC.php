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
class UserC extends \controllers\Londria{
    public function tracking($f3) {
        $user_id = $f3->get('PARAMS.user_id');
        echo 'ambil profilnya si '.$user_id;
    }
    
    public function baru($f3){
        $post = $f3->get('POST');
        $data = $f3->scrub($post);
        
        $user = new \models\UsersM();
        $simpan = $user->baru($data);
        
        if ($simpan === 1){
            $this->set_code("00");
            $this->set_msg("Email sudah digunakan");
            $this->set_data("user", []);
        }elseif($simpan === 2){
            $this->set_code("01");
            $this->set_msg("User tersimpan");
            $this->set_data("user", []);
        }else{
            $this->set_code("00");
            $this->set_msg("Terdapat error!");
            $this->set_data("user", []);
        }
        
        $this->return_json();
    }
}
