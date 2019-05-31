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
            //数据验证
            $rule = [
                'agree' => 'require',

                'mobile' => 'require|mobile',
                'password' => 'require|length:6,12'
            ];
            $msg = [
                'agree.require' => '您需要同意注册协议',

                'mobile.require' => '请输入正确的手机号',
                'mobile.mobile' => '用户名或密码不正确',
                'password.require' => '请输入密码',
                'password.length' => '密码长度应在6-12位'
            ];
            $info = $this->validate($request->param(),$msg,$rule);
            if ($info !== true){
                $this->error($info);
            }
//            $email =  Db::table('user')->where('email',$request->param('email'))->find();
            $mobile = Db::table('user')->where('mobile',$request->param('mobile'))->find();

//            if ($email){
//                $this->error('该邮箱已注册');
//
//            }
            if ($mobile){
                $this->error('该手机号已注册');
            }







            $m =new \app\index\model\User();
//            $m->email = $request->param('email');
            $m->mobile = $request->param('mobile');
            $m->password = password_hash($request->param('password'),PASSWORD_DEFAULT);
            $m->nickname = '小程序猿'.random_int(10000,99999);
            if ($m->save()){
                $this->success('注册成功',url('index/Sign/in'));
            }else{
                $this->error('注册失败');
            }

        }


    }


    //用户登录
    public function in()
    {
        return $this->fetch();
    }

}