<?php

namespace App\AppFunctions;
use Illuminate\Support\Facades\DB;
use App\AppFunctions\helper;

class SensorFetcher
{
    static function fetch()
    {
        /**
        * type = overall or sensorData
        */
        $sensorData = [];
        $sensors = DB::select('select * from sensors');
        $pmValue = [];
        $avgPM = [];
        $url = "http://www.purpleair.com/json?show=";
        foreach ($sensors as $sensor)
        {   
            //get pm2.5 values from JSON API for primary and secondary sensors

            $senson_json[$sensor->sensor_id] = json_decode(file_get_contents($url.$sensor->sensor_id), true);
            $pmValue[$sensor->sensor_id][0] = json_decode($senson_json[$sensor->sensor_id]["results"][0]["Stats"])->pm;
            $pmValue[$sensor->sensor_id][1] = json_decode($senson_json[$sensor->sensor_id]["results"][1]["Stats"])->pm;
            
            // check whether primary or secondary isn't working
            if ($pmValue[$sensor->sensor_id][0] == 0 && $pmValue[$sensor->sensor_id][1] == 0)
            {
                $avgPM[$sensor->sensor_id] = NULL;
            }
            elseif ($pmValue[$sensor->sensor_id][0] == 0) 
            {
                $avgPM[$sensor->sensor_id] = $pmValue[$sensor->sensor_id][1];
            }
            elseif ($pmValue[$sensor->sensor_id][1] == 0) 
            {
                $avgPM[$sensor->sensor_id] = $pmValue[$sensor->sensor_id][1];
            }
            else
            {
                $avgPM[$sensor->sensor_id] = ($pmValue[$sensor->sensor_id][0]+$pmValue[$sensor->sensor_id][1])/2.0;
            }

            //convert to AQI
            $sensorData[$sensor->sensor_id] = helper::getAQI($avgPM[$sensor->sensor_id]);
        }
        return $sensorData;
    }

}