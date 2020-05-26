<?php

namespace App\Http\Controllers;

use App\AppFunctions\ImageGenerator;
use App\aqitemp;
use Illuminate\Http\Request;
use App\AppFunctions\SensorDataStore;

class AdminController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        return view('admin.home');
    }
    function refresh() {
        SensorDataStore::store();
        $aqitemp = new aqitemp();
        $data = $aqitemp->latestData();
        $imageGen = new ImageGenerator();
        $imageGen->ImageLoader($data->overall);
        return redirect()->back();
    }

}
