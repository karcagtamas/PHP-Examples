<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>First Project</title>
</head>
<body>
    <b>alma</b>
    <?php

        $x = 0;
        echo("répa<br>"); //echo --> lehet zárójeles függvény, de lehet anélkül is használni
        echo "répa<br>";

        printf("répa<br>"); //printf ---> nincs nagy különbség

        echo gettype($x); //gettype --> visszaadja a változó típusát
        $x += 1.5;
        echo "<br>";
        echo $x;
        echo gettype($x);

        $x .= "körte"; //.= --> string összefűzés
        echo "<br>";
        echo $x;
        echo gettype($x);
        
        echo settype($x, "integer"); //settype ---> beállítja a változó típusát egy tetszőleges
        echo "<br>";
        echo $x;
    ?>
</body>
</html>