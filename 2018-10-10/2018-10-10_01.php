<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        if (isset($_POST['user']))
        {
            $f = fopen("users.txt", "r");
            $belepve = 0;
            while(!feof($f) && $belepve == 0)
            {
                $sor = fgets($f);
                //$tomb = explode(":", $sor);
                list($fuser, $fpass) = explode(":",$sor);
                if ($_POST["user"] == trim($fuser))
                {
                    if ($_POST["password"] == trim($fpass))
                    {
                        $belepve = 1;
                    }
                    else
                    {
                        $belepve = -1;
                    }
                }
            }
            var_dump($belepve);
            fclose($f);
        }
        if (!isset($belepve) || $belepve != 1)
        {
            echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
            <label>Usernév:</label><input type="text" name="user">
            <label>Jelszó:</label><input type="password" name="password">
            <input type="submit" value="Belépés">
        </form>';
        }
    ?>
    
</body>
</html>