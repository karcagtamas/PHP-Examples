<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <?php
        $f = fopen("passwd.csv", "r");
        $x = 0;
        echo "<table id='example' class='display' style='width:100%'>";
        while(!feof($f))
        {
            $row = fgets($f);
            $array = array();
            $array = explode(":", $row);

            if ($x == 0)
            {
                echo "<thead><tr>";
                foreach ($array as $key => $value) {
                    
                    echo "<th>".$value."</th>";
                }
                echo "</tr></thead>";
            }
            else
            {
                if ($x == 1) echo "<tbody>";
                echo "<tr>";
                foreach ($array as $key => $value) {
                    
                    if ($x == 0) echo "<th>".$value."</th>";
                    else echo "<td>".$value."</td>";
                }
                echo "</tr>";
            }
            
            
           $x++;
        }
        echo "<tfoot><tr>";
        echo "</tr></tfoot>";
        echo "</tbody></table>";
        fclose($f);
        var_dump(password_hash("root", PASSWORD_DEFAULT));
    ?>
    
</body>
</html>
<script>
 $(document).ready(function() {
    $('#example').DataTable();
} );
</script>