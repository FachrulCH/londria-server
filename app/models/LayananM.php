<?php

namespace models;

/**
 * Description of LaundryM
 *
 * @author fachrul.choliluddin
 */
class LayananM extends \DB\SQL\Mapper{

    function __construct() {
        $f3 = \Base::instance();
        $db = $f3->get('DB');
        parent::__construct($db, 'tb_layanan');
    }

    function get_data($id) {
        //return $this->load();
        //return $this->find(array('id=?', $id));
        return $this->find(array('id_laundry=:pid',':pid'=>$id),array('order'=>'id_layanan'));
        //$this->find(array('id_laundry=:pid',':pid'=>$id),array('order'=>'id_layanan'));
    }
    
    function get_layanan($id){
        $list = $this->get_data($id);
        $layanans = [];
        foreach ($list as $row) {
            $layanan["id"] = $row->id_layanan;
            if ($row->tipe == "1"){
                $layanan["harga_kiloan"] = $row->harga;
            }else if($row->tipe == "2"){
                $layanan["harga_satuan"] = $row->harga;
            }else if($row->tipe == "3"){
                $layanan["harga_dc"] = $row->harga;
            }
            array_push($layanans, $layanan);
        }
        
        return $layanans;
    }

}
