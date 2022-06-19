<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;

class LoginController extends Controller
{
    // get処理
    public function roomlogin_index(Request $request){
        // ログイン失敗メッセージがあれば取得
        $message = $request->old('message');

        return view('roomlogin', ["message" => $message]);
    }

    // room作成時
    public function roomcreate(Request $request){
        
        $room_info = ["room_name" => $request->room_name,
                      "password" => $request->password,
                     ];

        $room=new Room;
        
        // パスワードのハッシュ化
        $password = password_hash($request->password, PASSWORD_BCRYPT);

        $room_create_info = ["room_name" => $request->room_name,
                             "password"=>$password,
                            ];

        // roomの作成と作成されたroomのid取得
        $room_id = $room->room_create($room_create_info);
        
        $send = ['room_id' => $room_id];
        return redirect(url('/userlogin'))->withInput($send);
    }

    // roomログイン時
    public function roomlogin(Request $request){
        
        $room_info = ["room_name" => $request->room_name,
                      "password" => $request->password,
                     ];

        $room = new Room;
        $room_serch=$room->room_serch($room_info);

        // roomが見つからない時
        if(!$room_serch){
            $message = ['message' => "ルーム名またはパスワードが間違っています"];
            return redirect(url('/roomlogin'))->withInput($message);
        }

        //dd($room_serch->room_id);

        $send=['room_id' => $room_serch->room_id];

        return redirect(url('/userlogin'))->withInput($send);
        

    }

    // get時の処理
    public function userlogin_index(Request $request){
        // redirect時に送られたroo_idを取得
        $room_id = $request->old('room_id');
        if(!isset($room_id)){
            return redirect(url('/roomlogin'));
        }
        
        // ログイン失敗メッセージがあれば取得
        $message=$request->old('message');

        return view('userlogin', ["room_id" => $room_id, "message" => $message]);
    }

    // ユーザー作成時
    public function usercreate(Request $request){
        
        // formの内容を取得
        $user_info = ["username" => $request->username,
                      "password" => $request->password,
                      "room_id" => $request->room_id];

        $user=new User;

        // パスワードのハッシュ化
        $password = password_hash($request->password, PASSWORD_BCRYPT);
        // ユーザーの作成
        $user_create_info = [ "username" => $request->username,
                              "password" => $password,
                              "room_id" => $request->room_id
                            ];
        $id = $user->user_create($user_create_info);
        dd($id["user_id"]);

        //sessionにユーザーid,ルームid追加
        $request->session()->put('user_id', $id["user_id"]);
        $request->session()->put('room_id', $id["room_id"]);

        return redirect(url('/timetable/'.'all'.'/'.$id["room_id"].'/today'));
    }

    // ユーザーログイン時
    public function userlogin(Request $request){
        
        $user_info = ["username" => $request->username,
                      "password" => $request->password,
                      "room_id" => $request->room_id
                     ];

        $user = new User;
        $user_serch = $user->user_serch($user_info);

    
        // ユーザーが見つからない時
        if(!$user_serch){
            $message = ['message' => "ユーザー名またはパスワードが間違っています",
                        'room_id' => $user_info["room_id"]
                       ];
            return redirect(url('/userlogin'))->withInput($message);
        }

        //sessionにユーザーid,ルームid追加
        $request->session()->put('user_id', $user_serch->user_id);
        $request->session()->put('room_id', $user_serch->room_id);

        return redirect(url('/timetable/'.'all'.'/'.$user_serch->room_id.'/today'));
    }
}
