<?php

namespace App\Http\Controllers;

use App\Models\User;

// 在 Laravel 中要取得 HTTP 的請求資訊，可以透過 Illuminate\Http\Request class 來處理。
use Illuminate\Http\Request;
// 取得model
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 在 Controller 中，透過 Dependency injection 代入 Request class 以供使用。
    public function login(Request $req)
    {
        // 可以透過 input() 取得
        //return $req->input();

        // The first() method will return only one record
        $user = User::where(['email' => $req->email])->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return 'User email or password are not match!';
        } else {
            $req->session()->put('user', $user);
            return redirect('/');
        }
    }

    public function register(Request $req)
    {
        if ($req->password == $req->password_check) {
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->save();
            return redirect('/login');
        } else {
            return redirect('/register');
        }
    }
}
