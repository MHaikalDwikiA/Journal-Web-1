<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\Notification as FcmResourceNotification;

class AnnouncementNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    private $announcementId;
    private $title;
    private $description;

    public function __construct(?string $announcementId = null, string $title, string $description)
    {
        $this->announcementId = $announcementId;
        $this->description = $description;
        $this->title = $title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return [FcmChannel::class];
    }

    public function toFcm($notifiable)
    {
        $data = [
            'id' => $this->announcementId,
        ];

        return FcmMessage::create()
            ->setNotification(
                FcmResourceNotification::create()
                    ->setTitle($this->title)
                    ->setBody($this->description)
            )
            ->setData($data)
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('android_push_notif'))
                    ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function fcmProject($notifiable, $message)
    {
        // $message is what is returned by `toFcm`
        return 'app'; // name of the Firebase project to use
    }
}
