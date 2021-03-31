<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $username="Akito";
        $password="haseaki";
        $room_id=1;

        $user=new User;
        $user->username=$username;
        $user->password=$password;
        $user->room_id=$room_id;
        $user->save();
    }
}
