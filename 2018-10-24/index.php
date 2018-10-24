<?php
    function Read($target)
    {
        $array = array();
        $f = fopen($target,"r");
        while(!feof($f))
        {
            $row = fgets($f);
            $row = explode(";",$row);
            $T['datum'] = $row[0]; 
            $T['hazai'] = $row[1]; 
            $T['vendeg'] = $row[2]; 
            $T['hazaigol'] = trim(explode(':',$row[3])[0]);
            $T['vendeggol'] = trim(explode(':',$row[3])[1]); 
            array_push($array, $T);
        }
        fclose($f);
        return $array;
    }
    $M = Read("T:/slo/13A/nb1.csv");
    $vendeggyozelem = 0;
    $hazaigyozelem = 0;
    $dontetlen = 0;
    $pontok = "";
    $kiir = "Dolgozat";
    $csapat = "";

    foreach ($M as $i) {
        if ($i['hazaigol'] > $i['vendeggol']) $hazaigyozelem++;
        else if ($i['hazaigol'] < $i['vendeggol']) $vendeggyozelem++;
        else $dontetlen++;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $pontok = 0;
        $csapat = $_POST['csapat'];
        foreach ($M as $i) {
           if (trim(strtolower($i['vendeg'])) == trim(strtolower($csapat)))
           {
               $kiir = $i['vendeg'];
               if ($i['vendeggol'] > $i ['hazaigol']) $pontok += 3;
               else if ($i['vendeggol'] == $i ['hazaigol']) $pontok++;
               echo $pontok . " ";
           }
           else if (strtolower($i['hazai']) == strtolower($csapat))
           {
                $kiir = $i['hazai'];
                if ($i['vendeggol'] < $i ['hazaigol']) $pontok += 3;
                else if ($i['vendeggol'] == $i ['hazaigol']) $pontok++;
                echo $pontok . " ";
           }
        }
        if ($pontok == -1) $pontok = "Ilyen csapat nem létezik!";
        else $pontok .= " pont";
    }

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $kiir;?></title>
</head>
<style>
    table, td{
        border: 1px solid black;
    }
    tr:nth-child(odd){
        background-color: lightgray;
    }
    tr:nth-child(even){
        background-color: gray;
    }
    th{
        background-color: black;
        color: white;
        padding: 10px;
    }
    td{
        padding: 10px;
        text-align:center;
        width: 120px;
    }
    input[type=text]
    {
        padding: 10px;
    }
    input[type=submit]
    {
        padding: 10px;
    }
</style>
<body>
    <h1>Hazai győzelem: <?php echo $hazaigyozelem;?></h1>
    <h1>Vendég győzelem: <?php echo $vendeggyozelem;?></h1>
    <h1>Döntetlen: <?php echo $dontetlen;?></h1>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="submit" value="Pontok kiirása">
    <input type="text" name = "csapat" placeholder="Csapatneve: "> : 
    <span><?php echo $pontok; ?></span> <br> <br>
    
</form>
    <table>
        <tr>
            <th>Dátum</th>
            <th>Hazai</th>
            <th>Vendég</th>
            <th>Hazai gólok</th>
            <th>Vendég gólok</th>
        </tr>
        <?php
            foreach ($M as $i) {
                echo "<tr>";
                foreach ($i as $j) {
                    echo "<td>$j</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
    
</body>
</html>