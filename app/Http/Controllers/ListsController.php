<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppFunctions\SensorDataStore;
use App\aqitemp;
use App\sensor;
use App\AppFunctions\helper;
use App\Raw;
use Carbon\Carbon;
use App\Exports\AQIExport;
use Maatwebsite\Excel\Facades\Excel;
use App\AppFunctions\LangSwitcher;
class ListsController extends Controller
{
    //
    protected $sensorAQI = [];
    protected $category = [];
    protected $updateTime;
    protected $colorcode = [];
    protected $rawPM = [];
    function index()
    {
        $lang = LangSwitcher::switch();   
        $this->getAQIDB();
        $this->getRawDB();
        $carbonDate = Carbon::parse($this->updateTime);
        $updated_at = $carbonDate->diffForHumans();
        $sensorDB = sensor::all();
        return view("lists", ['sensorAQI' => $this->sensorAQI,
                              'category' => $this->category,
                              'colorcode' => $this->colorcode,
                              'updated_at' => $updated_at,
                              'sensorDB' => $sensorDB,
                              'rawPM' => $this->rawPM,
                              'lang' => $lang]);
    }
    function export() {
        return Excel::download(new AQIExport, 'AQIs.xlsx');
    }
    function getAQIDB()
    {
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
                $this->sensorAQI[$i] = $row->$name;
                $this->category[$i] = helper::getCategory($this->sensorAQI[$i]);
                $this->colorcode[$i] = helper::getAQIColor($this->sensorAQI[$i]);
                $this->updateTime = $row->updated_at;
            }
        }
        return;
    }
    function getRawDB()
    {
        $rawDB = Raw::orderBy('id', 'desc')->take(1)->get();
        if ($rawDB->count() == 0)
        {
            SensorDataStore::store();
            $rawDB = Raw::orderBy('id', 'desc')->take(1)->get();
        }
        foreach ($rawDB as $row)
        {
            for ($i = 0; $i < config("global.sensor_count"); $i++)
            {
                $name = "sensor".$i;
                $this->rawPM[$i] = $row->$name;
            }
        }
        return;
    }
}
