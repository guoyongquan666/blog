<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>


<script src="axios.js"></script>
<script>

    axios.get('1.php').then(function (e) {
        console.log(e.data.name)
    });


</script>
</body>
</html>