<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/6/3
 * Time: 下午8:30
 */

namespace app\index\controller;

use app\admin\model\category;
use think\Controller;

class Article extends Controller
{
    //发新帖
    public function add()
    {

        $request = $this->request;
        //如果是POST请求
        if ($request->isPost()){


            $data = $request->only(['title', 'category_id', 'author', 'content', 'status','thumb','minthumb']);
            //验证
            $rule = [
                'title' => 'require|length:1,50',
                'category_id' => 'require|min:1',
                'author' => 'length:2,10',
                'content' => 'require|length:10,65535',
                'status' => 'in:0,1'
            ];
            $msg = [
                'title.require' => '文章标题为必填项',
                'title.length' => '文章标题长度应在1-50个字符之间',
                'category_id.require' => '请选择正确的分类信息',
                'category_id.min' => '请选择正确的分类信息',
                'author.length' => '署名长度应在2-10个字符之间',
                'content.require' => '文章内容为必填项',
                'content.length' => '文章内容过短或者过长',
                'status.in' => '文章状态有误'

            ];
            $check = $this->validate($data, $rule, $msg);
            if ($check !== true){
                $this->error($check);
            }

            $data['aid'] = session('adminLoginInfo')->id;
            //入库

            if ( article::create($data)){
                $this->success('添加成功', url('admin/Article/lists'));
            }else{
                $this->error('添加失败');
            }


        }
        //如果是GET请求
        if ($request->isGet()){

            //获取分类信息
            $all = category::where('pid', 0)->all();


            $this->assign('all', $all);
            return $this->fetch();
        }


    }
}