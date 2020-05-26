<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;
use App\AppFunctions\helper;
use Intervention\Image\Facades\Image;
use App\AppFunctions\PostWriter;
use App\AppFunctions\ImageGenerator;

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
     * @param $overall
     * @return MailMessage
     */


    public function toFacebookPoster($aqidata)
    {
        $overall = $aqidata->overall;
        $imageGen = new ImageGenerator();
        $filename = $imageGen->ImageLoader($overall);
        $content = PostWriter::write($overall);
        return (new FacebookPosterPost($content))->withImage(public_path("/storage/cache/{$filename}.png"));
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

    /**
     * @param $image
     * @param $overall
     * @param $color
     * @param int $title_x
     * @param int $title_y
     * @param string $text
     * @param string $align
     * @param int $text_x
     * @param int $text_y
     * @param int $aqi_x
     * @param int $aqi_y
     */

}
