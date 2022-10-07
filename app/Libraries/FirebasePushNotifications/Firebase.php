<?php

/**
 * Created by PhpStorm.
 * User: Hassan Saeed
 * Date: 2/22/2018
 * Time: 4:18 PM
 */

namespace App\Libraries\FirebasePushNotifications;


class Firebase
{


    // sending push message to single user by firebase reg id
    public function send($to, $message, $pushData)
    {
        $fields = array(
            'to' => $to,
            'data' => $message,
            'notification' => $pushData
        );
        return $this->sendPushNotification($fields);
    }

    // Sending message to a topic by topic name
    public function sendToTopic($to, $data, $pushData)
    {
        $fields = array(
            'to' => '/topics/' . $to,
            'data' => $data,
            'notification' => $pushData

        );
        //return $fields;
        return $this->sendPushNotification($fields);
    }

    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message, $pushData)
    {
        $fields = array(
            'registration_ids' => $registration_ids,
            'data' => $message,
            'notification' => $pushData

        );
        return $this->sendPushNotification($fields);
    }

    // function makes curl request to firebase servers
    private function sendPushNotification($fields)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';

        $config = new config();

        $headers = array(
            'Authorization: key=' . $config->getKey(),
            'Content-Type: application/json',
            'Sender: id=' . $config->getSenderID()
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}
