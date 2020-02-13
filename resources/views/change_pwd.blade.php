@extends('layouts')

@section('content')
<div class="TITLE bg-primary">修改密码</div>

<form class="BOX" method="post" style="max-width: 300px;margin: 0 auto" id="form">
    {{ csrf_field() }}

    @include('common.errors')
    @include('common.msg')
    
    <div class="m-t">
        <div class="form-group">
            <input type="password" class="form-control" placeholder="原密码" name="opassword">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="新密码"" name="password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="确认新密码" name="password_confirmation">
        </div>
        <button class="btn btn-primary block full-width m-b" type="submit">修改</button>
    </div>
</form>
@stop

@section('js')
<script>

$('#form').submit(function() {
    return confirm('确定修改吗？');
});

</script>
@endsection
