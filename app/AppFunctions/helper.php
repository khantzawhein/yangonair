<?php

namespace App\AppFunctions;

class helper{

    static function getAQIColorName($aqi) {
        if ($aqi >= 301) {
          return 'maroon';
        } else if ($aqi >= 201) {
          return 'purple';
        } else if ($aqi >= 151) {
          return 'red';
        } else if ($aqi >= 101) {
          return 'orange';
        } else if ($aqi >= 51) {
          return 'yellow';
        } else if ($aqi >= 0) {
          return 'green';
        } else {
          return 0;
        }
    } 
    static function getAQIColor($aqi) {
        if ($aqi >= 301) {
          return '#7e0023';
        } else if ($aqi >= 201) {
          return '#8f3f97';
        } else if ($aqi >= 151) {
          return '#ff0000';
        } else if ($aqi >= 101) {
          return '#ff7e00';
        } else if ($aqi >= 51) {
          return '#ffff00';
        } else if ($aqi >= 0) {
          return '#00e400';
        } else {
          return 0;
        }
    } 

    static function getOverall(array $AQI)
    {
        $totalAQI = 0;
        $i = 0.0;
        foreach ($AQI as $value)
        {
            $i++;
            $totalAQI += $value;
        }
        
        $avgAQI = $totalAQI / $i;
        $avgAQI = round($avgAQI);
        return $avgAQI;
    }

    static function getCategory($AQI)
    {
        $category = [];
        if ($AQI <= 50.0)
        {
            $category['level'] = 0;
            $category['description'] = "Good";
            $category['description_mm'] = "ကောင်းသည်";
            $category['notification'] = "Clean Air - Enjoy your day with healthy air";
        }
        elseif ($AQI <= 100.0)
        {
            $category['level'] = 1;
            $category['description'] = "Moderate";
            $category['description_mm'] = "အသင့်အတင့်ကောင်းသည်";
            $category['notification'] = "Acceptable air quality";
        }
        elseif ($AQI <= 150.0)
        {
            $category['level'] = 2;
            $category['description'] = "Unhealthy for Sensitive Groups";
            $category['description_mm'] = "ထိခိုက်လွယ်သော သူများအတွက် မကောင်းပါ";
            $category['notification'] = "People unusually sensitive to air pollution and children should reduce or reschedule outdoor activities.";
        }
        elseif ($AQI <= 200.0)
        {
            $category['level'] = 3;
            $category['description'] = "Unhealthy";
            $category['description_mm'] = "ကျန်းမာရေးအတွက်မကောင်းပါ";
            $category['notification'] = "Anyone could experience negative health effects from pollution in the air";
        }
        elseif ($AQI <= 300.0)
        {
            $category['level'] = 4;
            $category['description'] = "Very Unhealthy";
            $category['description_mm'] = "ကျန်းမာရေးအတွက် အလွန်မကောင်းပါ";
            $category['notification'] = "Everyone may experience more serious negative healt effects";
        }
        elseif ($AQI <= 400.0)
        {
            $category['level'] = 5;
            $category['description'] = "Hazardous";
            $category['description_mm'] = "အန္တရာယ်အလွန်များသည်";
            $category['notification'] = "Stay Indoor!, prolonged exposure to outside air may impose health issues";
        }
        elseif ($AQI <= 500.0)
        {
            $category['level'] = 6;
            $category['description'] = "Hazardous";
            $category['description_mm'] = "အန္တရာယ်အလွန်များသည်";
            $category['notification'] = "Stay Indoor!, prolonged exposure to outside air may impose health issues";
        }
        else
        {
            $category['level'] = 7;
            $category['description'] = "AQI is more than 500";
            $category['description_mm'] = "AQI ၅၀၀ ထက်ပိုများနေသည်";
            $category['notification'] = "Stay Indoor!, prolonged exposure to outside air may impose health issues";
        }
        return $category;
    }

    static function getAQI($pm)
    {
        if ($pm <= 12.0)
        {
            $AQI = ((50-0)/(12.0-0.0))*($pm-0.0)+0;
        }
        elseif ($pm <= 35.4)
        {
            $AQI = ((100-51)/(35.4-12.1))*($pm-12.1)+51;
        }
        elseif ($pm <= 55.4)
        {
            $AQI = ((150-101)/(55.4-35.5))*($pm-35.5)+101;
        }
        elseif ($pm <= 150.4)
        {
            $AQI = ((200-151)/(150.4-55.5))*($pm-55.5)+151;
        }
        elseif ($pm <= 250.4)
        {
            $AQI = ((300-201)/(250.4-150.5))*($pm-150.5)+201;
        }
        elseif ($pm <= 350.4)
        {
            $AQI = ((400-301)/(350.4-250.5))*($pm-250.5)+301;
        }
        elseif ($pm <= 500.4)
        {
            $AQI = ((500-401)/(500.4-350.5))*($pm-350.5)+401;
        }
        $AQI = round($AQI);
        if ($pm > 500.4)
        {
            $AQI = "ERR: PM Value very high";
        }
        return $AQI;
    }
}