<?php

/**
 * Description of Users
 *
 * @author fachrul.choliluddin
 */
namespace models;

class UsersM extends \DB\SQL\Mapper{
    public $cek;
    
    function __construct() {
        $f3 = \Base::instance();
        $db = $f3->get('DB');
        // This is where the mapper and DB structure synchronization occurs
        parent::__construct($db, 'tb_users');       
    }
    function populate(){
        return  $this->fields();
    }
}
