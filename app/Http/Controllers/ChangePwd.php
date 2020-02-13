<?php

namespace App\Http\Controllers;

class ChangePwd extends Base
{
    public function index()
    {
        if (request()->isMethod('post')) {
            $messages = [
                'opassword.required' => '请输入原密码',
                'password.required'  => '请输入新密码',
                'password.confirmed' => '两次密码不一致',
            ];

            $data = $this->validate(request(), [
                'opassword' => 'required',
                'password'  => 'required|confirmed',
            ], $messages);

            $opassword = $data['opassword'];
            $password  = $data['password'];

            if (md5($opassword) != $this->self->password) {
                session()->flash('danger', '原密码错误');
                return redirect()->route('changePwd');
            }

            if ($password == '123456') {
                session()->flash('warning', '不能改为默认密码');
                return redirect()->route('changePwd');
            }

            if ($password == $opassword) {
                session()->flash('warning', '新密码与原密码一致');
                return redirect()->route('changePwd');
            }

            $this->mysql->table('wsadmin')
                ->where('id', $this->wsid)
                ->update(['password' => md5($password)]);

            session()->flash('success', '修改密码成功');
            return redirect()->route('home');
        }

        return view('change_pwd');
    }
}
