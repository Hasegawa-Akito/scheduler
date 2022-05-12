<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Schedule;


class TimetableCreate extends Model
{
    use HasFactory;

    private $timetable_html = "";

    public function timetable_html($date, $view_user_id, $room_id){

        //検索日のスケジュールを取得
        //roomメンバー全表示
        if($view_user_id == "all"){
            $schedules = Schedule::where('room_id', $room_id)
                                ->where('start_time', 'like', "$date%") 
                                ->orderBy('start_time', 'asc')
                                ->get();
        }
        //ユーザー個別表示
        else{
            $schedules = Schedule::where('user_id', $view_user_id)
                                ->where('start_time', 'like', "$date%") 
                                ->orderBy('start_time', 'asc')
                                ->get();
        }
        
        
        $html;
        for($k=0; $k<=24; $k++){
            $html[$k] = "";
        }
        
        $delete_url = url('/timetable/delete');
        $csrf = csrf_field();
        
        foreach($schedules as $schedule){
            $start_time = explode(":", explode(" ", $schedule->start_time)[1]);
            $start_hour = abs($start_time[0]);
            $start_HM = $start_time[0].":".$start_time[1];
            $finish_time = explode(":",explode(" ", $schedule->finish_time)[1]);
            $finish_hour = abs($finish_time[0]);
            $finish_minute = abs($finish_time[1]);
            $finish_HM = $finish_time[0].":".$finish_time[1];
            

            $html[$start_hour] .= <<< EOS
                        <div class="radius mb-2 $schedule->color">$schedule->schedule<a>  $start_HM~$finish_HM</a>
                            <form class="mb-2 mr-2 removal" action="$delete_url" method="post">
                                $csrf
                                <input type="hidden" name="view_user_id" value="$view_user_id">
                                <input type="hidden" name="room_id" value="$schedule->room_id">
                                <input type="hidden" name="display_date" value="$date">
                                <edit
                                :schedule_id="$schedule->id"
                                ></edit>
                            </form>
                        </div>
                    EOS;

            //ちょうど終わりの時間が0分なら終了時間を-1にして考える
            if($finish_minute == 0){
                $finish_hour = $finish_hour-1;
            }

            for($t=$start_hour+1; $t<=$finish_hour; $t++){
                $html[$t] .= <<< EOS
                <div class="radius mb-2 $schedule->color">$schedule->schedule<a>  $start_HM~$finish_HM</a>
                <form class="mb-2 mr-2 removal" action="$delete_url" method="post">
                    $csrf
                    <input type="hidden" name="view_user_id" value="$view_user_id">
                    <input type="hidden" name="room_id" value="$schedule->room_id">
                    <input type="hidden" name="display_date" value="$date">
                    <edit
                    :schedule_id="$schedule->id"
                    ></edit>
                </form>
                </div>
                EOS;
            }
            
        }
        //dd($html);


        
        
        $this->timetable_html .= <<< EOS
                <tr>
                    <th class="gray" colspan="2">$date</th>
                </tr>
        EOS;

        //テーブルの横の時間を作成
        for($i=0; $i<=24; $i++){
            $hour = sprintf('%02d', $i);
            $next_hour = sprintf('%02d', $i+1);
            $dateTime = $date." ".$hour;
            //dd($dateTime);

            

            $this->timetable_html .= <<< EOS
                <tr>
                    <th scope="row">$hour:00<br>〜</br>$next_hour:00</th>
                    <td>
            EOS;

            $this->timetable_html .= $html[$i];
            $this->timetable_html .= <<< EOS
                    </td>
                </tr>
            EOS;
        }

        
        //dd($this->timetable_html);
        return $this->timetable_html;
    }
}
