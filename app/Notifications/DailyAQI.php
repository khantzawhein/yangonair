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
        $aqiDB = aqitemp::select('overall')->orderBy('id', 'desc')->take(1)->get();
        $overall = $aqiDB[0]->overall;
        $category = helper::getCategory($overall);
        $colorcode = $str = ltrim(helper::getAQIColor($overall), '#');
        $url = url('/');
        $foregroundColor = ($colorcode == "ffff00" || $colorcode == "00e400" || $colorcode == "ff7e00") ? "000000" : "ffffff";
        $imageUrl = "https://dummyimage.com/128X128/".$colorcode."/".$foregroundColor.".png&text=".$overall;
        return (new WebPushMessage)
            ->title(__('notification.todayAQI').$category['description'])
            ->icon($imageUrl)
            ->body($category['notification'])
            ->badge('/images/favicon.png')
            ->data(['url' => 'https://www.yangonaqi.live']);
    }
}
