<!DOCTYPE html>
<html lang="ru-en">
<head>
    <meta charset="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Call Center - страница управления</title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/bootstrap/js/tether.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><?= $name?></a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">ссылка 1</a></li>
            <li><a href="#">ссылка 2</a></li>
        </ul>
        <button class="btn btn-danger navbar-btn">Управление</button>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="main/loginOut"><span class="glyphicon glyphicon-log-in"></span> Выход</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <h3><?=$content?></h3>

</div>



</body>
</html>