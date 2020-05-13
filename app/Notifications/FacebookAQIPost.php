<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;
use App\AppFunctions\helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use App\FbPostTemplate;

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
        $category = helper::getCategory($overall);
        $timeMM = Carbon::now()->locale('my_MM')->isoFormat('A Oh:Om');
        $timeEN = Carbon::now()->locale('en')->isoFormat('h:m A');
        if ($category['level'] == 0) {
            $DB = FbPostTemplate::where('category', "Good")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        else if ($category['level'] == 1) {
            $DB = FbPostTemplate::where('category', "Moderate")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        else if ($category['level'] == 2) {
            $DB = FbPostTemplate::where('category', "UnhealthyForSensitiveGroups")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        else if ($category['level'] == 3) {
            $DB = FbPostTemplate::where('category', "Unhealthy")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        else if ($category['level'] == 4) {
            $DB = FbPostTemplate::where('category', "VeryUnhealthy")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        else if ($category['level'] == 5) {
            $DB = FbPostTemplate::where('category', "Hazardous")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        $templateEN = str_replace([':timeEN', ':aqivalue'], [$timeEN, $overall], $templateEN);
        $templateMM = str_replace([':timeMM', ':aqivalue'], [$timeMM, $overall], $templateMM);
        $content = $templateMM . "\r\n\r\n" . $templateEN;
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
