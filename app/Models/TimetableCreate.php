<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Schedule;


class TimetableCreate extends Model
{
    use HasFactory;

    private $timetable_html="";

    public function timetable_html($date,$view_user_id){

        //表示したい日の次の日を取得
        $dates=explode("-",$date);
        $next_date=$dates[0]."-".$dates[1]."-".sprintf('%02d',$dates[2]+1);
        //dd($next_date);

        $html;
        for($k=0;$k<=24;$k++){
            $html[$k]="";
        }
        //dd($html);
        
        $this->timetable_html.= <<< EOS
                <tr>
                    <th class="gray" colspan="2">$date</th>
                </tr>
        EOS;
        for($i=0;$i<=24;$i++){
            $hour=sprintf('%02d',$i);
            $next_hour=sprintf('%02d',$i+1);
            $dateTime=$date." ".$hour;
            //dd($dateTime);
            $schedules=Schedule::where('user_id',$view_user_id)
                                ->where('start_time','like',"$dateTime%") 
                                ->get();
            //dd($schedules);

            $this->timetable_html.= <<< EOS
                <tr>
                    <th scope="row">$hour:00<br>〜</br>$next_hour:00</th>
                    <td>
            EOS;

            $array_length=count($schedules);
            if($array_length!=0){
                
                foreach($schedules as $schedule){
                    //開始時間、終了時間をhh:mmにする 開始終了時間hを取得
                    $start_time=explode(":",explode(" ",$schedule->start_time)[1]);
                    $start_hour=abs($start_time[0]);
                    $start_time=$start_time[0].":".$start_time[1];
                    $finish_time=explode(":",explode(" ",$schedule->finish_time)[1]);
                    $finish_hour=abs($finish_time[0]);
                    $finish_minute=abs($finish_time[1]);
                    $finish_time=$finish_time[0].":".$finish_time[1];
                    
                    //dd($finish_minute);

                    $html[$i].= <<< EOS
                        <div class="radius mb-2 $schedule->color">$schedule->schedule<a>　　　　　$start_time~$finish_time</a></div>
                    EOS;
                    if($finish_minute==0){
                        $finish_hour=$finish_hour-1;
                    }
                    for($t=$start_hour+1;$t<=$finish_hour;$t++){
                        $html[$t].= <<< EOS
                            <div class="radius mb-2 $schedule->color">$schedule->schedule<a>　　　　　$start_time~$finish_time</a></div>
                        EOS;
                    }
                }
            }

            $this->timetable_html.=$html[$i];
            $this->timetable_html.= <<< EOS
                    </td>
                </tr>
            EOS;
        }

        
        //dd($this->timetable_html);
        return $this->timetable_html;
    }
}
