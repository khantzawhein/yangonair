<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use App\aqitemp;
use App\AppFunctions\helper;

class DailyAQI extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        $aqiDB = aqitemp::orderBy('id', 'desc')->take(1)->get();
        $overall = $aqiDB[0]->overall;
        $category = helper::getCategory($overall);
        $url = url('/');
        return (new WebPushMessage)
            ->title('Today\'s AQI is '.$overall)
            ->icon('/images/favicon.png')
            ->body($category['notification'])
            ->badge('/images/favicon.png')
            ->data(['url' => $url]);
    }
}
