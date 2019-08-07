<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    //指定该模型对应的表名为：test
    protected $table = 'user';
    //指定该模型的主键为：uid
    protected $primaryKey = 'id';
    //禁用自动添加时间戳功能，注意是public
    public $timestamps = false;
}
