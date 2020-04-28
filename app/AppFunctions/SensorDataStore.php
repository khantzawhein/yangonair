<?php

namespace App\AppFunctions;
use App\AppFunctions\SensorFetcher;
use App\aqitemp;

class SensorDataStore {
    static function store() {
        $sensorData = SensorFetcher::fetch();
        $i = -1;
        $aqitemp = new aqitemp;
        $totalAQI = 0;
        foreach ($sensorData as $key => $value)
        {
            $i++;
            $name = ("sensor".$i);
            $aqitemp->$name = $value;
            $totalAQI += $value;
        }
        $avgAQI = $totalAQI / config("global.sensor_count");
        round($avgAQI);
        $aqitemp->overall = $avgAQI;
        $aqitemp->save();
    }
}