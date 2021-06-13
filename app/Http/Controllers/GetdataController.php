<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;


class GetdataController extends Controller
{
    public function getData(Request $request){
        $room = Room::where('room_name',$request->input('room_name'))->first();
        $existing=isset($room);
        $json = ["existing" => $existing];
        
        //true or false で返す
        return response()->json($json);
    }
}
