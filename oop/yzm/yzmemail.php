<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>邮箱验证</title>
</head>
<style>
    body{
        background-color: snow;
    }
    #m{
        width: 420px;
        height: 200px;
        position: relative;
        left: 35%;
        top: 300px;
        
        background-color:rgb(150,110,75);
    }
    #yx{
        /*font-size: 15px;*/
        top: 37px;
        left: 15px;
        position: absolute;
        margin: 0;
        padding: 0;
    }
    #email{
        position: absolute;
        left: 100px;
        top: 40px;
        width: 200px;
        height: 20px;
    }
    #info{
        position: absolute;
        left: 310px;
        top: 46px;

    }
    #xx{
        top: 100px;
        left: 15px;
        position: absolute;
        margin: 0;
        padding: 0;
    }
    #yzm{
        position: absolute;
        left: 100px;
        top: 102px;
        width: 200px;
        height: 20px;
    }
    #send{
        position: absolute;
        bottom: 10px;
        left:72px;
        height: 40px;
        width: 130px;
    }
    #tt{
        position: absolute;
        bottom: 10px;
        right:110px;
        height: 40px;
        width: 70px;
    }
    #qq{
        position: absolute;
        right: 20px;
        color: snow;
    }

</style>

<body>
<div id="m">
    <h2 id="qq">
        权
        <br>
        哥
        <br>
        邮
        <br>
        箱</h2>
    <form action="yzmemail2.php" method="post" autocomplete="on">
        <h2 id="yx">邮箱:</h2>
        <input type="text" id="email" name="email">
        <span id="info"></span>
        <br>
        <h2 id="xx">验证码:</h2>
        <input type="text" name="yzm" id="yzm" autocomplete="off">
        <button id="send" type="button">发送邮箱验证码</button>
        <button id="tt" type="submit">提交</button>
    </form>

</div>


<script src="../jquery-3.4.0.min.js"></script>
<script>

    var s =     document.getElementById('send');
    var mail =  document.getElementById('email');

    s.onclick = function () {

        var email = mail.value;
        var  re = /\w+@\w+.[a-zA-Z]{2,10}/;

        if (re.test(email)){

            var i = $(this);
            $(this).attr('disabled','disabled');
            var sec = 60 ;

            var xxx = setInterval(function () {
                --sec;
                if (sec <= 0){
                    $('#send').html('发送验证码');
                    clearInterval(xxx);
                    i.removeAttr('disabled');
                } else {
                    i.html(sec.toString()+ '秒后重新发送')
                }
            },1000);

            $.post('yzmemail1.php', {em: email}, function (e) {
                console.log(e);
                e = parseInt(e);
                if (e){
                    alert('发送成功');
                } else {
                    alert('发送失败');
                }
            })


        }else {
            $('#info').html('*您输入的邮箱有误').css({'color': 'red', 'font-size': '12px'})
        }
    }

</script>

</body>
</html>