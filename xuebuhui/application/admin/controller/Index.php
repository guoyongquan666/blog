<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/5/30
 * Time: 下午2:47
 */

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{

    public function console()
    {
        return $this->fetch();
    }

    public function index()
    {
        return $this->fetch();
    }
}