<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sensor;
use App\aqitemp;
use App\AppFunctions\helper;
use App\AppFunctions\LangSwitcher;
use Carbon\Carbon;

class MapController extends Controller
{
    //
    function index() {
        $lang = LangSwitcher::switch();
        $sensorDB = sensor::all();
        $aqiDB = aqitemp::orderBy('id', 'desc')->take(1)->get();
        $today = Carbon::today();
        for ($i = 0; $i < config('global.sensor_count'); $i++) {
            $name = 'sensor'.$i;
            $maxAQI[$i] = aqitemp::where('created_at', '>=', $today)->max($name);
            $minAQI[$i] = aqitemp::where('created_at', '>=', $today)->min($name);
            $avgAQI[$i] = round(aqitemp::where('created_at', '>=', $today)->avg($name));
            $minColor[$i] = helper::getAQIColor($minAQI[$i]);
            $maxColor[$i] = helper::getAQIColor($maxAQI[$i]);
            $avgColor[$i] = helper::getAQIColor($avgAQI[$i]);
        }
        
        foreach ($aqiDB as $row) {
            for ($i = 0; $i < config("global.sensor_count"); $i++) {
                $name = "sensor".$i;
                $AQIData[$i] = $row->$name;
                $colorname[$i] = helper::getAQIColorName($AQIData[$i]);
                $category[$i] = helper::getCategory($AQIData[$i]);
                $colorcode[$i] = helper::getAQIColor($AQIData[$i]);
            }
        }
        return view('maps', compact(["sensorDB", "AQIData", "colorname", "colorcode"
                             ,"category", "maxAQI", "minAQI", "avgAQI", "maxColor", "minColor", "avgColor"]));
    }
}
