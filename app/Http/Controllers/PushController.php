<?php

namespace App\Http\Controllers;

use App\Guest;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DailyAQI;

class PushController extends Controller
{
    //
    function store(Request $request) {
        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = Guest::firstOrCreate(
           ['endpoint' => $endpoint]
        );
        $user->updatePushSubscription($endpoint, $key, $token);
        self::LatestPush();
        return response()->json(['success' => true],200);
    }

    static function Push() {
        Notification::send(Guest::all(), new DailyAQI);
        return redirect('/');
    }
    static function LatestPush() {
        Notification::send(Guest::orderby('id','desc')->take(1)->get(), new DailyAQI);
        return;
    }
}
