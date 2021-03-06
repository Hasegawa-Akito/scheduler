<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Schedule;


class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $fillable = [
        'user_id', 'room_id', 'schedule', 'start_time', 'finish_time', 'keyword', 'color'
    ];

    //スケジュールを追加
    public function schedule_add($schedule_info){
        $schedule = new Schedule;
        $schedule->user_id = $schedule_info["user_id"];
        $schedule->room_id = $schedule_info["room_id"];
        $schedule->schedule = $schedule_info["schedule"];
        $schedule->start_time = $schedule_info["start_time"];
        $schedule->finish_time = $schedule_info["finish_time"];
        $schedule->keyword = $schedule_info["keyword"];
        $schedule->color = $schedule_info["color"];
        return $schedule->save();
    }

    //スケジュール検索
    public function schedule_serch($serch_info){
        //検索の際入れられてない情報のところには%が入っている。
        $start_time = $serch_info["year"] . "-" . $serch_info["month"] . "-" . $serch_info["day"] . " " . $serch_info["start_hour"] . ":" . $serch_info["start_minute"] . ":" . "%";
        $finish_time = $serch_info["year"] . "-" . $serch_info["month"] . "-" . $serch_info["day"] . " " . $serch_info["finish_hour"] . ":" . $serch_info["finish_minute"] . ":" . "%";
        $keyword = "%" . $serch_info['keyword'] . "%";
        
        $schedules=Schedule::where('room_id', $serch_info["room_id"])
                          ->where('user_id', 'like', $serch_info["user_id"])
                          ->where('start_time', 'like', $start_time)
                          ->where('finish_time', 'like', $finish_time)
                          ->where(function($query) use($keyword){       //functionの中で変数を使うためにuse()をつける
                              $query->where('keyword','like',$keyword)  //キーワードもしくわスケジュール名で検索をかける
                                    ->orWhere('schedule','like',$keyword);
                          })
                          ->get();
        
        $serch_results = array();

        if(count($schedules) > 0){
            foreach($schedules as $schedule){

                //スケジュールのuser_idからそのユーザー名を取得
                $user = User::where('user_id', $schedule->user_id)->first();
                $username = $user->username;

                $date = explode(" ", $schedule->start_time)[0];
                $time = explode(":", explode(" ", $schedule->start_time)[1])[0] . ":" . explode(":", explode(" ", $schedule->start_time)[1])[1];
                //dd($time);

                $timeline_url = asset('/timetable/' . $schedule->user_id . '/' . $serch_info["room_id"] . '/' . $date);

                $serch_result = [ "username" => $username,
                                 "timeline_url" => $timeline_url,
                                 "schedule" => $schedule->schedule,
                                 "date" => $date,
                                 "time" => $time];

                array_push($serch_results, $serch_result);
            }

        }

        // dd($serchResults);
        return $serch_results;
                        
    }

    //スケジュール削除
    public function schedule_delete($delete_id){
        $schedule = new Schedule;
        $schedule->destroy($delete_id);
                        
    }
}
