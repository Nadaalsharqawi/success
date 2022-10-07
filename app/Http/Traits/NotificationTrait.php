<?php

namespace App\Http\Traits;

trait NotificationTrait
{
    public function getNotificationObject(
        string $title = "ready",
        string $body = "",
        string $providerType = "",
        string $senderProviderType = "",
        string $notificationType = "",
        int $data_id = null,
        $data_object = null
    ) {
        return [
            'title' => $title,
            'body' => $body,
            'providerType' => $providerType,
            'senderProviderType' => $senderProviderType,
            'NotificationType' => $notificationType,
            'data_object' => $data_object,
            'data_id' => $data_id,
        ];
    }

    public function getUsers(array $ids)
    {
        return array_map(function ($value) {
            return (string)$value;
        }, $ids);
    }
}
