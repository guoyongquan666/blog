<?php
namespace app\index\controller;

use app\admin\model\article;
use app\admin\model\category;
use think\Controller;
use think\Db;

class Index extends Controller
{
    //首页
    public function index()
    {
        return $this->fetch();
    }

    //发帖交流
    public function chat()
    {
        $request = $this->request;

        $id = $request->param('id');

        if ($id == 0){
            $where = [];
        }else{
            $where['category_id'] = $id;
        }

        $category = category::where('pid',0)->select();

        $this->assign('categoryList',$category);

        $article = article::where('category_id',36)->select();

        $this->assign('articleList',$article);
        $this->assign('id',$id);



        return $this->fetch();
    }

    //发帖交流详情
    public function show()
    {
        $category = $this->categoryList(1);

        //文章id
        $id = $this->request->param('id');


        $info = article::get($id);

        $this->assign('info', $info);

        //更新阅读量
        $info->setInc('hits');


        return $this->fetch();
    }


    //软件下载

    public function download()
    {
       $request = $this->request;

       $id = $request->param('id');

       if ($id == 0){
           $where = [];
       }else{
           $where['category_id'] = $id;
       }

       $category = category::where('pid',0)->select();

       $this->assign('category',$category);

        $article = article::where('category_id',39)->select();

        $this->assign('article',$article);
        $this->assign('id',$id);



        //todo  获取时间戳 计算出相差时间
        // $tmpdate = time();

        return $this->fetch();
    }

    //软件下载详情
    public function downshow()
    {

        $category = $this->categoryList(1);

        //文章id
        $id = $this->request->param('id');


        $info = article::get($id);


        $this->assign('info', $info);

        //更新阅读量
        $info->setInc('hits');


        return $this->fetch();
    }

    //UI插件
    public function uiplug()
    {
        $request = $this->request;
        $id = $request->param('id');
        if ($id == 0){
            $where = [];
        }else{
            $where['category_id'] = $id;
        }

         $category =  category::where('pid',0)->select();
        $this->assign('categoryList',$category);

        $article = article::where('category_id',41)->select();
        $this->assign('articleList',$article);

        $this->assign('id',$id);

        return $this->fetch();
    }





















    //分类
    protected function categoryList($id)
    {
        $category = category::where('pid',$id)->select();
        $this->assign('category',$category);
        return $category;

    }



}
