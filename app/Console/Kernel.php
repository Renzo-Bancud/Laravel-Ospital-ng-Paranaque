<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
       // $schedule->command('message:reorderdaily')->everyMinute()->appendOutputTo('scheduler.log');
      
     // $schedule->command('message:reorderdaily')->everyMinute();

     
      
      try{

           $schedule->command('message:reorderdaily')->dailyAt('3:09')->timezone('Asia/Manila');

        } catch(\Throwable $t){
            Log::emergency($t);
        }
        

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
