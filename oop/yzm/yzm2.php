<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<form action="yzm3.php" method="post">
    <input type="text" name="yzm">
    <img src="./yzm1.php" id="yzm" alt="">
    <button type="submit">提交</button>
</form>

<script>


    var yzm = document.getElementById('yzm');
    yzm.style.cursor = 'pointer';
    yzm.onclick = function () {

        var url = './yzm1.php?'+ Math.random();
        this.setAttribute('src', url);

    }


</script>
</body>
</html>