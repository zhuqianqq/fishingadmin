@extends('layouts')

@section('css')
<style>
    #table tr>td {
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="TITLE bg-primary">账号管理</div>

<div class="BOX" style="max-width: 600px; margin: 0 auto">
    <div style="overflow: auto">
        <table class="table table-bordered table-hover" id="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>帐号</td>
                    <td>姓名</td>
                    <td>开通时间</td>
                    <td>
                        <a class="btn btn-primary btn-sm" @click="_addModal">
                            <span class="fa fa-plus"></span>
                            开通帐号
                        </a>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr v-if="list == null">
                    <td colspan="5" class="text-center">加载中…</td>
                </tr>
                <tr v-else v-for="(v) in list">
                    <td>@{{ v.id }}</td>
                    <td>@{{ v.account }}</td>
                    <td>@{{ v.name }}</td>
                    <td>@{{ v.create_at }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" @click="_setNavModal(v.id)">权限</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop

@section('modals')
@component('components.Modal', ['id' => 'add-modal', 'max_width' => '300px'])
<h2 style="margin-bottom: 20px;text-align: center">开通帐号</h2>
<input type="text" class="form-control" placeholder="输入帐号" style="margin-bottom: 20px;" v-model="add.account">
<input type="text" class="form-control" placeholder="输入姓名" style="margin-bottom: 20px;" v-model="add.name">
<button class="btn btn-block btn-primary" @click="_add">开通</button>
@endcomponent
@component('components.Modal', ['id' => 'setNav-modal', 'max_width' => '400px'])
<h2 style="margin-bottom: 20px;text-align: center">权限</h2>

@foreach($nav as $key => $value)
<table class="table table-bordered" style="margin-bottom: 20px;">
    <thead>
        <tr>
            <td colspan="2">
                <h2 style="font-size: 18px;">{{ $value['name'] }}</h2>
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach($value['nav'] as $k => $v)
        <tr>
            <td>
                <label>
                    <input type="checkbox" style="zoom:150%;" v-model="setNav.nav" value="{{ $key . '-' . $k }}">
                    {{ $v['name'] }}
                </label>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endforeach

<button class="btn btn-block btn-primary" @click="_setNav">授权</button>
@endcomponent
@endsection

@section('js')
<script>

    var vm = new Vue({
        el: '#page-wrapper',
        data: {
            add: {},
            list: null,
            setNav: {
                id: null,
                nav: []
            }
        },
        methods: {
            _addModal() {
                $('#add-modal').modal();
            },
            _add() {
                if (this.add.account == null) {
                    alert('请输入帐号');
                    return false;
                }
                if (this.add.name == null) {
                    alert('请输入姓名');
                    return false;
                }
                if (confirm('确定开通吗')) {
                    var self = this;
                    $.ajax({
                        type: "POST",
                        url: "{{ route('_accountMgr') }}",
                        data: {
                            cmd: "addAccount",
                            data: self.add,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (res) {
                            if (res.code == 0) {
                                alert('开通成功，默认密码123456');
                                window.location.reload();
                            } else if (res.code == 1) {
                                alert(res.errmsg);
                            }
                        }
                    });
                }
            },
            _setNavModal(id) {
                this.setNav.id = id;
                var self = this;
                $.ajax({
                    type: "POST",
                    url: "{{ route('_accountMgr') }}",
                    data: {
                        cmd: "getAccountNav",
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (res) {
                        if (res.code == 0) {
                            self.setNav.nav = res.nav;
                            $('#setNav-modal').modal();
                        } else if (res.code == 1) {
                            alert(res.errmsg);
                        }
                    }
                });
            },
            _setNav() {
                var self = this;
                if (confirm('确定授权吗')) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('_accountMgr') }}",
                        data: {
                            cmd: "setAccountNav",
                            data: self.setNav,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (res) {
                            if (res.code == 0) {
                                alert('授权成功');
                                window.location.reload();
                            } else if (res.code == 1) {
                                alert(res.errmsg);
                            }
                        }
                    });
                }
            }
        },
        created() {
            var self = this;
            $.ajax({
                type: "POST",
                url: "{{ route('_accountMgr') }}",
                data: {
                    cmd: "accountList",
                    _token: "{{ csrf_token() }}"
                },
                success: function (res) {
                    if (res.code == 0) {
                        self.list = res.list;
                    } else if (res.code == 1) {
                        alert(res.errmsg);
                    }
                }
            });
        },
        watch: {
            list() {
                this.$nextTick(function () {
                    $('#table').dataTable({
                        dom: 'ftp',
                        columnDefs: [{
                            "targets": [3, 4],
                            "searchable": false
                        }, {
                            "targets": [1, 2, 4],
                            "orderable": false
                        }]
                    });
                });
            }
        }
    });

</script>
@stop