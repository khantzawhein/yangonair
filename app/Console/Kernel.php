<?php

namespace App\Console;

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
        })->everyFiveMinutes();
        $schedule->call(function() {
            PushController::push();
        })->dailyAt('07:30');
        $schedule->call(function () {
            FacebookAQIPostController::post();
        })->dailyAt('08:00')->dailyAt('12:00')->dailyAt('17:00')->dailyAt('20:00');
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
