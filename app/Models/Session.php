<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Room;


class Session extends Authenticatable
{
    use HasFactory, Notifiable;

    public $session_user_id;
    public $session_room_id;

    public function __construct($request){
        //sessionからユーザーidとルームidを取得
        $this->session_user_id = $request->session()->get('user_id');
        $this->session_room_id = $request->session()->get('room_id');
    }

    //sessionに保存されているroomidと渡されたroomidが同じか
    public function confirm_session($request, $room_id){

        return $room_id != $this->session_room_id;
    }

    // session情報にuser_idとroom_idがあるか
    public function exist_session($request){

        return !(isset($this->session_user_id) && isset($this->session_room_id));
    }
}
