<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function getLogin() {
        return view('backend.login.login');
    }

    function postLogin(LoginRequest $r) {

        $email = $r->email;
        $password = $r->password;
        
       if ( Auth::attempt(['email' => $email, 'password' => $password])) {
           return redirect('admin');
       } else {
           return redirect()->back()->with('thongbao', 'Tài khoản hoặc mật khẩu sai')->withInput();
       }
       
        
    }
}
