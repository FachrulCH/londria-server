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

    public function baru($data, $google_id)
    {
        $this->reset();
        $this->load(array('email=:pid', ':pid' => $data['email']));
        $status = 0;
        $aidi = $this->id;
        if (!is_null($aidi)) {
            $status = 1; // email sudah di gunakan
        } else {
            $this->nama_lengkap = $data['nama'];
            $this->telp = $data['no_tlp'];
            $this->email = $data['email'];
            $this->foto = $data[''];
            $this->gender = $data['gender'];
            $this->latitude = $data['posisi']['latitude'];
            $this->longitude = $data['posisi']['longitude'];
            $this->katasandi = md5($data['katasandi']);
            $this->google_id = $google_id;
            $this->save();
            
            $uid = $this->get('_id');
            if ($uid > 1) {
                $status = 2; // berhasil di simpan
            } else {
                $status = 3; // unexpected error
            }
        }

        return ["status"=>$status, "uid"=>$uid];
    }

    public function simpan($data)
    {
        //$this->reset();
        $this->load(array('email=:pid', ':pid' => $data['email']));
        $status = 0;
        if (count($this) > 0) {
            // email ketemu
            $this->nama_lengkap = $data['nama'];
            $this->telp = $data['no_tlp'];
            $this->email = $data['email'];
            $this->foto = $data[''];
            $this->gender = $data['gender'];
            $this->latitude = $data['posisi']['latitude'];
            $this->longitude = $data['posisi']['longitude'];

            $this->save();
            $status = 2; // berhasil di simpan
        } else {
            $status = 1; // gada perubahan
        }

        return $status;
    }
    
    public function masuk($email, $paswd)
    {
        return $this->load(array('email=? AND katasandi=?', $email, md5($paswd)));
    }

}
