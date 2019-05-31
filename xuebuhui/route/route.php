<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


/**
 * 后台
 */
//登录
Route::rule('login', 'admin/Login/in')->method('GET,POST');
//后台首页
Route::rule('end', 'admin/Index/index')->method('GET,POST');












/**
 * 前台
 */
//前台首页
Route::rule('xuebuhui', 'i`ndex/Index/index')->method('GET,POST');

//前台注册
Route::rule('Sign/on', 'index/Sign/on')->method('GET,POST');
//前台登录
Route::rule('Sign/in', 'index/Sign/in')->method('GET,POST');
