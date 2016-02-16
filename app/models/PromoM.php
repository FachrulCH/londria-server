<?php

namespace models;

/**
 * Description of LaundryM
 *
 * @author fachrul.choliluddin
 */
class PromoM extends \DB\SQL\Mapper {

    function __construct()
    {
        $f3 = \Base::instance();
        $db = $f3->get('DB');
        parent::__construct($db, 'tb_promo');
    }

    public function get_promo($lokasi)
    {
        $lat = floatval($lokasi['latitude']);
        $lng = floatval($lokasi['longitude']);
        
        return $this->db->exec("SELECT *, FLOOR((6371 * ACOS(COS(RADIANS({$lat})) * COS(RADIANS(B.latitude)) * COS(RADIANS(B.longitude) - RADIANS({$lng})) + SIN(RADIANS({$lat})) * SIN(RADIANS(B.latitude))))) AS distance
                                FROM (
                                SELECT A.*, T.latitude, T.longitude
                                FROM tb_promo A, tb_laundry T
                                WHERE A.id_laundry = T.id AND A.tgl_exp > CURRENT_DATE()) AS B
                                HAVING distance < B.radius
                                ORDER BY distance ASC");
    }

}
