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
        $locale = $request->header('locale');
        if (! in_array($locale, ['en', 'my_MM'])) {
            abort(400);
        } 
        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required',
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = Guest::firstOrNew(['endpoint' => $endpoint]);
        $user->lang = $locale;
        $user->save();
        $user->updatePushSubscription($endpoint, $key, $token);
        self::LatestPush($locale);
        return response()->json(['success' => true,'locale' => $locale],200);
    }

    static function Push() {
        $guests = Guest::all();
        foreach ($guests as $guest) {
            Notification::locale($guest->lang)->send($guest, new DailyAQI);
        }
        return redirect()->back();
    }
    static function LatestPush($locale) {
        Notification::locale($locale)->send(Guest::orderby('id','desc')->take(1)->get(), new DailyAQI);
        return;
    }
}
