<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmMessage;

class OrderCreatedNotification extends Notification
{
    public function via($notifiable)
    {
        return ['fcm'];
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setContent([
                'title' => 'Order Created',
                'body' => 'A new order has been created.',
            ])
            ->setData([
                'order_id' => $notifiable->id,
            ]);
    }
}
