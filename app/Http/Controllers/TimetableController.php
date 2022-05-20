<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use App\Models\TimetableCreate;
use App\Models\Room;



class TimetableController extends Controller
{

    private $session_user_id;
    private $session_room_id;

    //sessionに保存されているroomidと渡されたroomidが同じか
    private function confirm_session($request, $room_id){

        //sessionからユーザーidとルームidを取得
        $this->session_user_id = $request->session()->get('user_id');
        $this->session_room_id = $request->session()->get('room_id');

        return $room_id != $this->session_room_id;
    }

    //getの時の処理
    public function timetable_index(Request $request, $view_user_id, $room_id, $display_date){

        //sessionの情報とroom_idが違えばログイン画面へリダイレクト
        if($this->confirm_session($request, $room_id)){
            return redirect(url('/roomlogin'));
        }
        
        $user = new User;

        //全表示の時
        if($view_user_id == "all"){
            $view_username = "全員";
        }
        //個別表示の時
        else{
            //room_idとview_user_idの一致するユーザーがいるかどうか検索
            $user_id_serch = $user->user_id_serch($view_user_id, $room_id);
            if(!isset($user_id_serch)){
                return redirect(url('/roomlogin'));
            }

            $view_username = $user_id_serch->username;
        }
        

        
        if($display_date != "today"){
            $date = $display_date;
        }
        else{
            $date = date('Y-m-d');
            
        }
        
        //timetable作成
        $timetable_create = new TimetableCreate;
        $timetable_html = $timetable_create->timetable_html($date, $view_user_id, $room_id);

        //メンバーボタン作成
        $member_btn_html = $user->member_list_btn($this->session_user_id, $this->session_room_id);
        
        return view('timetable', ["timetable_html" => $timetable_html,
                                  "user_id" => $this->session_user_id,
                                  "view_username" => $view_username,
                                  "view_user_id" => $view_user_id,
                                  "room_id" => $room_id,
                                  "member_btn_html" => $member_btn_html,
                                  "date" => $date]);
    }

    //postで予定を表示処理
    public function timetable(Request $request, $view_user_id, $room_id){

        //member_btnをおして予定を表示させようとした時
        if(isset($request->member_btn)){
            $display_date = $request->display_date;
            $view_user_id = $request->member_btn;
        }

        //datepickerで日付を選択して予定を表示させようとした時
        if(isset($request->datepicker)){
            $display_date = $request->datepicker;
        }
        
        return redirect(url('/timetable/'.$view_user_id.'/'.$room_id.'/'.$display_date));
    }

    //予定削除処理
    public function timetable_delete(Request $request){
        
        //そのルームの人以外が削除しようとしたらリダイレクト
        if($this->confirm_session($request, $request->room_id)){
            return redirect(url('/timetable/'.$this->session_user_id.'/'.$this->session_room_id.'/'.$request->display_date));
        }
        
        $schedule = new Schedule;
        $schedule->schedule_delete($request->delete_id);

        return redirect(url('/timetable/'.$request->view_user_id.'/'.$request->room_id.'/'.$request->display_date));
    }
}
