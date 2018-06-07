<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{

    //注册表单
    public function showRegisterForm()
    {
        return view('home.member.register');
    }
    //注册
    public function register(Request $request)
    {
        $this->validate($request,[
            'captcha' => 'required|captcha',
            'name' => 'required',
            'phone' => 'required|numeric|regex:/^1[3456789][0-9]{9}$/|unique:members',
            'password'  => 'required|confirmed|min:6|max:14'
        ],[
            'captcha.captcha' => '验证码错误'
        ]);

    }

    //登录表单
    public function showLoginForm()
    {
        //return view('home.member.login');
    }
    //登录
    public function login()
    {

    }

    //注销、退出
    public function logout()
    {

    }

}
