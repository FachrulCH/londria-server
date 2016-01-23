<?php

namespace models;

/**
 * Description of LaundryM
 *
 * @author fachrul.choliluddin
 */
class RatingM extends \DB\SQL\Mapper {

    function __construct() {
        $f3 = \Base::instance();
        $db = $f3->get('DB');
        parent::__construct($db, 'tb_rating');
    }

    function get_rating($id) {
        $rating = $this->load(array('id_laundry=:pid', ':pid' => $id));
        $laundry_rating = array(
            "_1" => $rating->_1,
            "_2" => $rating->_2,
            "_3" => $rating->_3,
            "_4" => $rating->_4,
            "_5" => $rating->_5,
            "_count" => $rating->_count
        );
        return $laundry_rating;
    }

}
