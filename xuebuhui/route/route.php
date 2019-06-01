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
//修改文章(有bug)
Route::get('admin-list-revise', 'admin/Index/revise');

//图片管理
Route::rule('admin-image/[:id]$', 'admin/Image/lists')->method('GET,POST');
Route::rule('admin-image-add', 'admin/Image/add')->method('GET,POST');
Route::rule('admin-image-category', 'admin/Image/getImageCategory')->method('GET,POST');


/**
 * 前台
 */
//前台首页
Route::rule('xuebuhui', 'index/Index/index')->method('GET,POST');
//发帖交流
Route::rule('chat', 'index/Index/chat')->method('GET,POST');
//发帖详情
Route::get('chat/[:id]$', 'index/index/show');
//前台注册
Route::rule('Sign/on', 'index/Sign/on')->method('GET,POST');
//前台登录
Route::rule('Sign/in', 'index/Sign/in')->method('GET,POST');
