<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class langController extends Controller
{
    //
    function switch(Request $request) {
        $locale = $request->locale;
        session(['locale' => $locale]);
        return redirect()->back();
    }
}
