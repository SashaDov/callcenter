<!DOCTYPE html>
<html lang="ru-en">
<head>
    <meta charset="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Default Template</title>

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

<div class="container">
<h3><?=$content?></h3>
    <?= debug(vendor\core\Db::$countSql) ?>
    <?= debug(\vendor\core\Db::$queriesAll) ?>
</div>



</body>
</html>