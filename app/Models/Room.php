<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;


class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';

    protected $fillable = [
        'room_name', 'password',
    ];

    public function room_create($room_info){
        $room = new Room;
        $room->room_name = $room_info["room_name"];
        $room->password = $room_info["password"];
        $room->save();

        $room_id = $room->id;

        return $room_id;
    }

    public function room_serch($room_info){
        $room = Room::where('room_name',$room_info["room_name"])
                    ->first();
        
        // ハッシュ化されたパスワードが一致するかどうか
        if(isset($room) && (!password_verify($room_info["password"], $room->password))){
            $room = false;
        }
        //dd($room);
        return $room;
    }
}
