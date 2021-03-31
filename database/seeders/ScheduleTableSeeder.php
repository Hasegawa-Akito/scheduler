<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedule=new Schedule;
        $schedule->user_id=1;
        $schedule->schedule="サイゼリヤバイト";
        $schedule->start_time="2021-03-18 18:00";
        $schedule->finish_time="2021-03-18 22:00";
        $schedule->save();

    }
}
