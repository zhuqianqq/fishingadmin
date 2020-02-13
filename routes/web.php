<?php

// 登录
Route::any('login', 'Login@index')->name('login');

// 主页
Route::get('/', 'Home@index')->name('home');
Route::post('/', 'Home@api')->name('_home');

// 修改密码
Route::any('changePwd', 'ChangePwd@index')->name('changePwd');

// 退出登录
Route::get('logOut', 'Home@logOut')->name('logOut');

// 帐号管理
Route::get('accountMgr', 'AccountMgr@index')->name('accountMgr');
Route::post('accountMgr', 'AccountMgr@api')->name('_accountMgr');

// 捕鱼
Route::group(['prefix' => 'fishing'], function () {
    // 首充
    Route::get('shouchong', 'Test@index')->name('fishing-shouchong');
    // 月卡
    Route::get('yueka', 'Test@index')->name('fishing-yueka');
});
// 捕鱼配置
Route::group(['prefix' => 'fishingConfig'], function () {
    // 首充
    Route::get('shouchong', 'Test@index')->name('fishingConfig-shouchong');
    // 月卡
    Route::get('yueka', 'Test@index')->name('fishingConfig-yueka');
});
