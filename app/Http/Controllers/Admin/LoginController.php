<?php

namespace App\Http\Controllers\Admin;



use App\Admin\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login.login');
    }

    public function login_check(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required|between:6,12'
        ];
        $msgs = [
            'username.required' => '管理员名称不能为空',
            'password.required' => '密码不能为空',
            'password.between' => '密码长度要在6到12位之间'
        ];

        $validator = Validator::make($request->all(), $rules, $msgs);
        if ($validator->passes()) {
            $username = Input::get('username');
            $password = Input::get('password');

            if (\Illuminate\Support\Facades\Auth::guard('admin')->attempt(['username'=>$username,'password'=>$password])) {
                return redirect('admin/index');
            } else {
                return back()->withErrors(['error'=>'用户名或密码错误']);
            }
        } else {
            return back()->withErrors($validator);
        }
    }


}
