<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/5/7
 * Time: 上午11:04
 */

//接收数据， 发送短信



include_once '../qcloudsms/src/index.php';


use Qcloud\Sms\SmsSingleSender;



// 短信应用SDK AppID
$appid = 1400170241; // 1400开头
// 短信应用SDK AppKey
$appkey = "9ecace73ca78cfbcf1178e135c368a55";
// 需要发送短信的手机号码
//$phoneNumbers = ['15811311700'];
// 短信模板ID，需要在短信应用中申请
$templateId = 245450;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请
// 签名
$smsSign = "书生主页"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`


//您的验证码为{1}，{2}分钟内有效。

$code = rand(1000, 9999);

session_start();

$_SESSION['smscode'] = $code;

$ssender = new SmsSingleSender($appid, $appkey);
$result = $ssender->send(0, "86", $_POST['mo'],"您的验证码为".$code."，5分钟内有效。", "", "");
//$rsp = json_decode($result);
//echo $rsp;
echo $result;