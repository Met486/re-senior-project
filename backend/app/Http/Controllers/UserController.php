<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function showMypage(int $user_id)
    {
        $user = User::find($user_id);

        return view('users/mypage',[
            'user' => $user,
        ]);
    }
}
