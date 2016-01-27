<?php

namespace controllers;

/**
 * Description of OrderC
 *
 * @author kurawall
 */
class NotifC {

    private $API_ACCESS_KEY;
    private $msg;
    private $registrationIds;

    public function set_msg($msg)
    {
        $this->$msg = array
            (
            'message' => $msg['message'],
            'title' => $msg['title'],
            'vibrate' => 1,
            'sound' => 1
        );
    }
    
    public function set_recepient($array)
    {
        if (is_array($array)){
        $this->registrationIds = $array;
        }else{
            $this->registrationIds = array($array);
        }
    }

    public function send()
    {
        $fields = array
            (
            'registration_ids' => $this->registrationIds,
            'data' => $this->msg
        );

        $headers = array
            (
            'Authorization: key=' . $this->API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    }

}
