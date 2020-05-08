<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppFunctions\LangSwitcher;

class WhatisAQIController extends Controller
{
    //
    function index() {
        $lang = LangSwitcher::switch();
        return view('whatisaqi', compact(['lang']));
    }
}
