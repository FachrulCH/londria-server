<?php

namespace models;

/**
 * Description of LaundryM
 *
 * @author fachrul.choliluddin
 */
class RatingM extends \DB\SQL\Mapper {

    function __construct()
    {
        $f3 = \Base::instance();
        $db = $f3->get('DB');
        parent::__construct($db, 'tb_rating');
    }

    function get_rating($id)
    {
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

    function get_rating2($id)
    {
        $data = $this->db->exec("select count(1) jum, c.rate from tb_comments c where c.id_laundry = {$id} group by c.rate;");
        
        $key1 = array_search(1, array_column($data, 'rate'));
        $key2 = array_search(2, array_column($data, 'rate'));
        $key3 = array_search(3, array_column($data, 'rate'));
        $key4 = array_search(4, array_column($data, 'rate'));
        $key5 = array_search(5, array_column($data, 'rate'));
        
        $rate1 = (int) (!is_bool($key1))? $data[$key1]['jum']: 0;
        $rate2 = (int) (!is_bool($key2))? $data[$key2]['jum']: 0;
        $rate3 = (int) (!is_bool($key3))? $data[$key3]['jum']: 0;
        $rate4 = (int) (!is_bool($key4))? $data[$key4]['jum']: 0;
        $rate5 = (int) (!is_bool($key5))? $data[$key5]['jum']: 0;

        $laundry_rating = array(
            "_1" => $rate1,
            "_2" => $rate2,
            "_3" => $rate3,
            "_4" => $rate4,
            "_5" => $rate5,
            "_count" => $rate1+$rate2+$rate3+$rate4+$rate5
        );
        return $laundry_rating;
    }

}
