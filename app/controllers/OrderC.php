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
        $header = $f3->get("HEADERS");
        $dataHeader = $f3->scrub($header);
        $user_id = $this->didecode($dataHeader['Id']); //harus gede dapannya

//        echo '<pre>';
//        print_r($headers);
//        print_r($post);

        $order = new \models\OrdersM();
        $order->id_user = $user_id;
        $order->id_laundry = $data['id_laundry'];
        $order->alamat = $data['alamat'];
        $order->latitude = $data['tkp']['latitude'];
        $order->longitude = $data['tkp']['longitude'];
        $order->no_tlp = $data['no_tlp'];

        $order->jenis_layanan = $data['jenis_layanan'];
        $order->grand_total = $data['grand_total'];
        $order->produk = $data['produk'];
        $order->catatan = $data['catatan'];
        $order->dibuat = $f3->get('sekarang');
        $order->status = 0;

        $simpan = $order->save();
        if ($order->get('_id') > 1) {
            $this->set_code("01");
            $this->set_msg($order->get('_id'));
            $this->set_data("permintaan", ['OK']);
            $this->return_json();
        } else {
            $this->set_code("00");
            $this->set_msg("Terdapat error pengiriman data ke server");
            $this->set_data("permintaan", ['ERROR']);
            $this->return_json();
        }
    }

    public function get_tracking($f3)
    {
        $post = $f3->get('POST');
        $post = $f3->scrub($post);
        $user_id = $this->didecode($post['id']);

        $order = new \models\OrdersM();
        $tracking = $order->get_tracking($user_id);
        foreach ($tracking as $k) {
            $track = $k->cast();
            
            $prod = json_decode($track['produk']);
            $status = [
                "pertama" => [
                    "status" => 0,
                    "waktu" => ""
                ],
                "kedua" => [
                    "status" => 0,
                    "waktu" => ""
                ],
                "ketiga" => [
                    "status" => 0,
                    "waktu" => ""
                ],
                "keempat" => [
                    "status" => 0,
                    "waktu" => ""
                ]
            ];
            switch ($track['status']) {
                case 1:
                    $status["pertama"] = [
                        "status" => 1,
                        "waktu" => "-"
                    ];

                    break;
                case 2:
                    $status["pertama"] = [
                        "status" => 2,
                        "waktu" => $track['proses_1']
                    ];
                    break;
                case 3:
                    $status["pertama"] = [
                        "status" => 2,
                        "waktu" => $track['proses_1']
                    ];
                    $status["kedua"] = [
                        "status" => 1,
                        "waktu" => "-"
                    ];
                    break;
                case 4:
                    $status["pertama"] = [
                        "status" => 2,
                        "waktu" => $track['proses_1']
                    ];
                    $status["kedua"] = [
                        "status" => 2,
                        "waktu" => $track['proses_2']
                    ];
                    $status["ketiga"] = [
                        "status" => 1,
                        "waktu" => "-"
                    ];
                    break;
                case 5:
                    $status["pertama"] = [
                        "status" => 2,
                        "waktu" => $track['proses_1']
                    ];
                    $status["kedua"] = [
                        "status" => 2,
                        "waktu" => $track['proses_2']
                    ];
                    $status["ketiga"] = [
                        "status" => 2,
                        "waktu" => $track['proses_3']
                    ];
                    break;
                case 6:
                    $status["pertama"] = [
                        "status" => 2,
                        "waktu" => $track['proses_1']
                    ];
                    $status["kedua"] = [
                        "status" => 2,
                        "waktu" => $track['proses_2']
                    ];
                    $status["ketiga"] = [
                        "status" => 2,
                        "waktu" => $track['proses_3']
                    ];
                    $status["keempat"] = [
                        "status" => 1,
                        "waktu" => "-"
                    ];
                    break;
                case 7:
                    $status["pertama"] = [
                        "status" => 2,
                        "waktu" => $track['proses_1']
                    ];
                    $status["kedua"] = [
                        "status" => 2,
                        "waktu" => $track['proses_2']
                    ];
                    $status["ketiga"] = [
                        "status" => 2,
                        "waktu" => $track['proses_3']
                    ];
                    $status["keempat"] = [
                        "status" => 2,
                        "waktu" => $track['proses_3']
                    ];
                    break;
                default:
                    $status = [
                        "pertama" => [
                            "status" => 0,
                            "waktu" => ""
                        ],
                        "kedua" => [
                            "status" => 0,
                            "waktu" => ""
                        ],
                        "ketiga" => [
                            "status" => 0,
                            "waktu" => ""
                        ],
                        "keempat" => [
                            "status" => 0,
                            "waktu" => ""
                        ]
                    ];
                    break;
            }



            $data[] = array(
                "id" => $track['id'],
                "id_laundry" => $track['id_laundry'],
                "nama_laundry" => $track['nama_laundry'],
                "alamat_jemput" => $track['alamat'],
                "tanggal_pesan" => $track['dibuat'],
                "catatan_khusus" => $track['catatan'],
                "jenis_layanan" => $track['jenis_layanan'],
                "layanan" => $prod,
                "grand_total" => $track['grand_total'],
                "proses" => $status
            );
        }

        if (count($data) > 0) {
            $this->set_code("01");
            $this->set_msg("OK");
            $this->set_data("tracking", $data);
        } else {
            $this->set_code("00");
            $this->set_msg("Data transaksi tidak ditemukan");
            $this->set_data("tracking", []);
        }

        $this->return_json();
    }
    
    public function set_delete($f3)
    {
        $post = $f3->get('POST');
        $post = $f3->scrub($post);
        $id = (int) $post['id'];

        $order = new \models\OrdersM();
        $hapus = $order->set_delete($id);
        if ($hapus === 1){
            $this->set_code("01");
            $this->set_msg("Data telah di hapus");
            $this->set_data("delete", []);
        }else{
            $this->set_code("00");
            $this->set_msg("Terdapat kesalahan proses");
            $this->set_data("tracking", []);
        }
        
        $this->return_json();
    }

}
