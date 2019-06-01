<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/6/1
 * Time: 上午9:48
 */



namespace app\admin\controller;

use app\admin\model\category;
use tests\ThumbTest;
use think\console\Table;
use think\Controller;
use think\Db;
use think\Image;


class Article extends Controller
{

    /**
     * 添加文章
     */
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

            if (\app\admin\model\article::create($data)){
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

    /**
     * 使用ajax获取文章分类
     */
    public function ajaxCategory()
    {
//        $request = $this->request;
        $pid = $this->request->param('id', 0);
        $data = category::where('pid', $pid)->select();
        return json($data);

//        if ($request->isAjax()){
//            $pid =$request->param('id',0);
//            if ($pid != 0){
//                $data = category::where('pid',$pid)->select();
//                return json($data);
//            }
//        }
    }


    /**
     * 文章列表
     */
    public function lists()
    {
        $list = \app\admin\model\article::with('category')->order('create_time DESC')->paginate(6);

        $this->assign('list', $list);
        return $this->fetch();
    }

    public function changeStatus()
    {
        $id = $this->request->param('id');
        if (empty($id)){
            return $this->error('非法操作');
        }

        $obj = \app\admin\model\article::get($id);
        if (empty($obj)){
            return $this->error('非法操作');
        }

        $obj->status = abs($obj->status - 1);

        if ($obj->save()){
            return $this->success('成功', '', $obj->status);
        }else{
            return $this->error('失败');
        }


    }


    /**
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     *
     * 删除文章
     */
    public function delete()
    {
        $request = $this->request;

        $id = $request->param('id');

        if (empty($id)){
            $this->error('非法操作');
        }

        $delete = \app\admin\model\article::get($id);

        if ($delete){
            $res =  \app\admin\model\article::where('id',$id)->delete();
            if ($res){
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }
        }else{
            $this->error('非法操作');
        }

    }


    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     *
     * 修改文章
     */
    public function revise()
    {

        $request = $this->request;
        if ($request->isGet()){
            $id = $request->param('id');
            $article =  \app\admin\model\article::with('category')->where('id',$id)->find();
            $path = '/'.$article->minthumb;



            //查询当前字段pid相同的字段
            $pid = $article['category']['pid'];
            $category = category::where('pid',$pid)->where('id','<>',$article['category_id'])->select();

            $this->assign('info',$article);
            $this->assign('category',$category);
            $this->assign('path',$path);
            return $this->fetch();
        }

        if ($request->isPost()){
            $data = $request->only(['title','author','content','category_id','update_time','thumb','minthumb']);
            $id = $request->param('id');


            $file = $this->request->file('picker');

            $info = $file->move('/static\/uploads/');
//            exit();
            if ($info) {


                //含有路径信息的文件名
                $pathh = $info->getPathname();
                //缩略图保存路径
                $min = $info->getPath() . '/min' . $info->getFilename();

                $im = Image::open($pathh);

                //生成缩略图
                $im->thumb(60, 60, Image::THUMB_CENTER)->save($min);
                return json(['code' => 1, 'thumb' => $pathh, 'min' => $min]);
            }
            $article=new \app\admin\model\article;
            if ($article->save($data,['id'=>$id])){
                $this->success('修改成功',url('admin/article/lists'));
            }else{
                $this->error('修改失败');
            }
        }
    }




    /**
     * @return \think\response\Json
     *
     * 图片上传服务端
     */
    public function  uploadImage()
    {

        $data = $this->request->file('file');
        $info = $data->validate(['size' =>1048576,'ext'=>'jpg,png,gif,jpeg'])->move('static/uploads/',true,false);

        if ($info){

            //含有路径信息的文件名
            $path = $info->getPathname();
            //缩略图保存路径
            $min = $info->getPath().'/min'.$info->getFilename();

            $im = \think\Image::open($path);

            //生成缩略图
            $im->thumb(60, 60, \think\Image::THUMB_CENTER)->save($min);
            return json(['code'=>1, 'thumb'=> $path, 'min'=> $min]);
        }else{
            return json(['code'=>0,'info'=>$data->getError()]);
        }

    }

    public function umUploadImage()
    {
        $configData = file_get_contents("static/ui/library/ue/config.json");
        $config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", $configData), true);

        if ($this->request->isGet()){
            return json_encode($config);
        }

        if ($this->request->isPost()){
            $image = $this->request->file('upfile');
            $allow = 'png,jpg,jpeg,gif,bmp,flv,swf,mkv,avi,rm,rmvb,mpeg,mpg,ogg,ogv,mov,wmv,mp4,webm,mp3,wav,mid,rar,zip,tar,gz,7z,bz2,cab,iso,doc,docx,xls,xlsx,ppt,pptx,pdf,txt,md';
            $res = $image->validate(['size'=>1048576, 'ext'=>$allow])->move('static/upload/');
            if ($res){
                $info =  [
                    "originalName" => $res->getFilename() ,
                    "name" => $res->getSaveName() ,
                    "url" => $res->getPathname() ,
                    "size" => $res->getSize() ,
                    "type" => $res->getExtension() ,
                    "state" => 'SUCCESS'
                ];
                return json_encode($info);
            }
        }else{
            return [
                'state' => 'ERROR'
            ];
        }
    }



    /**
     * @return mixed
     *
     * 上传文章
     */
    public function upload()
    {
        $request = $this->request;


        if ($request->isGet()){
            return $this->fetch();
        }

        if ($request->isPost()){
//            $data = $request->file('upload');
            $data = request()->file('upload');
            $info = $data->validate(['size'=>10485760,'ext'=>['jpg','png','gif','txt','php','html']])->move('./static/upload');
            if (!$info){
                //上传失败错误信息
                echo $data->getError();

            }
            $name = input('post.');
            //上传文件的原名
            $name['name'] = $_FILES['upload']['name'];

            if ($_FILES['upload']){
                $name['path'] = $this->image();
            }
            if ($info == true){
                $image = Image::open('./static/upload/');
                //按照原图的比例生成一个最大为400*400的略缩图替换原图
                $image->thumb(400,400)->save('./static/upload/');
                if ($info){
                    $res = [
                        'error' => 0,
                        'url' => str_replace('\\', '/','./static/upload/')
                    ];
                }else{
                    $res = [
                        'error' => 1,
                        "massage" => $data->getError()
                    ];
                }
                return json($res);

//               $res = Db::table('upload')->insert($name);

                $ku = $request->only(['id','name','path']);
                if (\app\admin\model\article::create($ku)){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }


        }
    }

    /**
     * @return mixed
     *
     * 获取上传文章的保存名称
     */
    public function image()
    {
        $file = $this->request->file('upload');

        if ($file){
            $info = $file->validate(['size'=>10485760,'ext'=>['jpg','png','gif','txt','php','html']])->move('./static/upload');
            if ($info){
                return $info->getPathname();
            }else{
                echo $info->getError();
            }
        }
        return $this->fetch();
    }




}










