<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppFunctions\SensorDataStore;
use App\aqitemp;
use App\sensor;
use App\AppFunctions\helper;
use Carbon\Carbon;
class ListsController extends Controller
{
    //
    function index()
    {
        $category = [];
        $sensorAQI = [];
        $aqiDB = aqitemp::orderBy('id', 'desc')->take(1)->get();
        if ($aqiDB->count() == 0)
        {
            SensorDataStore::store();
            $aqiDB = aqitemp::orderBy('id', 'desc')->take(1)->get();
        }
        foreach ($aqiDB as $row)
        {
            for ($i = 0; $i < config("global.sensor_count"); $i++)
            {
                $name = "sensor".$i;
                $sensorAQI[$i] = $row->$name;
                $category[$i] = helper::getCategory($sensorAQI[$i]);
                $colorcode[$i] = helper::getAQIColor($sensorAQI[$i]);
                $updateTime = $row->updated_at;
            }
        }
        $carbonDate = Carbon::parse($updateTime);
        $updated_at = $carbonDate->diffForHumans();
        $sensorDB = sensor::all();
        return view("lists",[
        "sensorAQI" => $sensorAQI,
        "sensorDB" => $sensorDB,
        "category" => $category,
        "colorcode" => $colorcode,
        "updated_at" => $updated_at]);
    }
}
