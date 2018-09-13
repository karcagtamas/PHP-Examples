<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="2018-09-13_01.css">
    <title>Regisztráció validácó</title>
</head>
<body>
    <?php
        /* foreach ($_POST as $key => $value) {
            echo "<p>Kulcs: $key - Érték: $value</p>";
        } */

        if ($_POST['name'] != "")
        {

        }
        else
        {
            echo "<p class='error'>A név megadása kötelező!";
        }
    ?>
</body>
</html>
