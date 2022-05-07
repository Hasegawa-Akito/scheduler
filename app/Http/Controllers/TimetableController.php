<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use App\Models\TimetableCreate;
use App\Models\Room;



class TimetableController extends Controller
{
    public function timetable_index(Request $request, $view_user_id, $room_id,$display_date){

        //sessionからユーザーidとルームidを取得
        $session_user_id = $request->session()->get('user_id');
        $session_room_id = $request->session()->get('room_id');

        //sessionの情報とroom_idが違えばログイン画面へリダイレクト
        if($room_id != $session_room_id){
            return redirect(url('/roomlogin'));
        }
        

        $user = new User;
        
        $user_id_serch = $user->user_id_serch($view_user_id);//ユーザーidだけでなくroom_idも検索にかけるよう変更する
        if(!isset($user_id_serch)){
            return redirect(url('/roomlogin'));
        }
        $view_username = $user_id_serch->username;

        
        if($display_date != "today"){
            $date = $display_date;
        }
        else{
            $date = date('Y-m-d');
            
        }
        //dd($date);
        
        $timetable_create = new TimetableCreate;
        $timetable_html = $timetable_create->timetable_html($date, $view_user_id);

        $member_btn_html = $user->member_list_btn($session_user_id, $session_room_id);
        
        return view('timetable', ["timetable_html"=>$timetable_html,
                                  "user_id"=>$session_user_id,
                                  "view_username"=>$view_username,
                                  "view_user_id"=>$view_user_id,
                                  "room_id"=>$room_id,
                                  "member_btn_html"=>$member_btn_html]);
    }
    public function timetable(Request $request,$view_user_id,$room_id){

        //member_btnで表示させようとした時
        if(isset($request->member_btn)){
            $display_date = "today";
            $view_user_id = $request->member_btn;
        }

        if($request->datepicker){
            $display_date = $request->datepicker;
        }
        
        return redirect(url('/timetable/'.$view_user_id.'/'.$room_id.'/'.$display_date));
    }
    public function timetable_delete(Request $request){
        //dd($request->room_id);
        $schedule = new Schedule;
        $schedule->schedule_delete($request->delete_id);

        return redirect(url('/timetable/'.$request->view_user_id.'/'.$request->room_id.'/'.$request->display_date));
    }
}
