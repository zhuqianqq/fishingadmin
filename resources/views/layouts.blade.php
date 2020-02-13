<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>捕鱼管理后台</title>
    @include('css')
    @section('css')
    @show
</head>

<body class="fixed-sidebar no-skin-config full-height-layout gray-bg">
    <div id="wrapper">
        <nav id="nav" class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse" style="background: rgb(47, 64, 80)">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <h2 style="color: #fff">{{ $self->name }}</h2>
                    </li>
                    <li class="nav-home">
                        <a href="{{ route('home') }}">主页</a>
                    </li>
                    <li class="nav-accountMgr">
                        <a href="{{ route('accountMgr') }}">帐号管理</a>
                    </li>

                    @foreach($nav as $key => $value)
                    <li class="nav-{{ $key }}">
                        <a>{{ $value['name'] }}</a>
                        <ul class="nav nav-second-level collapse">
                            @foreach($value['nav'] as $k => $v)
                            <li class="nav-{{ $key . '-' . $k }}"><a
                                    href="{{ route($key . '-' . $k) }}">{{ $v['name'] }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach

                    <li class="nav-changePwd">
                        <a href="{{ route('changePwd') }}">修改密码</a>
                    </li>
                    <li>
                        <a onclick="logOut()">退出登录</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom visible-xs-block" style="height: auto">
                <nav role="navigation" style="margin-bottom: 0;height: auto">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary"
                        style="margin: 7px;margin-right: 0;color: #fff;">菜单</a>
                </nav>
            </div>
            <div class="row wrapper page-heading">
                @section('content')@show
            </div>
            @section('modals')
            @show
        </div>
    </div>
</body>

@include('js')
<script>

    @foreach($route_name_arr as $value)
    $('.nav-{{ $value }}').addClass('active');
    @endforeach

    function logOut() {
        if (confirm('确定退出吗?')) {
            window.location.href = "{{ route('logOut') }}";
        }
    }
</script>
@section('js')
@show

</html>