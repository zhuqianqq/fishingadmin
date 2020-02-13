<?php

namespace App\Http\Controllers;

class Login extends Controller
{
    public function __construct()
    {        
        // 检测是否登录
        $this->middleware(function ($request, $next) {
            if (session('token')) {
                return redirect()->route('home');
            } else {
                $this->mysql = \DB::connection();
            }
            return $next($request);
        });
    }
    
    public function index()
    {
        if(request()->isMethod('post')) {
            $messages = [
                'account.required'  => '请输入帐号',
                'password.required' => '请输入密码',
            ];
    
            $data = $this->validate(request(), [
                'account'  => 'required',
                'password' => 'required',
            ], $messages);
    
            $account  = $data['account'];
            $password = $data['password'];
    
            $self = $this->mysql
                ->table('wsadmin')
                ->where('account', $account)
                ->first();
            if (empty($self) || $self->password != md5($password)) {
                session()->flash('danger', '帐号或密码错误');
                return redirect()->route('login');
            }
    
            $token = $account . md5(time());
            $this->mysql->table('wsadmin')
                ->where('account', $account)
                ->update([
                    'token'      => $token,
                    'login_at' => date('Y-m-d H:i:s'),
                ]);
            session(['token' => $token]);
    
            return redirect()->route('home');
        }
        
        return view('login');
    }
}
