<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/6/1
 * Time: 上午9:52
 */

namespace  app\admin\controller;


use app\admin\model\category;
use app\admin\model\images;
use think\Controller;

class Image extends Controller
{

    //添加上传图片
    public function add()
    {
        $re = $this->request;
        if ($re->isGet()){
            $lists = category::where('pid',0)->select();
            $this->assign('list',$lists);
            return  $this->fetch();
        }
        if ($re->isPost()){
            $thumbs = $re->param('xxxx');
            $id = $re->param('category');
            $data = [];
            foreach ($thumbs as $v){
                $data[] = ['category_id' => $id,'location' => $v];
            }

            $image = new images();
            if ($image->saveAll($data)){
                $this->success('成功');
            }else{
                $this->error('失败');
            }
        }




    }

    //图片列表
    public function lists()
    {
        $re = $this->request;
        $id = $re->param('id');
        if (empty($id)){
            $where = [];
        }else{
            $where['category_id'] = $id;
        }

        $list = images::where($where)->order('create_time  desc')->select();
//        $list = images::where('create_time')->select();
        $this->assign('list',$list);

        $categoryList = category::where('type',2)->select();
        $this->assign('categoryList',$categoryList);

        return $this->fetch();
    }


    //上传图片的子分类
    public function getImageCategory()
    {
        $re = $this->request;

        $id = $re->param('id');

        $lists = category::where('type',2)->where('pid',$id)->select();

        return json($lists);
    }

}