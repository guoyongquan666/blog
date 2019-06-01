<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/6/1
 * Time: 上午9:49
 */

namespace app\admin\model;

use think\Model;

class images extends Model
{


    //
    protected $autoWriteTimestamp = true;

    public function category()
    {

        return $this->belongsTo('images','category_id','location');

    }

}