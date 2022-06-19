<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Session;

class AdditionalController extends Controller
{
    // get時の処理
    public function add_index(Request $request){
        // Sesstionモデルを使用
        $session = new Session($request);

        //sessionの情報がなければログイン画面へリダイレクト
        if($session->exist_session($request)){
            return redirect(url('/roomlogin'));
        }

        return view('additional', ["view_user_id" => $session->session_user_id,
                                  "room_id" => $session->session_room_id
                                  ]);
    }

    // 予定追加時
    public function add(Request $request){
        // Sesstionモデルを使用
        $session = new Session($request);

        //sessionの情報がなければログイン画面へリダイレクト
        if($session->exist_session($request)){
            return redirect(url('/roomlogin'));
        }

        $start_time = $request->datepicker." ".$request->start_time;
        $finish_time = $request->datepicker." ".$request->finish_time;

        $schedule_info=["schedule" => $request->schedule,
                        "keyword" => $request->keyword,
                        "start_time" => $start_time,
                        "finish_time" => $finish_time,
                        "color" => $request->color,
                        "user_id" => $session->session_user_id,
                        "room_id" => $session->session_room_id
                    ];
        
        //スケジュールを追加
        $schedule = new Schedule;
        $schedule->schedule_add($schedule_info);
        
        $url_date = $request->datepicker;
        

        return redirect(url('/timetable/'.$session->session_user_id.'/'.$session->session_room_id.'/'.$url_date));
        
    }
}
