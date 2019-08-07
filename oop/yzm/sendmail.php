<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/5/5
 * Time: 上午11:05
 */

include_once '../PHPMailer/src/PHPMailer.php';
include_once '../PHPMailer/src/SMTP.php';
include_once '../PHPMailer/src/Exception.php';


use  PHPMailer\PHPMailer\PHPMailer;

$mail = new  PHPMailer();
//邮件服务器的一些设置
$mail->isSMTP();

//$mail->SMTPDebug=true ;

$mail->Host           = 'smtp.qq.com';
$mail->SMTPAuth       = true;

$mail->Username       = '1793904578@qq.com';
$mail->Password       = 'kqsietdgfrwtchhg';

$mail->SMTPSecure     = 'ssl';

$mail->Port           = 465;

//设置发送人的信息
$mail->setFrom('1793904578@qq.com','你爸爸');

//设置接受的邮箱地址
$mail->addAddress('1845727893@qq.com');

//添加邮件的附件
//$mail->addAttachment('./1.jpg','漩涡鸣人参上.jpg');

//邮件内容的设置
$mail->isHTML(true);
//$mail->Subject = '漩涡鸣人';
$mail->Subject = '验证码:';
//$mail->Body    ='那撸多 <div style="font-size: 90px;color: red;">我是要成为火影的男人!</div>';
$mail->Body    ='你的验证码为:'.rand(1000,9999);

//var_dump($mail->send());
var_dump($mail->ErrorInfo);


