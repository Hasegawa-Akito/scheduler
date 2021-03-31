<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;


class LoginController extends Controller
{
    public function roomlogin(Request $request){
        //dd($request->room_name);



        $room_info=["room_name"=>$request->room_name,
                    "password"=>$request->password,];

        $room=new Room;
        $room_serch=$room->room_serch($room_info);

        //room作成
        if(!isset($room_serch)){
        $room->room_create($room_info);
        //dd($room_info);
        $room_serch=$room->room_serch($room_info);
        }

        //dd($room_serch->room_id);

        $send=['room_id'=>$room_serch->room_id];

        return redirect(url('/userlogin'))->withInput($send);
        

    }

    public function userlogin_index(Request $request){
        $room_id=$request->old('room_id');
        if(!isset($room_id)){
            return redirect(url('/roomlogin'));
        }
        return view('userlogin',["room_id"=>$room_id]);
    }

    public function userlogin(Request $request){
        $user_info=["username"=>$request->username,
                    "password"=>$request->password,
                    "room_id"=>$request->room_id];
        //dd($user_info);
        $user=new User;
        $user_serch=$user->user_serch($user_info);

        if(!isset($user_serch)){
            $user->user_create($user_info);
            $user_serch=$user->user_serch($user_info);
        }

        //sessionにユーザーid,ルームid追加
        $request->session()->put('user_id',$user_serch->user_id);
        $request->session()->put('room_id',$user_serch->room_id);

        return redirect(url('/timetable/'.$user_serch->user_id.'/'.$user_serch->room_id));
    }
}
