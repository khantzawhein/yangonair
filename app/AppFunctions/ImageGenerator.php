<?php


namespace App\AppFunctions;
use Intervention\Image\Facades\Image;

class ImageGenerator
{

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
        self::generate($image, $overall, $color, $title_x, $title_y, $text, $align, $text_x, $text_y, $aqi_x, $aqi_y);
    }

    public function generate($image, $overall, $color, int $title_x, int $title_y, string $text, string $align = 'center', int $text_x, int $text_y, int $aqi_x, int $aqi_y): void
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
