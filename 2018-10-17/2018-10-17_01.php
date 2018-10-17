<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DHCP</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <input type="submit" value="Új IP kérése">
    </form>
    <br>
    <?php
        require("config.php");
        $reserved = array();
        $f = fopen($FILE,"r") or die("No file");
        while(!feof($f))
        {
            $sor = trim(fgets($f));
            if ($sor != "") $reserved[] = $sor;
        }
        fclose($f);
        //IP felszabadítás
        if (isset($_GET['ip']))
        {
            $index = array_search($_GET['ip'], $reserved);
            if ($index != -1) unset($reserved[$index]);
            //unset($reserved[0]);
        }

        //IP kiosztás
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $b = true;
            for ($i=$FIRST; $i <= $LAST && $b; $i++) { 
                if (array_search($i, $reserved) === false)
                {
                    array_push($reserved, $i);
                    $b = false;
                }
            }
            if ($b) echo "Nem osztható ki több IP cím!";
            else
            {
                $string = "<h1>Új IP cím</h1>"; 
                $string .= "<table>";
                $string .= "<tr><td>IP</td><td>$NET.".$reserved[count($reserved) - 1]."</td><tr>";
                $string .= "<tr><td>MASK</td><td>$MASK</td><tr>";
                $string .= "<tr><td>GateWay</td><td>$GW</td><tr>";
                $string .= "<tr><td>DNS1</td><td>$DNS1</td><tr>";
                $string .= "<tr><td>DNS2</td><td>$DNS2</td><tr>";
                $string .= "</table>";
                echo $string;
            }
        }

        sort($reserved);
        $out = "<h1>Kiosztott címek:</h1>";
        $out .= "<table>";
        foreach ($reserved as $value) {
            $out .= "<tr><td>";
            $out .= $NET.".".$value;
            $out .= "</td><td>
                    <a href='$_SERVER[PHP_SELF]?ip=$value'>Felszabadít</a>
                    </td></tr>";
        }
        $out .= "</table>";
        echo $out;


        $string = "";
        foreach ($reserved as $value) {
            $string .= $value."\n";
        }
        var_dump($string);
        $f = fopen($FILE,"w") or die("No file");
        fwrite($f, $string);
        fclose($f);
        
    ?>
</body>
</html>