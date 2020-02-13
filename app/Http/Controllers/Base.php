<?php

namespace App\Http\Controllers;

class Base extends Controller
{
    public function __construct()
    {
        // 检测是否登录
        $this->middleware(function ($request, $next) {
            if (empty(session('token'))) {
                return redirect()->route('login');
            } else {
                $token       = session('token');
                $this->mysql = \DB::connection();

                $self = $this->mysql
                    ->table('wsadmin')
                    ->where('token', $token)
                    ->first();
                if (empty($self)) {
                    session()->flush();
                    return redirect()->route('login');
                }

                $self->nav  = empty($self->nav) ? [] : explode(',', $self->nav);
                $this->wsid = $self->id;
                $this->self = $self;
                $this->nav  = $this->getNav();

                // nav.active
                $route_name     = \Request::route()->getName();
                $route_name_arr = explode('-', $route_name);
                if (count($route_name_arr) == 2) {
                    $route_name_arr = [$route_name_arr[0], $route_name];
                }

                \View::share([
                    'self'           => $self,
                    'nav'            => $this->nav,
                    'route_name_arr' => $route_name_arr,
                ]);

                if (!$this->check()) {
                    return redirect()->route('home');
                }

                $this->init();
            }
            return $next($request);
        });
    }

    public function check()
    {
        return true;
    }

    public function init()
    {}

    public $nav = [
        'fishing'       => [
            'name' => '捕鱼',
            'nav'  => [
                'shouchong' => [
                    'name' => '首充',
                ],
                'yueka'     => [
                    'name' => '月卡',
                ],
            ],
        ],
        'fishingConfig' => [
            'name' => '捕鱼配置',
            'nav'  => [
                'shouchong' => [
                    'name' => '首充配置',
                ],
                'yueka'     => [
                    'name' => '月卡配置',
                ],
            ],
        ],
    ];

    private function getNav()
    {
        if ($this->wsid != 1001) {

            $self_nav = [];
            foreach ($this->self->nav as $key => $value) {
                $arr = explode('-', $value);
                if (isset($arr[1])) {
                    $self_nav[$arr[0]][] = $arr[1];
                }
            }

            foreach ($this->nav as $key => $value) {
                if (!isset($self_nav[$key])) {
                    unset($this->nav[$key]);
                } else {
                    foreach ($value['nav'] as $k => $v) {
                        if (!in_array($k, $self_nav[$key])) {
                            unset($this->nav[$key]['nav'][$k]);
                        }
                    }
                }
            }
        }

        return $this->nav;
    }
}
