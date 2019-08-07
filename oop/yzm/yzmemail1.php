<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/5/5
 * Time: 下午6:59
 */

$email = $_POST['em'];

include_once '../PHPMailer/src/PHPMailer.php';
include_once '../PHPMailer/src/SMTP.php';
include_once '../PHPMailer/src/Exception.php';

use  PHPMailer\PHPMailer\PHPMailer;

$mail = new  PHPMailer();


//邮箱服务器的一些设置
$mail->isSMTP();
$mail->Host       = 'smtp.qq.com';
$mail->SMTPAuth   = true;
$mail->Username   = '1793904578@qq.com';
$mail->Password   = 'kqsietdgfrwtchhg';
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465;

//设置发送人的信息
$mail->setFrom('1793904578@qq.com','你爸爸');

//设置接收的邮件地址
$mail->addAddress($email);

//添加邮件的附件
$mail->addAttachment('1.jpg','旋涡鸣人参上.jpg');

$code = rand(1000,9999);

//邮件内容的设置
$mail->isHTML(true);
$mail->Subject   = '验证码';
$mail->Body      = '您的验证码为:'.$code;

if ($mail->send()){
    session_start();
    $_SESSION['code'] = $code;
    echo 1;
}else{
    echo 0;
}


