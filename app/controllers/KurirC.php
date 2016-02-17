<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;

/**
 * Description of KurirC
 *
 * @author kurawall
 */
class KurirC extends UserC {

    //put your code here
    private $id_laundry;

    public function get_tugas($f3)
    {
        $post = $f3->get('POST');
        $data = $f3->scrub($post);
        $id_kurir = $post['token'];

        $this->set_idLaundry($id_kurir);
        $orders = new \models\OrdersM();
        $tugas = $orders->get_daftar_tugas($this->id_laundry);

        if (count($tugas) > 0) {
            foreach ($tugas as $t) {
                $listTugas[] = array(
                    "id" => $t->id,
                    "id_user" => $t->id_user,
                    "nama_user" => $t->nama_user,
                    "alamat" => $t->alamat,
                    "lokasi" => [
                        "latitude" => $t->latitude,
                        "longitude" => $t->longitude
                    ],
                    "no_tlp" => $t->no_tlp,
                    "jenis_layanan" => $t->jenis_layanan,
                    "grand_total" => $t->grand_total,
                    "produk" => json_decode($t->produk),
                    "catatan" => $t->catatan,
                    "waktu" => $t->dibuat,
                    "status" => $t->status
                );
            }

            $this->set_code("01");
            $this->set_msg("Daftar tugas");
            $this->set_data("tugas", $listTugas);
        } else {
            $this->set_code("00");
            $this->set_msg("Daftar tugas masih kosong");
            $this->set_data("tugas", ["idKurir" => $id_kurir, "id" => $this->id_laundry, "count" => count($tugas)]);
        }

        $this->return_json();
    }

    private function set_idLaundry($id_kurir)
    {
        // buat nge set id_laundry
        $user = new \models\UsersM();
        $kurir = $user->load(array('id=?', $id_kurir));

        $this->id_laundry = $kurir['telp'];
    }

    public function pilih_tugas($f3)
    {
        $post = $f3->get('POST');
        $data = $f3->scrub($post);
        $header = $f3->get("HEADERS");
        $dataHeader = $f3->scrub($header);
        $notes = "takenby:" . $dataHeader['token'];

        $id_tugas = $data['id_tugas'];
        $tugas = new \models\OrdersM();
        $tugas->load(array('id=?', $id_tugas));

        $tugas->status++;
        $tugas->notes = $notes;
        $tugas->save();

        $this->set_code("01");
        $this->set_msg("Tugas dipilih");
        $this->set_data("tugas", ["id_tugas"=>$id_tugas, "status"=>$tugas->status]);
        $this->return_json();
    }

}
