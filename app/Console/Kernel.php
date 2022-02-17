<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $today = date('Y-m-d');
            $items = DB::select("select * from items");
            foreach($items as $item){
                $id = $item->id;
                $default = 0;
                if($item->discount_setting > 0){    //Check whether setting is set
                    $discount_setting = $item->discount_setting;
                    if($today >= $item->start_date && $today <= $item->end_date){   //Check whether date is in range
                        DB::update("update items set 
                            discount ='$discount_setting'
                            where id = '$id'
                        ");
                    }else{  //Expired
                        DB::update("update items set 
                            discount_setting ='$default',
                            start_date = '',
                            end_date = '',
                            discount ='$default'
                            where id = '$id'
                        ");
                    }
                }else{
                    DB::update("update items set 
                        discount ='$default'
                        where id = '$id'
                    ");
                }
            }
        })->everyMinute();
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
