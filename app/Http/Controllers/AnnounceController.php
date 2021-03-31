<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnounceController extends Controller
{
    public function announce_index(Request $request){
        //sessionから値を入手
        $session_user_id=$request->session()->get('user_id');
        $session_room_id=$request->session()->get('room_id');
        if(!(isset($session_user_id)&&isset($session_room_id))){
            return redirect(url('/roomlogin'));
        }


        $announcement=new Announcement;
        $announce_html=$announcement->create_announce_html($session_room_id);

        return view('announce',["view_user_id"=>$session_user_id,
                                  "room_id"=>$session_room_id,
                                  "announce_html"=>$announce_html]);
    }
    public function announce(Request $request){
        //dd($request->announce);
        $session_user_id=$request->session()->get('user_id');
        $session_room_id=$request->session()->get('room_id');

        $announce_info=["room_id"=>$session_room_id,
                        "user_id"=>$session_user_id,
                        "announce"=>$request->announce,
                        "type"=>$request->type];
        
        $announcement=new Announcement;
        $announcement->create_announce($announce_info);

        return redirect(url('/announce'));
    }
    public function announce_delete(Request $request){
        //dd($request->delete_id);

        $announcement=new Announcement;
        $announcement->announce_delete($request->delete_id);
        return redirect(url('/announce'));

    }
}
