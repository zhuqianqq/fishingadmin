<?php

namespace App\Http\Controllers;

// 帐号管理
class AccountMgr extends Base
{
    public function index()
    {
        return view('accountMgr');
    }

    public function api()
    {
        switch (request()->input('cmd')) {

            // 开通
            case 'addAccount':
                $data = request()->input('data', null);
                if (empty($data)) {
                    return ['code' => 1, 'errmsg' => '参数缺失'];
                }
                return $this->addAccount($data['account'], $data['name']);
                break;

            // 列表
            case 'accountList':
                return $this->accountList();
                break;

            // 获取账号权限
            case 'getAccountNav':
                return $this->getAccountNav(request()->input('id', $this->wsid));
                break;

            // 设置帐号权限
            case 'setAccountNav':
                return $this->setAccountNav(request()->input('data'));
                break;
        }
    }

    public function addAccount($account, $name)
    {
        $user = $this->mysql
            ->table('wsadmin')
            ->where('account', $account)
            ->first();
        if ($user) {
            return ['code' => 1, 'errmsg' => '该帐号已存在'];
        }

        $this->mysql->table('wsadmin')->insert([
            'account'  => $account,
            'name'     => $name,
            'password' => md5('123456'),
            'token'    => md5($account . time()),
            'level'    => ++$this->self->level,
            'opener'   => $this->wsid,
        ]);

        return ['code' => 0];
    }

    public function accountList()
    {
        return [
            'code' => 0,
            'list' => $this->mysql
                ->table('wsadmin')
                ->select('id', 'account', 'name', 'create_at')
                ->where('opener', $this->wsid)
                ->get(),
        ];
    }

    public function getAccountNav($id)
    {
        $user = $this->mysql
            ->table('wsadmin')
            ->select('nav')
            ->where('id', $id)
            ->first();

        return [
            'code' => 0,
            'nav'  => empty($user->nav) ? [] : explode(',', $user->nav),
        ];
    }

    public function setAccountNav($data)
    {
        $this->mysql->table('wsadmin')
            ->where('id', $data['id'])
            ->update(['nav' => count($data['nav']) == 0 ? '' : implode(',', $data['nav'])]);
        return ['code' => 0];
    }
}
