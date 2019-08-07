<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>手机验证码</title>
</head>
<body>

<form action="" method="post">
    手机号：<input id="mobile" type="text" name="mobile">
    <span id="info"></span>
    <br>
    验证码：<input id="yzm" type="text" name="yzm">
    <button id="send" type="button">发送短信验证码</button>
    <br>
    <button type="submit">提交</button>
</form>

<script src="../jquery-3.4.0.min.js"></script>
<script>

    var s = document.getElementById('send');
    var mobile = document.getElementById('mobile');

    s.onclick = function () {



        var mobileNum = mobile.value;
        var re = /1[5376894]\d{9}/;
        if(re.test(mobileNum)){

            var i = $(this);
            $(this).attr('disabled', 'disabled');
            var sec = 5;

            var xxx = setInterval(function () {
                --sec;
                if(sec <= 1){
                    $('#send').html('发送短信验证码');
                    clearInterval(xxx);
                    i.removeAttr('disabled');
                }else{
                    i.html( sec.toString() + '秒后重新发送');
                }

            }, 1000);

            $.post('yzmsms1.php', {mo: mobileNum}, function (e) {
                // console.log(e);
                // e = parseInt(e);
                // if (e){
                //     alert('发送成功')
                // }else{
                //     alert('发送失败')
                // }

                if(e.result == 0){
                    alert('发送成功');
                }else {
                    alert('发送失败');
                }

            }, 'json')

        }else{
            $('#info').html('请输入的手机号有误').css({'color':'red', 'font-size':'12px'})
        }
    }

</script>
</body>
</html>







