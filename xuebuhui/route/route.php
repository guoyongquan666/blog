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

//分类
Route::get('admin-list-category', 'admin/Index/categoryList');
Route::get('admin-tree-category', 'admin/Index/categoryTree');

//ajax获取文章分类
Route::post('admin-article-category', 'admin/Article/ajaxCategory');
Route::post('admin-article-change-status', 'admin/Article/changeStatus');
Route::post('admin-article-upload-image', 'admin/Article/uploadImage');
Route::rule('admin-article-umupload-image', 'admin/Article/umUploadImage')->method('GET,POST');
//ajax获取文章封面
Route::post('admin-article-upload-image', 'admin/Article/uploadImage');

Route::get('admin-list-category', 'admin/Index/categoryList');

//删除文章
Route::get('admin-list-delete', 'admin/Index/delete');
//修改文章(有错误)
Route::get('admin-list-revise', 'admin/Index/revise');

//图片管理
Route::rule('admin-image/[:id]$', 'admin/Image/lists')->method('GET,POST');
Route::rule('admin-image-add', 'admin/Image/add')->method('GET,POST');
Route::rule('admin-image-category', 'admin/Image/getImageCategory')->method('GET,POST');


/**
 * 前台
 */
//前台首页
Route::rule('/', 'index/Index/index')->method('GET,POST');
//发帖交流
Route::rule('chat/[:id]$', 'index/Index/chat')->method('GET,POST');
//发帖详情
Route::get('chat/show/[:id]$', 'index/index/show');

//软件下载
Route::rule('download/[:id]$', 'index/Index/download')->method('GET,POST');
//软件下载详情
Route::get('download/downshow/[:id]$', 'index/index/downshow');

//UI插件
Route::rule('uiplug/[:id]$', 'index/Index/uiplug')->method('GET,POST');


//软件下载
Route::rule('download/[:id]$', 'index/Index/download')->method('GET,POST');








//发新帖
Route::rule('add', 'index/Article/add')->method('GET,POST');

//前台注册
Route::rule('Sign/on', 'index/Sign/on')->method('GET,POST');
//前台登录
Route::rule('Sign/in', 'index/Sign/in')->method('GET,POST');
