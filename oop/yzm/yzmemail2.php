
<?php

/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/5/5
 * Time: 下午7:35
 */

session_start();

//print_r($_SESSION);
//
//print_r($_POST);

if ($_SESSION['code'] == $_POST['yzm']){
    echo "<script>alert('正确');history.forward();</script>";
}else{
    echo "<script>alert('验证码错误');history.back();</script>";
}
?>

