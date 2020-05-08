<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;
use App\AppFunctions\helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class FacebookAQIPost extends Notification
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
        return [FacebookPosterChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    function postWriter($overall) {
        App::setLocale('my_MM');
        $category = helper::getCategory($overall);
        $timeMM = Carbon::now()->locale('my_MM')->isoFormat('A Oh:Om');
        // $timeEN = Carbon::now()->locale('en')->isoFormat('h:m A');
        if ($category['level'] == 0) {
            $advise = __('index.advise_good');
        }
        else if ($category['level'] == 1) {
            $advise = __('index.advise_moderate');
        }
        else if ($category['level'] == 2) {
            $advise = __('index.advise_unhealthy_sensitive');
        }
        else if ($category['level'] == 3) {
            $advise = __('index.advise_unhealthy');
        }
        else if ($category['level'] == 4) {
            $advise = __('index.advise_very_unhealthy');
        }
        else if ($category['level'] == 5) {
            $advise = __('index.advise_hazardous');
        }
        $advise = trim(preg_replace("/\s+/", '', $advise));
        $content = __('fbpost.title',['timeMM'=>$timeMM, 'aqivalue' => $overall])."\r\n". $category['description'] . "\r\n". $advise . "\r\n" .__('fbpost.footer');
        return $content;
    }
    
    public function toFacebookPoster($aqidata)
    {   
        $overall = $aqidata->overall;
        $content = $this->postWriter($overall);
        $colorcode =  ltrim(helper::getAQIColor($overall), '#');
        $foregroundColor = ($colorcode == "ffff00" || $colorcode == "00e400" || $colorcode == "ff7e00") ? "000000" : "ffffff";
        $imageUrl = "https://dummyimage.com/800X600/".$colorcode."/".$foregroundColor.".png&text=".$overall;
        return (new FacebookPosterPost($content))->withImage($imageUrl);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
