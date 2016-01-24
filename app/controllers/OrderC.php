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
        
//        echo '<pre>';
//        print_r($headers);
//        print_r($post);
        
        $order = new \models\OrdersM();
        $order->id_user = $headers['Id'];
        $order->id_laundry = $post['id_laundry'];
        $order->alamat = $post['alamat'];
        $order->latitude = $post['tkp']['latitude'];
        $order->longitude = $post['tkp']['longitude'];
        $order->no_tlp = $post['no_tlp'];
        
        $order->jenis_layanan = $post['jenis_layanan'];
        $order->grand_total = $post['grand_total'];
        $order->produk = $post['produk'];
        $order->catatan = $post['catatan'];
        $order->dibuat = $f3->get('sekarang');
        $order->status = 0;
        
        $simpan = $order->save();
        if ($order->get('_id') > 1){
            $this->set_code("01");
            $this->set_msg("Permintaan telah dikirimkan, harap menunggu konfirmasi laundry");
            $this->set_data("permintaan", ['OK']);
            $this->return_json();
        }else{
            $this->set_code("00");
            $this->set_msg("Terdapat error pengiriman data ke server");
            $this->set_data("permintaan", ['ERROR']);
            $this->return_json();
        }
    }
}
