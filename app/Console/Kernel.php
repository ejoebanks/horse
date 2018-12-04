<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use DB;
use DateTime;
use DateTimeZone;
use App\Order;
use App\Notifications\AppointmentReminder;
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
            $today = new DateTime('today', new DateTimeZone('America/Chicago'));
            $order = \DB::table('orders')
                      ->select('orders.*')
                      ->orderBy('scheduledtime', 'asc')
                      ->get();

            foreach ($order as $obj) {

                // Check difference between now and appointment date
                $date = new Datetime($obj->scheduledtime,
                        new DateTimeZone('America/Chicago'));
                $interval = $today->diff($date);
                $final = $interval->days * 24 + $interval->h;

                if ($final <= 24 && $obj->notified == 0) {
                    // Send e-mail to the client
                    $sendTo = \App\User::find($obj->clientid);
                    $sendTo->notify(new AppointmentReminder());

                    // Update order so e-mail doesn't get sent repeatedly
                    $thisOrder = Order::find($obj->id);
                    $thisOrder->notified = 1;
                    $thisOrder->save();
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
