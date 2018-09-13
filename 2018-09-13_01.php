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
    <div id="box">
    <?php
        /* foreach ($_POST as $key => $value) {
            echo "<p>Kulcs: $key - Érték: $value</p>";
        } */


        if ($_SERVER['REQUEST_METHOD'] == 'POST')  
        {
            if ($_POST['name'] != "")
            {
                if ($_POST['pass'] == $_POST['pass2'])
                {
                    echo "<p class='succes'>Sikeres regisztráció!</p>";
                }
                else
                {
                    echo "<p class='error'>A két jelszó nem egyezik!</p>";
                }
            }
            else
            {
                echo "<p class='error'>A név megadása kötelező!</p>";
            }
        }
        else
        {
            echo "<p class='error'>A név megadása kötelező!</p>";
            echo "<a href='2018-09-13_01.html'>Vissza lépés az Űrlaphoz</a>";
            die;
        }
    ?>
    </div>
</body>
</html>
