<?php
namespace app\index\controller;

use app\admin\model\article;
use app\admin\model\category;
use think\Controller;

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
        $re = $this->request;

        $id = $re->param('id');

        if ($id == 0){
            $where = [];
        }else{
            $where['category_id'] = $id;
        }
        $this->assign('id',$id);

        $article = article::where($where)->paginate(10);
//      return  print_r($article);
        $this->assign('articleList',$article);

        $category= category::where('pid',0)->select();


        $this->assign('categoryList',$category);



        return $this->fetch();
    }

    //发帖交流详情
    public function show()
    {
        $re = $this->request;
        $id = $re->param('id');



        if ($id == 0){
            $where = [];
        }else{
            $where['category_id'] = $id;
        }

        $this->assign('id',$id);

        $article = article::where($where)->find();

        $this->assign('articleList',$article);

        $category = category::where('pid',0)->select();
        $this->assign('categoryList',$category);
        $article->setInc('hits');
        $this->assign('id',$id);
        return $this->fetch();
    }




    //分类
    protected function categoryLast($id)
    {
        $category = category::where('pid',$id)->select();
        $this->assign('category',$category);
        return $category;

    }

}
