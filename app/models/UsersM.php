<?php

/**
 * Description of Users
 *
 * @author fachrul.choliluddin
 */

namespace models;

class UsersM extends \DB\SQL\Mapper {

    public $cek;

    function __construct()
    {
        $f3 = \Base::instance();
        $db = $f3->get('DB');
        // This is where the mapper and DB structure synchronization occurs
        parent::__construct($db, 'tb_users');
    }

    public function baru($data)
    {
        //$this->reset();
        $this->load(array('email=:pid', ':pid' => $data['email']));
        $status = 0;
        if (count($this) > 0) {
            $status = 1; // email sudah di gunakan
        } else {
            $this->nama_lengkap = $data['nama'];
            $this->telp = $data['no_tlp'];
            $this->email = $data['email'];
            $this->foto = $data[''];
            $this->gender = $data['gender'];
            $this->latitude = $data['posisi']['latitude'];
            $this->longitude = $data['posisi']['longitude'];

            $this->save();

            if ($this->get('_id') > 1) {
                $status = 2; // berhasil di simpan
            } else {
                $status = 3; // unexpected error
            }
        }
        
        return $status;
    }

}
