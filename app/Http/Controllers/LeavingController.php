<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Room;


class LeavingController extends Controller
{
    public function leaving_index(Request $request){
        $session_user_id=$request->session()->get('user_id');
        $session_room_id=$request->session()->get('room_id');
        if(!(isset($session_user_id)&&isset($session_room_id))){
            return redirect(url('/roomlogin'));
        }
        return view('leaving',["view_user_id"=>$session_user_id,
                               "room_id"=>$session_room_id,]);
    }
    public function leaving(Request $request){
        $session_user_id=$request->session()->get('user_id');
        $session_room_id=$request->session()->get('room_id');
        
        $user_info=["user_id"=>$session_user_id,
                    "password"=>$request->password];

        $user=new User;
        $delete_ok=$user->user_id_pass_serch($user_info);
        if($delete_ok){
            User::where('user_id',$session_user_id)->delete();
            Schedule::where('user_id',$session_user_id)->delete();

            //そのルームidを持つユーザーがいなければルームを除去する
            $room=User::where('room_id',$session_room_id)->first();
            //dd($room);
            if(!isset($room)){
                Room::where('room_id',$session_room_id)->delete();
            }

            return redirect(url('/roomlogin'));
        }
        
        return redirect(url('/leaving'));
        
    }
}
