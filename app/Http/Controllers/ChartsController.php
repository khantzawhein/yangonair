<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\chartjs;
use Carbon\Carbon;
use App\aqitemp;
use App\sensor;
use App\AppFunctions\helper;
use App\AppFunctions\LangSwitcher;
use Illuminate\Support\Facades\App;
class ChartsController extends Controller
{
    //
    function index() {
        $lang = LangSwitcher::switch();
        $data24hrs = aqitemp::where('created_at', ">=", Carbon::now()->subHours(24))->get();  
        $sensornames = sensor::select('sensor_name')->get();

        $overallChart = $this->overallChart($data24hrs);
        $sensorsBarChart = $this->sensorsBarChart($sensornames);
        $categoryPieChart = $this->categoryPieChart();
        $sensorsLineChart = $this->sensorsLineChart($data24hrs, $sensornames);
        $updateTime = aqitemp::select('updated_at')->orderBy('id', 'desc')->take(1)->get();
        $carbonDate = Carbon::parse($updateTime[0]->updated_at);
        $updated_at = $carbonDate->locale($lang)->diffForHumans();
        return view('charts', compact(['overallChart', 'sensorsBarChart', 'categoryPieChart', 'sensorsLineChart','updated_at']));
    }
    function sensorsLineChart($data24hrs, $sensornames) {
        $labels = collect([]);
        $names = collect([]);
        for ($i = 0; $i < config('global.sensor_count'); $i++) {
            ${"sensor".$i} = collect([]);
        } 
        foreach ($data24hrs as $row) {
            $carbonTime = Carbon::parse($row->created_at);
            $labels->push($carbonTime->format('g:i A'));
            for ($i = 0; $i < config('global.sensor_count'); $i++) {
                $name = "sensor".$i;
                ${$name}->push($row->$name);
            }
        }
        foreach ($sensornames as $row) {
            $names->push($row->sensor_name);
        }
        $chart = new chartjs();
        $chart->labels($labels);
        $chart->title('Sensors AQI in Last 24 hours');
        $chart->dataset($names[0],'line', $sensor0)->fill(false)->color('#F2545B')->custom('#F2545B');
        $chart->dataset($names[1],'line', $sensor1)->fill(false)->color('#FDCA40')->custom('#FDCA40');
        $chart->dataset($names[2],'line', $sensor2)->fill(false)->color('#3772FF')->custom('#3772FF');
        $chart->dataset($names[3],'line', $sensor3)->fill(false)->color('#27FB6B')->custom('#27FB6B');
        $chart->dataset($names[4],'line', $sensor4)->fill(false)->color('#0C0F0A')->custom('#0C0F0A');
        $chart->dataset($names[5],'line', $sensor5)->fill(false)->color('#D8F1A0')->custom('#D8F1A0');
        $chart->dataset($names[6],'line', $sensor6)->fill(false)->color('#F26DF9')->custom('#F26DF9');
        $chart->dataset($names[7],'line', $sensor7)->fill(false)->color('#5D737E')->custom('#5D737E');
        $chart->dataset($names[8],'line', $sensor8)->fill(false)->color('#59C9A5')->custom('#59C9A5');
        $chart->dataset($names[9],'line', $sensor9)->fill(false)->color('#664C43')->custom('#664C43');
        $chart->dataset($names[10],'line', $sensor10)->fill(false)->color('#B33F62')->custom('#B33F62');
        $chart->options([
            'scales' => [
                'xAxes' => [
                    [
                        'scaleLabel' =>  [
                            'display' => true,
                            'labelString' =>  "Time",
                        ],
                    ]
                ],
                'yAxes' => [
                    [   
                        'scaleLabel' =>  [
                            'display' => true,
                            'labelString' =>  "AQI Values",
                        ],
                        'ticks' => [
                            'beginAtZero' => false
                        ]
                    ]
                ]
            ]
        ]);
        return $chart;
    }
    function categoryPieChart() {
        $labels = [__('index.good'), __('index.moderate'), __('index.unhealthySensitive'), __('index.unhealthy'), __('index.veryunhealthy'), __('index.hazardous')];
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
    function sensorsBarChart($sensornames) {
        $labels = collect([]);
        $dataset = collect([]);
        $aqiDB = aqitemp::orderBy('id', 'desc')->take(1)->get();
        for ($i = 0; $i < config("global.sensor_count"); $i++)
        {
            $name = "sensor".$i;
            $dataset->push($aqiDB[0]->$name);
        }
        foreach ($sensornames as $row)
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
                            'suggestedMin' => 40,
                            'suggestedMax' => 250
                        ]
                        
                    ]
                ]
            ]
        ]);
        return $chart;
    }
    function overallChart($data) {
        $labels = collect([]);
        $dataset = collect([]);
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
                     ->color('#F9564F')
                     ->fill(false)->custom('#F9564F');
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