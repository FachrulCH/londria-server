<?php

namespace models;

/**
 * Description of LaundryM
 *
 * @author fachrul.choliluddin
 */
class OrdersM extends \DB\SQL\Mapper {

    function __construct()
    {
        $f3 = \Base::instance();
        $db = $f3->get('DB');
        parent::__construct($db, 'tb_orders');
    }

}
