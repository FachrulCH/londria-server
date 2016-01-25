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

    public function get_tracking($id)
    {
        $this->nama_laundry = 'SELECT nama FROM tb_laundry ' .
                'WHERE tb_orders.id_laundry=tb_laundry.id';

        return $this->find(array('id_user=:pid', ':pid' => $id), array('order' => 'dibuat DESC'));
    }
    
    public function set_delete($id)
    {
        $this->load(array('id=:pid', ':pid' => $id), array('order' => 'dibuat DESC'));
        return $this->erase();
    }

}
