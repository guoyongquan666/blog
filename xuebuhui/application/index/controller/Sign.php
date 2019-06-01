<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/5/30
 * Time: 下午3:58
 */

namespace app\index\controller;

use app\index\model\User;
use think\Controller;
use think\Db;

class Sign extends Controller
{
    //用户注册
    public function on()
    {

        $request = $this->request;

        if ($request->isGet()){
            return $this->fetch();
        }


        if ($request->isPost()){
            $rule = [
                'agree'    => 'require',
                'email'   => 'require|email|unique:user',
                'password' => 'require|confirm:repass|length:6,12'
            ];
            $msg = [
                'agree.require'   => '您需要同意注册协议',
                'mobile.require'  => '邮箱为必填项',
                'mobile.mobile'   => '请输入正确的邮箱',
                'mobile.unique'   => '该邮箱已注册',
                'password.require'=> '密码为必填项',
                'password.confirm'=> '两次密码不一致',
                'password.length' => '密码长度应在6-12位之间'
            ];

            $info = $this->validate($request->param(),$rule,$msg);
            if ($info !== true){
                $this->error($info);
            }

            if ( Db::table('user')->where('email',$request->param('email'))->find()){
                $this->error('该邮箱已注册');
            }



            $m = new \app\index\model\User();
            $m->email = $request->param('email');
            $m->password = password_hash($request->param('password'),PASSWORD_DEFAULT);
            $m->nickname = '小程序猿_'.random_int(10000,999999);
            if ($m->save()){
                $this->success('注册成功',url('index/Index/index'));
            }else{
                $this->error('注册失败');
            }
        }

    }


    //用户登录
    public function in()
    {
        $request = $this->request;

        //处理post请求
        if ($request->isPost()){

            //接受数据
            $data =$request->only(['email','password']);
            //验证数据
            $rule = [
                'email' => 'require|email',
                'password' => 'require|length:6,12'
            ];
            $msg = [
                'email.require' => '请输入邮箱',
                'email.email' => '请输入正确的邮箱',
                'password.require' => '请输入密码',
                'password.length' => '邮箱或密码有误'
            ];

            $info = $this->validate($data,$rule,$msg);
            if ($info !== true){
                return $this->error($info);
            }

            $email = User::where('email', $data['email'])->find();
            if (!$email){
                $this->error('你输入的邮箱或密码有误');
            }

            if (password_verify($data['password'], $email->password)){
                //登录成功

                session('userLoginInfo',$email);
                $this->success('成功',url('index/Index/index'));
            }else{
                $this->error('您输入的邮箱或密码有误');
            }
        }

        //处理get请求
        if ($request->isGet()){
            return $this->fetch();
        }
    }

    //退出登录
    public function out()
    {


        session('userLoginInfo', null);

        $this->redirect(url('index/Sign/in'));

    }

}