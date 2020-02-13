<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>捕鱼管理后台</title>
    @include('css')
</head>

<body class="gray-bg">
    <div id="content" class="middle-box text-center loginscreen animated fadeInDown">
        <div class="row">
            <form class="col-xs-10 col-xs-offset-1" method="post">
                {{ csrf_field() }}
                <div>
                    <h1 style="font-size: 40px;margin-bottom: 20px">捕鱼管理后台</h1>
                </div>

                @include('common.errors')
                @include('common.msg')
                
                <div class="m-t">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="账号" name="account">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="密码" name="password">
                    </div>
                    <button class="btn btn-primary block full-width m-b" type="submit">登录</button>
                </div>
            </form>
        </div>
    </div>
</body>
@include('js')

</html>