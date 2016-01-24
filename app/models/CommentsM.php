<?php

namespace models;

/**
 * Description of LaundryM
 *
 * @author fachrul.choliluddin
 */
class CommentsM extends \DB\SQL\Mapper {

    function __construct()
    {
        $f3 = \Base::instance();
        $db = $f3->get('DB');
        parent::__construct($db, 'tb_comments');
    }

    function get_komen($id)
    {
        $this->sender = 'SELECT nama_lengkap FROM tb_users ' .
                'WHERE tb_users.id=tb_comments.id_sender';
        $this->foto = 'SELECT foto FROM tb_users ' .
                'WHERE tb_users.id=tb_comments.id_sender';
        return $this->find(array('id_laundry=:pid', ':pid' => $id), array('order' => 'time ASC'));
    }

}
