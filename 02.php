<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Second Project</title>
</head>
<body>
    <ul>
     <?php
     
     for ($i = 0;$i <= 10; $i++)
     {
        //echo "<li>$i</li>"; --> megtalálja a változót a stringben ($)
        echo "\n\t<li>".($i*2)."</li>"; //. --> összefűzöm a szöveget
        //\t ---> tabulátor
        //\n --> sortörés
     }
     ?>
     
     </ul>
     <br>
     <table border='1'>
     <?php
        for ($i=0; $i < 10; $i++) 
        { 
            echo "\n<tr>";
             for ($j=0; $j < 10; $j++) 
            { 
                $a = rand(0,100); //rand(); ---> random szám generálás
                echo "\n<td>$a</td>";
            }
            echo "\n</tr>";
        }
     
     ?>
     </table>
</body>
</html>