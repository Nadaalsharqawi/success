<?php
/**
 * Created by PhpStorm.
 * User: Hassan Saeed
 * Date: 2/22/2018
 * Time: 4:17 PM
 */

namespace App\Libraries\FirebasePushNotifications;


class Push
{
    private $title;
    private $screen;
    private $message;
    private $image;
    private $data;
    private $is_background;
    private $badge;

    /**
     * @return mixed
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @param mixed $badge
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
    }

    /**
     * @return mixed
     */
    public function getScreen()
    {
        return $this->screen;
    }

    /**
     * @param mixed $screen
     */
    public function setScreen($screen)
    {
        $this->screen = $screen;
    }

    function __construct()
    {

    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setImage($imageUrl)
    {
        $this->image = $imageUrl;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setIsBackground($is_background)
    {
        $this->is_background = $is_background;
    }


    public function getPushData()
    {
        $res = array();
        $res['title'] = $this->title;
        $res['body'] = $this->message;
        $res['data'] = $this->data;
        $res['timestamp'] = date('Y-m-d G:i:s');
        $res['click_action'] = "FLUTTER_NOTIFICATION_CLICK";
        $res['screen'] = $this->screen;
        $res['badge'] = $this->badge;
        return $res;

    }


    public function getPushNotification()
    {
        $res = array();
        $res['title'] = $this->title;
        $res['body'] = $this->message;
        $res['additional'] = $this->data;
        $res['timestamp'] = date('Y-m-d G:i:s');
        $res['sound'] = 'default';
        $res['click_action'] = "FLUTTER_NOTIFICATION_CLICK";
        $res['screen'] = $this->screen;
        $res['badge'] = $this->badge;
        return $res;
    }

}
