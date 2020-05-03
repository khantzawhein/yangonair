<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppFunctions\SensorDataStore;
use App\AppFunctions\helper;
use App\aqitemp;
use Carbon\Carbon;

class IndexController extends Controller
{
    //
    
    function index()
    {
        $aqiDB = aqitemp::orderBy('id', 'desc')->take(1)->get();
        $today = Carbon::today();
        $maxAQI = aqitemp::where('created_at', '>=', $today)->max('overall');
        $minAQI = aqitemp::where('created_at', '>=', $today)->min('overall');
        $avgAQI = round(aqitemp::where('created_at', '>=', $today)->avg('overall'));
        if ($aqiDB->count() == 0)
        {
            SensorDataStore::store();
            $aqiDB = aqitemp::orderBy('id', 'desc')->take(1)->get();
        }
        $i = -1;
        
        foreach ($aqiDB as $row)
        {
            $updateTime = $row->updated_at;
            $overall = $row->overall;
        }
        $carbonDate = Carbon::parse($updateTime);
        $updated_at = $carbonDate->diffForHumans();
        $colorCode = helper::getAQIColor($overall);
        $minColor = helper::getAQIColor($minAQI);
        $maxColor = helper::getAQIColor($maxAQI);
        $avgColor = helper::getAQIColor($avgAQI);
        $category = helper::getCategory($overall);
        return view("index",compact(
            ["overall", "category", "colorCode", "maxAQI", "minAQI", 
            "avgAQI", "updated_at", "maxColor", "minColor", "avgColor"]));
    }
}
