<?php

namespace App\AppFunctions;
use App\AppFunctions\SensorFetcher;
use App\aqitemp;
use App\Raw;

class SensorDataStore {
    static function store() {
        $AQIData = SensorFetcher::fetch();
        $i = -1;
        $aqitemp = new aqitemp;
        $totalAQI = 0;
        foreach ($AQIData as $value)
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

        //pm2.5 data
        $rawData = SensorFetcher::fetch('raw');
        $j = -1;
        $raw = new Raw;
        foreach ($rawData as $value)
        {
            $j++;
            $name = ("sensor".$j);
            $raw->$name = $value;
        }
        $raw->save();
    }
}