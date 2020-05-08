<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aqitemp;
use App\Notifications\FacebookAQIPost;

class FacebookAQIPostController extends Controller
{
    //
    static function post()
    {
        $aqilatest = aqitemp::select('overall')->orderBy('id', 'desc')->take(1)->get();
        $aqilatest[0]->notify(new FacebookAQIPost);
        return redirect('/');
    }
    
    
}
