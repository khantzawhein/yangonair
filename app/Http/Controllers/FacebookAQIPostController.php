<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aqitemp;
use App\Notifications\FacebookAQIPost;
use App\FbPostTemplate;

class FacebookAQIPostController extends Controller
{
    //
    static function post()
    {
        if (!FbPostTemplate::first())
        {
           return redirect()->route('fb-settings.index');
        }
        $aqilatest = aqitemp::select('overall')->orderBy('id', 'desc')->take(1)->get();
        $aqilatest[0]->notify(new FacebookAQIPost);
        return redirect()->back();
    }
    
    
}
