<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/7/26
 * Time: 上午11:47
 */

class A
{

    //当方法名和类名相同时 此方法为构造方法
    public function A()
    {
        $this->aa = '大哥大';
    }

    //PHP7中  此构造方法级别最高 执行这个
    public function __construct()
    {

    }

    public function AA()
    {
        $this->aa = '大哥';
    }



}


$a = new A();
$a->AA();
print_r($a);