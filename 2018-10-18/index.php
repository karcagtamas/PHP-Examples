<?php

$SpecCities = array("Győr" => "gyor", "Budapest" => "BP", "Szeged" => "szeged","Miskolc" => "miskolc","Pécs" => "pecs");

function Read()
{
    $array = array();
    $f = fopen("T:/slo/13A/iranyitoszamok/irsz.csv","r");
    while(!feof($f))
    {
        $row = fgets($f);
        if ($row != "")
        {
            $T = explode(';',$row);
            $array[$T[0]] = trim(trim($T[1]), "*");
        }
    }
    fclose($f);
    return $array;
}

function ReadCity($string)
{
    $array = array();
    $f = fopen("T:/slo/13A/iranyitoszamok/$string.csv","r");
    while(!feof($f))
    {
        $row = fgets($f);

        if ($row != "")
        {
            $T = explode(';',$row);
            $array[trim($T[1])." ".trim($T[2])] = $T[0];
        }
    }
    fclose($f);
    return $array;
}

$inputirsz = "";
$outputcity = "";

$select = "";

$outputirsz = "";
$inputcity = "";

$write = false; 

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $inputirsz = $_POST['inputirsz'];
    $inputcity = $_POST['inputcity'];
    if (isset($_POST['select'])) $select = $_POST['select']; 

    $cities = Read();
    
    if (isset($cities[$inputirsz])) $outputcity = $cities[$inputirsz];
    else $outputcity = "Ilyen irányítószám nem létezik";

    if (in_array($inputcity, $cities))
    {
        $outputirsz = array_search($inputcity, $cities);
    }
    else $outputirsz = "Ilyen szám nem létezik";
    if (isset($SpecCities[$inputcity]))
    {
        
        $write = true;
    }

    
}



?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Irányító számok</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <input type="number" name="inputirsz" value="<?php echo $inputirsz?>"> : <?php echo $outputcity;?> <br>
        <input type="text" name="inputcity" value="<?php echo $inputcity?>"> : <?php echo "$outputirsz";?>
        <?php
            if ($write)
            {
                $City = ReadCity($SpecCities[$inputcity]);
                echo "<br>";
                echo "<select name='select'>";
                foreach ($City as $key => $value) {
                    echo "<option value=$value>$key</option>";
                }
                echo "</select>";
                echo " ".$select;
            } 
            
        ?>
        <br><input type="submit" value="Check">
    </form>
</body>
</html>
