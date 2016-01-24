<?php

namespace models;

/**
 * Description of LaundryM
 *
 * @author fachrul.choliluddin
 */
class LaundryM extends \DB\SQL\Mapper {

    private $jarak = 100; // sekitaran X km

    function __construct()
    {
        $f3 = \Base::instance();
        $db = $f3->get('DB');
        parent::__construct($db, 'tb_laundry');
    }

    function get_profil($id)
    {
        return $this->load(array('id=:pid', ':pid' => $id))->cast();
    }

    public function get_sekitar($lokasi)
    {
        $lat = floatval($lokasi['latitude']);
        $lng = floatval($lokasi['longitude']);
        
        return $this->db->exec("SELECT t.*, FLOOR((6371 * ACOS(COS(RADIANS({$lat})) * COS(RADIANS(t.latitude)) * COS(RADIANS(t.longitude) - RADIANS({$lng})) + SIN(RADIANS({$lat})) * SIN(RADIANS(t.latitude))))) AS distance
                            FROM tb_laundry t
                            HAVING distance < {$this->jarak}
                            ORDER BY distance ASC;");
//        $this->distance = "FLOOR((6371 * ACOS(COS(RADIANS(-6.1255871)) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS(106.2249587)) + SIN(RADIANS(-6.1253871)) * SIN(RADIANS(latitude)))))";
//        return $this->find(array('distance<:pid',':pid'=>100),array('order'=>'distance ASC'));
    }

}
