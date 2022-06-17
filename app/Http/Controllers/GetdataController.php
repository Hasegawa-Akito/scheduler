<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;


class GetdataController extends Controller
{
    public function getRoom(Request $request){
        $room = Room::where('room_name', $request->input('room_name'))->first();
        $existing = isset($room);
        $json = ["existing" => $existing];
        
        //true or false で返す
        return response()->json($json);
    }

    public function getUser(Request $request){
        $user = User::where('room_id', $request->input('room_id'))
                    ->where('username', $request->input('username'))
                    ->first();
        $existing = isset($user);
        $json = ["existing" => $existing];
        
        //true or false で返す
        return response()->json($json);
    }
}
