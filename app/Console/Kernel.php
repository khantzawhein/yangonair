<?php

namespace App\Console;

use App\AppFunctions\ImageGenerator;
use App\aqitemp;
use App\Http\Controllers\FacebookAQIPostController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\AppFunctions\SensorDataStore;
use App\Http\Controllers\PushController;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function() {
            SensorDataStore::store();
            $aqitemp = new aqitemp();
            $data = $aqitemp->latestData();
            $imageGen = new ImageGenerator();
            $imageGen->ImageLoader($data->overall);
        })->everyFiveMinutes();
        $schedule->call(function() {
            PushController::push();
        })->dailyAt('07:30');
        $schedule->call(function () {
            FacebookAQIPostController::post();
        })->when(function() {
            return in_array(date('H:i'), ['08:00', '13:00', '20:00']);
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
