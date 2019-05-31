<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/5/30
 * Time: 下午2:41
 */

namespace app\admin\controller;

use app\admin\model\admin;
use think\Controller;

class Login extends Controller
{

    /**
     * 退出登录
     */
    public function out()
    {

        session('adminLoginInfo',null);
        $this->redirect('admin/Login/in');
    }




    /**
     * 登录操作
     */
    public function in()
    {

        $request = $this->request;

        //处理post请求
        if ($request->isPost()){

            //接受数据
            $data =$request->only(['mobile','password']);
            //验证数据
            $rule = [
                'mobile' => 'require|mobile',
                'password' => 'require|length:6,12'
            ];
            $msg = [
                'mobile.require' => '手机号为必填项',
                'mobile.mobile' => '手机号填写有误',
                'password.require' => '请输入密码',
                'password.length' => '密码长度有误'
            ];

            $info = $this->validate($data,$rule,$msg);
            if ($info !== true){
                return $this->error($info);
            }

            $admin = admin::where('mobile', $data['mobile'])->find();
            if (!$admin){
                $this->error('你输入的手机号或密码有误');
            }

            if (password_verify($data['password'], $admin->password)){
                //登录成功

                session('adminLoginInfo',$admin);
                $this->success('成功',url('admin/Index/index'));
            }else{
                $this->error('您输入的手机号或密码有误');
            }
        }

        //处理get请求
        if ($request->isGet()){
            return $this->fetch();
        }

    }

}