<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sensor;
use App\aqitemp;
use App\AppFunctions\helper;

class MapController extends Controller
{
    //
    function index() {
        $sensorDB = sensor::all();
        $aqiDB = aqitemp::orderBy('id', 'desc')->take(1)->get();
        foreach ($aqiDB as $row) {
            for ($i = 0; $i < config("global.sensor_count"); $i++) {
                $name = "sensor".$i;
                $AQIData[$i] = $row->$name;
                $colorname[$i] = helper::getAQIColorName($AQIData[$i]);
            }
        }
        return view('maps', ["sensorDB" => $sensorDB,
                             "AQIData" => $AQIData,
                             "colorname" => $colorname]);
    }
}
