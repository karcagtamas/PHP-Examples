<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Főoldal</title>
    <link rel="stylesheet" href="2018-09-26_01.css">
</head>
<body>
    <?php
        include('header.html');
        include('menu.html');
        if (isset($_GET['oldal']))
        {
            if ($_GET['oldal'] == 1) include('t1.html');
            if ($_GET['oldal'] == 2) include('t2.html');
            if ($_GET['oldal'] == 3) include('t3.html');
        }
        include('footer.html');
        
    ?>
</body>
</html>