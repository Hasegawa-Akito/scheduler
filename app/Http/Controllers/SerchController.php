<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;

class SerchController extends Controller
{
    public function serch_index(Request $request){
        $session_user_id = $request->session()->get('user_id');
        $session_room_id = $request->session()->get('room_id');
        if(!(isset($session_user_id) && isset($session_room_id))){
            return redirect(url('/roomlogin'));
        }

        $user_infos = array();
        $user = new User;
        $user_room_id_serchs = $user->user_room_id_serch($session_room_id);
        foreach($user_room_id_serchs as $user_room_id_serch){
            $user_infos = $user_infos + array($user_room_id_serch->user_id => $user_room_id_serch->username);
        }
        //dd($user_infos);


        return view('serch',["view_user_id" => $session_user_id,
                             "room_id" => $session_room_id,
                             "display" => "display_off",
                             "schedule_serch_html" => "",
                             "user_infos" => $user_infos
                            ]);
    }

    //予定検索時api
    public function serchApi(Request $request){
    
        $serch_info = ["year" => $request->year,
                       "month" => $request->month,
                       "day" => $request->day,
                       "start_hour" => $request->start_hour,
                       "start_minute" => $request->start_minute,
                       "finish_hour" => $request->finish_hour,
                       "finish_minute" => $request->finish_minute,
                       "keyword" => $request->keyword,
                       "room_id" => $request->room_id,
                       "user_id" => $request->user_id,
                     ];

        $schedule = new Schedule;
        $schedule_serch = $schedule->schedule_serch($serch_info);
        
        return response()->json($schedule_serch);
    }

    
}
