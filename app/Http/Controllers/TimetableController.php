<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use App\Models\TimetableCreate;
use App\Models\Room;



class TimetableController extends Controller
{
    public function timetable(Request $request,$view_user_id,$room_id){

        $session_user_id=$request->session()->get('user_id');
        $session_room_id=$request->session()->get('room_id');
        //dd($session_room_id);

        if($room_id!=$session_room_id){
            return redirect(url('/roomlogin'));
        }
        //sessionにユーザーid追加
        $request->session()->put('user_id',$session_user_id);
        $request->session()->put('room_id',$session_room_id);

        //member_btnで表示させようとした時
        if(isset($request->member_btn)){
            return redirect(url('/timetable/'.$request->member_btn.'/'.$room_id));
        }

        $user=new User;
        $user_id_serch=$user->user_id_serch($view_user_id);
        if(!isset($user_id_serch)){
            return redirect(url('/roomlogin'));
        }
        $view_username=$user_id_serch->username;

        if($request->datepicker){
            $date=$request->datepicker;
        }
        else if($request->old('date')){
            $date=$request->old('date');
        }
        else{
            $date= date('Y-m-d');
            //dd($date);
        }

        $timetable_create=new TimetableCreate;
        $timetable_html=$timetable_create->timetable_html($date,$view_user_id);

        $member_btn_html=$user->member_list_btn($session_user_id,$session_room_id);
        
        return view('timetable',["timetable_html"=>$timetable_html,
                                 "user_id"=>$session_user_id,
                                 "view_username"=>$view_username,
                                 "view_user_id"=>$view_user_id,
                                 "room_id"=>$room_id,
                                 "member_btn_html"=>$member_btn_html]);
    }
}
