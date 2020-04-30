<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\chartjs;
use Carbon\Carbon;
use App\aqitemp;
use App\sensor;
use App\AppFunctions\helper;
class ChartsController extends Controller
{
    //
    function index() {
        $overallChart = $this->overallChart();
        $sensorsBarChart = $this->sensorsBarChart();
        $categoryPieChart = $this->categoryPieChart();
        $updateTime = aqitemp::select('updated_at')->orderBy('id', 'desc')->take(1)->get();
        $carbonDate = Carbon::parse($updateTime[0]->updated_at);
        $updated_at = $carbonDate->diffForHumans();
        return view('charts', compact(['overallChart', 'sensorsBarChart', 'categoryPieChart', 'updated_at']));
    }
    function categoryPieChart() {
        $labels = ['Good', 'Moderate', 'Unhealthy for Sensitive Groups', 'Unhealthy', 'Very Unhealthy', 'Hazardous'];
        $categoryCount = array_fill_keys($labels, 0);
        $dataset = collect([]);
        
        $aqiDB = aqitemp::orderBy('id', 'desc')->take(1)->get();
        for ($i = 0; $i < config("global.sensor_count"); $i++) {
            $name = "sensor".$i;
            $sensorAQI[$i] = $aqiDB[0]->$name;
            $category[$i] = helper::getCategory($sensorAQI[$i])['description'];
        }
        $count = array_count_values($category);
        foreach ($count as $key=>$value) {
            $categoryCount[$key] = $value;
        }
        foreach ($categoryCount as $value){
            $dataset->push($value);
        }
        
        $chart = new chartjs();
        $chart->labels($labels);
        $chart->dataset('Count', 'doughnut', $dataset)
              ->backgroundColor([
                  '#00e400',
                  '#ffff00',
                  '#ff7e00',
                  '#ff0000',
                  '#8f3f97',
                  '#7e0023'
                  ]);
        $chart->options([
            'title' => [
                'display' => true,
                'fontSize' => 20,
                'text' => 'Realtime AQI categories counts for each sensors'
            ]
        ]);
        return $chart;
    }
    function sensorsBarChart() {
        $labels = collect([]);
        $dataset = collect([]);
        $aqiDB = aqitemp::orderBy('id', 'desc')->take(1)->get();
        $sensors = sensor::select('sensor_name')->get();
        for ($i = 0; $i < config("global.sensor_count"); $i++)
        {
            $name = "sensor".$i;
            $dataset->push($aqiDB[0]->$name);
        }
        foreach ($sensors as $row)
        {
            $labels->push($row->sensor_name);
        }
        $chart = new chartjs();
        $chart->labels($labels->all());
        $chart->dataset('AQI', 'horizontalBar', $dataset)
              ->backgroundColor('rgba(54, 162, 235, 0.7)')
              ->color('rgb(54, 162, 235)');
        $chart->options([
            'legend' => [
                'display' => false
            ],
            'title' => [
                'display' => true,
                'fontSize' => 20,
                'text' => 'Realtime AQI Values for each sensors'
            ],
            'scales' => [
                'yAxes' => [
                    [
                        'scaleLabel' =>  [
                            'display' => true,
                            'labelString' =>  "Sensor Names",
                        ],
                    ]
                    ],
                'xAxes' => [
                    [  
                        'scaleLabel' =>  [
                            'display' => true,
                            'labelString' =>  "AQI Values",
                        ],
                        'display' => true,
                        'ticks' => [
                            'suggestedMin' => 90,
                            'suggestedMax' => 200
                        ]
                        
                        
                    ]
                ]
            ]
        ]);
        return $chart;
    }
    function overallChart() {
        $labels = collect([]);
        $dataset = collect([]);
        $time = Carbon::today()->subHours(24);
        $data = aqitemp::select('overall','created_at')->where('created_at', ">=", $time)->get();
        foreach ($data as $row) {
            $dataset->push($row->overall);
            $time = $row->created_at;
            $carbonTime = Carbon::parse($time);
            $timelabels = $carbonTime->format('g:i A');
            $labels->push($timelabels);
        }
        $chart = new chartjs;
        $chart->labels($labels->all());
        $chart->dataset('Overall AQI', 'line', $dataset)
                     ->backgroundColor('rgba(40, 167, 69, 0.4)')
                     ->color('rgba(40, 167, 69, 1)')
                     ->fill(true);
        $chart->options([
            'legend' => [
                'display' => false
            ],
            'title' => [
                'display' => true,
                'fontSize' => 20,
                'text' => "Overall Yangon's AQI values in last 24 hours"
            ],
            'scales' => [
                'yAxes' => [
                    [
                        'scaleLabel' =>  [
                            'display' => true,
                            'labelString' =>  "AQI Values",
                        ],
                        'ticks' => [
                            'suggestedMin' => 40,
                            'suggestedMax' => 250,
                            'beginAtZero' => true,
                       ]
                    ]
                    ],
                'xAxes' => [
                    [  
                        'scaleLabel' =>  [
                            'display' => true,
                            'labelString' =>  "Time",
                        ],
                        'display' => true,
                        'ticks' => [
                            'autoSkipPadding' => 25
                        ]
                        
                        
                    ]
                ]
            ]
        ]);
        return $chart;
    }
}