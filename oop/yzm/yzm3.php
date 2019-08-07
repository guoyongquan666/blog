<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/4/30
 * Time: 上午02:20
 */

$input = $_POST['yzm'];


session_start();

print_r($_SESSION['yyzzmm']);

//if ($_SESSION['yyzzmm'] != $input){
//    echo '您输入的验证码有误';
//}else{
//    echo 'OK';
//}

