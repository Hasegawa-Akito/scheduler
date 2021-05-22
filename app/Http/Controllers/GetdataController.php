<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class GetdataController extends Controller
{
    public function getData(){
        $user = User::orderBy('created_at', 'desc')->get();
        $json = ["user" => $user];
        return response()->json($json);
    }
}
