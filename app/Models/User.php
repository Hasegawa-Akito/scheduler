<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    private $member_btn_html = "";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password',
        'username',
        'room_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_create($user_info){
        $user = new User;
        $user->password = $user_info['password'];
        $user->username = $user_info['username'];
        $user->room_id = $user_info['room_id'];

        return $user->save();
    }
    public function user_serch($user_info){
        $user = User::where('room_id', $user_info["room_id"])
                    ->where('username', $user_info["username"])
                    ->first();
        if($user && (!password_verify($user_info["password"], $user->password))){
            $user = false;
        }
        return $user;
    }
    public function user_id_pass_serch($user_info){
        $user = User::where('user_id', $user_info["user_id"])
                    ->first();
        if($user && (!password_verify($user_info["password"], $user->password))){
            $user = false;
        }
        return $user;
    }
    public function user_id_serch($user_id, $room_id){
        $user = User::where('user_id', $user_id)
                    ->where('room_id', $room_id)
                    ->first();
                    
        //dd($user);

        return $user;
    }

    public function user_room_id_serch($room_id){
        $user = User::where('room_id', $room_id)
                    ->get();
        return $user;
    }


    public function member_list_btn($user_id,$room_id){

        //全員表示ボタン設置
        $this->member_btn_html .= <<< EOS
                <button type="submit" class="btn btn-outline-success ml-1" value="all" name="member_btn">all</button>
        EOS;
        
        //メンバーボタン設置
        $members=User::where('room_id',$room_id)->get();

        foreach($members as $member){
            $this->member_btn_html .= <<< EOS
                <button type="submit" class="btn btn-outline-primary ml-1" value="$member->user_id" name="member_btn">$member->username</button>
            EOS;
        }
        

        return $this->member_btn_html;

    }
}
