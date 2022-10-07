<?php
/**
 * Created by PhpStorm.
 * User: Hassan Saeed
 * Date: 2/22/2018
 * Time: 4:14 PM
 */

namespace App\Libraries\FirebasePushNotifications;


class config
{
    public function __construct()
    {
        $this->key = "AAAAi-g7Pi8:APA91bGtHJVMNvgjKromTwbCSl5biEe3L0Af-Xi4vV56zpB2PZigr2D2CnKS4eL37Yay26skKYNUzTDBHdBo11is0hZWxeGRdAgaXVqwRwBxPHiZS2j9DSxGQEkT6ZyRKwObHbEbJbEH";
        $this->senderID = "600896650799";
    }

    public function getKey()
    {
        return $this->key;
    }

    public $key,$senderID;
    public function getSenderID()
    {
        return $this->key;
    }

}
