<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;

class AdditionalController extends Controller
{
    public function add_index(Request $request){
        //sessionから値を入手
        $session_user_id=$request->session()->get('user_id');
        $session_room_id=$request->session()->get('room_id');
        if(!(isset($session_user_id)&&isset($session_room_id))){
            return redirect(url('/roomlogin'));
        }
        return view('additional',["view_user_id"=>$session_user_id,
                                  "room_id"=>$session_room_id]);
    }

    public function add(Request $request){
        $session_user_id=$request->session()->get('user_id');
        $session_room_id=$request->session()->get('room_id');

        //dd($request->start_time);

        $start_time=$request->datepicker." ".$request->start_time;
        $finish_time=$request->datepicker." ".$request->finish_time;

        $schedule_info=["schedule"=>$request->schedule,
                        "keyword"=>$request->keyword,
                        "start_time"=>$start_time,
                        "finish_time"=>$finish_time,
                        "color"=>$request->color,
                        "user_id"=>$session_user_id,
                        "room_id"=>$session_room_id];
        
        //スケジュールを追加
        $schedule=new Schedule;
        $schedule->schedule_add($schedule_info);
        //dd($schedule_info);

        
        $url_date=$request->datepicker;
        

        return redirect(url('/timetable/'.$session_user_id.'/'.$session_room_id.'/'.$url_date));
        
    }
}
