
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
    <?php
        $row = 10;
        $col = 10;
        for ($i=0; $i <= $row; $i++) 
        { 
            echo "<tr>";
            for ($j=0; $j <= $col; $j++) 
            { 
                if ($i == 0 && $j == 0)
                {
                    echo "<th>#</th>";
                }

                if ($i == 0 && $j != 0)
                {
                    echo "<th>$j</th>";
                }
                if ($j == 0 && $i != 0)
                {
                    echo "<th>$i</th>";
                }
                if ($j != 0 && $i != 0)
                {
                    $x = $i * $j;
                    echo "<td>$x</td>";
                }
            }
            echo "</tr>";
        }
    ?>
    </table>
</body>
</html>