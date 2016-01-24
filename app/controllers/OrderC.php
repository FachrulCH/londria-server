<?php

namespace controllers;
/**
 * Description of OrderC
 *
 * @author kurawall
 */
class OrderC extends \controllers\Londria {
    public function insert($f3)
    {
        $post = $f3->get('POST');
        $data = $f3->scrub($post);
        $headers = $f3->get('HEADERS');
        $data = $f3->scrub($headers);
        
        echo '<pre>';
        print_r($headers);
        print_r($post);
    }
}
