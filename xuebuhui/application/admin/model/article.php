<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/5/31
 * Time: 下午4:31
 */

namespace app\admin\model;

use think\Model;

class article extends Model
{

    //自动事件
    protected $autoWriteTimestamp = true;

    public function category()
    {

        return $this->belongsTo('category','category_id','id');

    }



}