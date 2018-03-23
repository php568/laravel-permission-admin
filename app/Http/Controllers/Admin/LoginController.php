<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public $redirectTo = '/admin/index';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.login.index');
    }

    /**
     * @param Request $request
     * 登录验证
     */
    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            'geetest_challenge' => 'geetest',
            $this->username() => 'required|string',
            'password' => 'required|string',
        ],[
            'geetest' => config('geetest.server_fail_alert')
        ]);
    }

    /**
     * @return string
     * 登录验证的字段
     */
    public function username()
    {
        return 'name';
    }


}
