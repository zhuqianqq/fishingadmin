<?php

namespace App\Http\Controllers;

class Home extends Base
{
    public function index()
    {
        if ($this->self->password == md5('123456')) {
            session()->flash('info', '你正在使用默认密码123456，请及时修改');
            return redirect()->route('changePwd');
        }

        return view('home');
    }

    public function logOut()
    {
        session()->flush();
        return redirect()->route('login');
    }

    // public function api()
    // {
    //     switch (request()->input('cmd')) {
    //         // 获取导航
    //         case 'getNav':
    //             return [
    //                 'code' => 0,
    //                 'nav'  => $this->getNav(),
    //             ];
    //             break;
    //     }
    // }
}
