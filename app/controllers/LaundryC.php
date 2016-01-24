<?php

namespace controllers;

/**
 * Description of LaundryC
 *
 * @author fachrul.choliluddin
 */
class LaundryC extends \controllers\Londria {

    public function row2data($row)
    {

        if (!is_array($row)) {
            $row = (array) $row;
        }
        $id_laundry = $row['id'];
        $lay = new \models\LayananM();
        $rate = new \models\RatingM();

        $layanan = $lay->get_layanan($id_laundry);
        $rating = $rate->get_rating2($id_laundry);

        return array(
            "id" => $row['id'],
            "nama" => $row['nama'],
            "posisi" => [
                "latitude" => $row['latitude'],
                "longitude" => $row['longitude']
            ],
            "alamat" => $row['alamat'],
            "buka" => "Setiap hari, 09:00-22:00",
            "foto" => $row['foto'],
            "foto_cover" => $row['foto_cover'],
            "desc" => $row['desc'],
            "rating" => $row['rating'],
            "rating_detail" => $rating,
            "transaksi" => $row['transaksi'],
            "telp" => $row['telp'],
            "bisa_kiloan" => !!$row['bisa_kiloan'],
            "bisa_dryCleaning" => !!$row['bisa_dryCleaning'],
            "bisa_satuan" => !!$row['bisa_satuan'],
            "layanan" => $layanan,
            "komentar" => [],
            "minimal" => [
                "_1" => $row['min_kiloan'],
                "_2" => $row['min_satuan'],
                "_3" => $row['min_drycleaning']
                ],
            "pengerjaan" => $row['pengerjaan']
        );
    }

    public function get_profil($f3)
    {
        $id = $f3->get('PARAMS.id');
        $id = $f3->scrub($id);
        $laundry = new \models\LaundryM();

        $row = $laundry->get_profil($id);
        if ($row['id'] === NULL) {
            $this->set_code("00");
            $this->set_msg("Data Tidak ditemukan");
        } else {
            $this->set_code("01");
            $this->set_msg("OK");
            $londri = $this->row2data($row);
            $this->set_data("profil", $londri);
        }
        $this->return_json();
    }

    public function get_sekitar($f3)
    {
        $lokasi = $f3->get('POST.location');
        $lokasi = $f3->scrub($lokasi);
        
        $laundry = new \models\LaundryM();
        $list = $laundry->get_sekitar($lokasi);

        $this->set_code("01");
        $this->set_msg("OK");
        //$londri = $this->row2data($list);

        foreach ($list as $data) {
            $londri[] = $this->row2data($data);
        }
        $this->set_data("laundry", $londri);
        //echo '<pre>';
        //print_r($londri);
        $this->return_json();
    }

}
