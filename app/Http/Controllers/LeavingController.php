<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Room;
use App\Models\Session;

class LeavingController extends Controller
{
    // get時の処理
    public function leaving_index(Request $request){
        // Sesstionモデルを使用
        $session = new Session($request);

        //sessionの情報がなければログイン画面へリダイレクト
        if($session->exist_session($request)){
            return redirect(url('/roomlogin'));
        }

        return view('leaving', ["view_user_id" => $session->session_user_id,
                                "room_id" => $session->session_room_id,
                               ]);
    }

    // 退会処理
    public function leaving(Request $request){
        // Sesstionモデルを使用
        $session = new Session($request);

        //sessionの情報がなければログイン画面へリダイレクト
        if($session->exist_session($request)){
            return redirect(url('/roomlogin'));
        }
        
        $user_info = ["user_id" => $session->session_user_id,
                      "password" => $request->password
                     ];

        $user = new User;

        // ユーザーパスワードを確認
        $delete_ok = $user->user_id_pass_serch($user_info);
        if($delete_ok){
            // ユーザーの削除
            User::where('user_id', $session->session_user_id)->delete();
            // 予定の削除
            Schedule::where('user_id', $session->session_user_id)->delete();

            //そのルームidを持つユーザーがいなければルームを除去する
            $room = User::where('room_id', $session->session_room_id)->first();
            if(!isset($room)){
                Room::where('room_id', $session->session_room_id)->delete();
            }

            return redirect(url('/roomlogin'));
        }
        
        return redirect(url('/leaving'));
        
    }
}
