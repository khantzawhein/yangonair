<?php 

namespace App\AppFunctions;
use Illuminate\Support\Facades\App;

class LangSwitcher {
    static function switch() {
        if(session()->has('locale')) {
            $locale = session('locale');
            if (! in_array($locale, ['en', 'my_MM'])) {
                App::setLocale('en');
                return 'en';
            }
            else {
                App::setLocale($locale);
                return $locale;
            }
        }
        else {
            session(['locale'=>'en']);
            return 'en';
        }
    }
}