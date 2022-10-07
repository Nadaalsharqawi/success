<?php

namespace App\Libraries;

use App\Libraries\FirebasePushNotifications\Firebase;
use App\Libraries\FirebasePushNotifications\Push;
use App\Models\User;
use App\Models\UserNotification;

class PushNotification
{

    public function sendPushNotification($push_type = null, $regIds = null, $message = null, $title = null, $dataId = null, $notification_id, $screen = "/", $order = null, $offer = null)
    {
        $push = new Push();
        $dataLoad = array();
        // optional payload
        $dataLoad['data'] = $message;
        $dataLoad['id'] = ($dataId) ? $dataId : null;
        $dataLoad['order'] = ($order) ? $order : null;
        $dataLoad['offer'] = ($offer) ? $offer : null;
        $scr = [
            'screen' => $screen,
            'id' => $dataLoad['id'],
        ];
        $dataLoad['badge'] = 1;
        $push->setScreen($scr);
        $push->setTitle($title);
        $push->setBadge(1);
        $push_type = isset($push_type) ? $push_type : 'individual';
        $include_image = isset($_GET['include_image']) ? TRUE : FALSE;
        $push->setMessage($message);
        $firebase = new Firebase();
        if ($include_image) {
            $push->setImage('https://api.androidhive.info/images/minion.jpg');
        } else {
            $push->setImage('');
        }

        $push->setIsBackground(TRUE);
        $push->setData($dataLoad);
        $response = '';
        if ($push_type == 'multi') {
            $json = $push->getPushData();
            $push = $push->getPushNotification();
            $response = $firebase->sendMultiple($regIds, $json, $push);
            $users = User::whereIn('fcm_token', $regIds)->get();
            foreach ($users as $user) {
                UserNotification::create([
                    'user_id' => $user->id,
                    'notification_id' => $notification_id,
                    'is_read' => 0,
                ]);
            }
        }
        return $response;
    }
}
