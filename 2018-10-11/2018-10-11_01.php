<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password</title>
</head>
<body>
    <?php
        $f = fopen("passwd.csv", "r");
        echo "<table>";
        while(!feof($f))
        {
            $row = fgets($f);
            $array = array();
            $array = explode(":", $row);
            
            echo "<tr>";
            foreach ($array as $key => $value) {
                echo "<td>".$value."</td>";
            
            }
            echo "</tr>";
           
            
            
        }
        echo "</table>";
        fclose($f);
        var_dump(password_hash("root", PASSWORD_DEFAULT));
    ?>
    
</body>
</html>