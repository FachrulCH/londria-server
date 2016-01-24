<?php

namespace controllers;

/**
 * Description of User
 *
 * @author fachrul.choliluddin
 */
class CommentsC extends \controllers\Londria {

    public function get_komentar($f3)
    {
        $id = $f3->get('PARAMS.id');
        $komen = new \models\CommentsM();
        $komentar = $komen->get_komen($id);

        foreach ($komentar as $k) {
            $list[] = $k->cast();
        }

        if (count($list) > 0) {
            $this->set_code("01");
            $this->set_msg("Ok");
            $this->set_data("komentar", $list);
        } else {
            $this->set_code("00");
            $this->set_msg("Belum ada komentar");
        }

        $this->return_json();
    }

}
