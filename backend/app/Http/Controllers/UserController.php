<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    //
    public function showMypage()
    {
        $user_id= Auth::id();
        $user = User::find($user_id);


        return view('users/mypage',[
            'user' => $user,
        ]);
    }

    public function showUser(int $user_id)
    {
        $user = User::find($user_id);

        return view('users/user',[
            'user' => $user,
        ]);
    }
}
