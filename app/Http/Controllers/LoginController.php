<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;

class LoginController extends Controller
{
    public function roomlogin_index(Request $request){
        //dd($request->old('room_id'));
        $message=$request->old('message');
        return view('roomlogin',["message"=>$message]);
    }

    public function roomcreate(Request $request){
        
        $room_info=["room_name"=>$request->room_name,
                    "password"=>$request->password,];

        $room=new Room;

        $password = password_hash($request->password, PASSWORD_BCRYPT);
        $room_create_info=["room_name"=>$request->room_name,
                        "password"=>$password,];
        $room->room_create($room_create_info);
        //dd($room_info);
        $room_serch=$room->room_serch($room_info);
        $send=['room_id'=>$room_serch->room_id];
        return redirect(url('/userlogin'))->withInput($send);
    }


    public function roomlogin(Request $request){
        //dd($request->room_name);
        //dd($password);
        
        $room_info=["room_name"=>$request->room_name,
                    "password"=>$request->password,];

        $room=new Room;
        $room_serch=$room->room_serch($room_info);

        
        if(!$room_serch){
            $message=['message'=>"ルーム名またはパスワードが間違っています"];
            return redirect(url('/roomlogin'))->withInput($message);
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
        
        $message=$request->old('message');

        return view('userlogin',["room_id"=>$room_id,"message"=>$message]);
    }

    public function usercreate(Request $request){
        
        $user_info=["username"=>$request->username,
                    "password"=>$request->password,
                    "room_id"=>$request->room_id];

        //dd($user_info);

        $user=new User;

        $password = password_hash($request->password, PASSWORD_BCRYPT);
        $user_create_info=["username"=>$request->username,
                    "password"=>$password,
                    "room_id"=>$request->room_id];
        $user->user_create($user_create_info);
        $user_serch=$user->user_serch($user_info);

        //sessionにユーザーid,ルームid追加
        $request->session()->put('user_id',$user_serch->user_id);
        $request->session()->put('room_id',$user_serch->room_id);

        return redirect(url('/timetable/'.'all'.'/'.$user_serch->room_id.'/today'));
    }

    public function userlogin(Request $request){
        
        $user_info=["username"=>$request->username,
                    "password"=>$request->password,
                    "room_id"=>$request->room_id];
        //dd($user_info["room_id"]);

        $user=new User;
        $user_serch=$user->user_serch($user_info);

        //dd($user_serch);

        if(!$user_serch){
            $message=['message'=>"ユーザー名またはパスワードが間違っています",
                      'room_id'=>$user_info["room_id"]];
            return redirect(url('/userlogin'))->withInput($message);
        }

        //sessionにユーザーid,ルームid追加
        $request->session()->put('user_id',$user_serch->user_id);
        $request->session()->put('room_id',$user_serch->room_id);

        return redirect(url('/timetable/'.'all'.'/'.$user_serch->room_id.'/today'));
    }
}
