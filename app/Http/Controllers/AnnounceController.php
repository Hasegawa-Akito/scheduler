<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Session;

class AnnounceController extends Controller
{
    // get時の処理
    public function announce_index(Request $request){
        // Sesstionモデルを使用
        $session = new Session($request);

        //sessionの情報がなければログイン画面へリダイレクト
        if($session->exist_session($request)){
            return redirect(url('/roomlogin'));
        }


        $announcement = new Announcement;
        $announce_html = $announcement->create_announce_html($session->session_room_id);

        return view('announce',["view_user_id" => $session->session_user_id,
                                  "room_id" => $session->session_room_id,
                                  "announce_html" => $announce_html]
                    );
    }

    // アナウンス追加時
    public function announce(Request $request){
        // Sesstionモデルを使用
        $session = new Session($request);

        //sessionの情報がなければログイン画面へリダイレクト
        if($session->exist_session($request)){
            return redirect(url('/roomlogin'));
        }

        $announce_info = ["room_id" => $session->session_room_id,
                          "user_id" => $session->session_user_id,
                          "announce" => $request->announce,
                          "type" => $request->type
                         ];
        
        $announcement = new Announcement;
        $announcement->create_announce($announce_info);

        return redirect(url('/announce'));
    }

    // アナウンス削除時
    public function announce_delete(Request $request){
        // Sesstionモデルを使用
        $session = new Session($request);

        //sessionの情報がなければログイン画面へリダイレクト
        if($session->exist_session($request)){
            return redirect(url('/roomlogin'));
        }

        $announcement = new Announcement;
        $announcement->announce_delete($request->delete_id, $session->session_room_id);
        return redirect(url('/announce'));

    }
}
