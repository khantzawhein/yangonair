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
use App\FbPostTemplate;
use Intervention\Image\Facades\Image;

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
    function postWriter($overall) {
        $category = helper::getCategory($overall);
        $timeMM = Carbon::now()->locale('my_MM')->isoFormat('A Oh:Om');
        $timeEN = Carbon::now()->locale('en')->isoFormat('h:mm A');
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
        return $templateMM . "\r\n\r\n" . $templateEN;
    }
    public function ImageLoader($overall)
    {
        $category = helper::getCategory($overall);
        $level = $category['level'];
        $text = $category['description'];
        $color = '#FFFFFF';
        $align = 'center';
        $text_x = 210;
        $text_y = 610;
        $title_x = 210;
        $title_y = 400;
        $aqi_x = 210;
        $aqi_y = 510;

        if ($level == 0)
        {
            $image = 'loli_good.png';
        }
        elseif ($level == 1)
        {
            $image = 'loli_moderate.png';
            $color = array(0,0,0,0.9);
        }
        elseif ($level == 2) {
            $image = 'loli_usg.png';
            $text = "Unhealthy For\r\nSensitive Groups";
            $text_x = 50;
            $text_y = 900;
            $title_x = 230;
            $title_y = 400;
            $aqi_x = 230;
            $aqi_y = 510;
            $align = 'left';
        }
        elseif ($level == 3)
        {
            $image = 'loli_unhealthy.png';
        }
        elseif ($level == 4)
        {
            $image = 'loli_very_unhealthy.png';
        }
        elseif ($level == 5)
        {
            $image = 'loli_hazardous.png';
        }
        else
        {
            $image = 'loli_unhealthy.png';
        }
        $this->generateImage($image, $overall, $color, $title_x, $title_y, $text, $align, $text_x, $text_y, $aqi_x, $aqi_y);
    }
    public function toFacebookPoster($aqidata)
    {
        $overall = $aqidata->overall;
        $this->ImageLoader($overall);
        $content = $this->postWriter($overall);
        return (new FacebookPosterPost($content))->withImage(public_path('/storage/cache/AQIFB.png'));
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
    public function generateImage($image, $overall, $color, int $title_x, int $title_y, string $text, string $align = 'center', int $text_x, int $text_y, int $aqi_x, int $aqi_y): void
    {
        $img = Image::make(public_path("images/{$image}"));
        $img->text('Air Quality:', $title_x, $title_y, function ($font) use ($color) {
            $font->file(public_path('fonts/Cabin-Bold.ttf'));
            $font->size(50);
            $font->color($color);
            $font->align('center');
        });
        $img->text("{$overall} AQI", $aqi_x, $aqi_y, function ($font) use ($color) {
            $font->file(public_path('fonts/Cabin-Bold.ttf'));
            $font->size(105);
            $font->color($color);
            $font->align('center');
        });
        $img->text($text, $text_x, $text_y, function ($font) use ($color, $align) {
            $font->file(public_path('fonts/Cabin-Bold.ttf'));
            $font->size(47);
            $font->color($color);
            $font->align($align);
        });
        $img->text('YangonAQI', 990, 40, function ($font) use ($color) {
            $font->file(public_path('fonts/Cabin-Bold.ttf'));
            $font->size(33);
            $font->align('right');
            $font->color($color);
        });

        $img->save(public_path('storage/cache/AQIFB.png'));
    }
}
