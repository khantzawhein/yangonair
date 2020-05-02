<?php

namespace App\AppFunctions;
use Illuminate\Support\Facades\DB;
use App\AppFunctions\helper;
use Illuminate\Support\Facades\Log;

class SensorFetcher
{
    static function fetch($type = NULL)
    {
        /**
        * type = overall or sensorData
        */
        $sensorData = [];
        $sensors = DB::select('select * from sensors');
        $pmValue = [];
        $avgPM = [];
        foreach ($sensors as $sensor)
        {   
            //get pm2.5 values from JSON API for primary and secondary sensors
            $senson_json[$sensor->id] = json_decode(file_get_contents($sensor->api_url), true);
            $pmValue[$sensor->id][0] = json_decode($senson_json[$sensor->id]["results"][0]["Stats"])->pm;
            $pmValue[$sensor->id][1] = json_decode($senson_json[$sensor->id]["results"][1]["Stats"])->pm;
            // check whether primary or secondary isn't working
            if ($pmValue[$sensor->id][0] == 0 && $pmValue[$sensor->id][1] == 0)
            {
                $avgPM[$sensor->id] = NULL;
            }
            elseif ($pmValue[$sensor->id][0] == 0) 
            {
                $avgPM[$sensor->id] = $pmValue[$sensor->id][1];
            }
            elseif ($pmValue[$sensor->id][1] == 0) 
            {
                $avgPM[$sensor->id] = $pmValue[$sensor->id][1];
            }
            else
            {
                $avgPM[$sensor->id] = ($pmValue[$sensor->id][0]+$pmValue[$sensor->id][1])/2.0;
            }

            //raw or AQI
            if($type == 'raw') {
                $sensorData[$sensor->id] = $avgPM[$sensor->id];
            }
            else {
                $sensorData[$sensor->id] = helper::getAQI($avgPM[$sensor->id]);
            }
            
        }
        return $sensorData;
    }

}