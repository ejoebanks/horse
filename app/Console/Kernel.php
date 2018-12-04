<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use DB;
use DateTime;
Use App\Notifications\AppointmentReminder;
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
      $schedule->call(function () {
        $today = new DateTime();
        $order = \DB::table('orders')
        ->select('orders.*')
        ->oldest()
        ->get();

        foreach ($order as $obj){
          $today = new DateTime();
          $date = new Datetime($obj->scheduledtime);
          $interval = $today->diff($date);
          $final = $interval->days * 24 + $interval->h;

          if ($final < 24){
            $sendTo = \App\User::find($obj->clientid);
            $sendTo->notify(new AppointmentReminder());
          }
        }
    })->twiceDaily(1, 13);

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
