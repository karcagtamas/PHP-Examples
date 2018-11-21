<?php
    include("connect.php");

    $alert = "";
    $success = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $table = $_POST['tablename'];
        $src = $_POST['source'];
        $names = array();
        $types = array();
        $datas = array();
        if ($src != "")
        {
            if ($table != "")
            {

                $f = fopen($src, 'r');

                $names = explode(';',fgets($f));
                $types = explode(';', fgets($f));
                
                while(!feof($f))
                {
                    $row = explode(';', fgets($f));
                    array_push($datas, $row);
                }
                fclose($f);

                $sql = "DROP TABLE IF EXISTS $table";

                $sql = "CREATE TABLE $table (";
                for ($i=0; $i < count($names); $i++) { 
                    $sql .= trim($names[$i], ' ') . " ";
                    $sql .= trim($types[$i], ' ') . " ";
                    if ($i == count($names) - 1) $sql .= "NOT NULL";
                    else $sql .= "NOT NULL,";
                }
                $sql .= ");";
                $db->query($sql);

                $body = "INSERT INTO $table (";

                for ($i=0; $i < count($names); $i++) {
                    if ($i == count($names) - 1) $body .= trim($names[$i], ' ');
                    else $body .= trim($names[$i], ' ') . ",";
                }

                $body .= ") VALUES (";
                

                for ($i=0; $i < count($datas); $i++) { 
                
                    $sql = $body;
                    for ($j=0; $j < count($names); $j++) { 
                        if ($j == count($names) - 1) $sql .= "'".$datas[$i][$j]."'";
                        else $sql .= "'".$datas[$i][$j]."',";
                    }

                    $sql .= ");";
                    
                    $db->query($sql);
                }
                $success = "A tábla sikeresn létrehozva a megadott adatokkal!";
            }
            else $alert = "Nem adtál meg tábla nevet!";
        }
        else $alert = "Nem adatál meg forrás fájlt!";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style>
    form{
        margin: 1rem;
        padding: 1rem;
    }
    .alert{
        margin-top: 1rem;
    }
</style>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="border rounded">
        <div class="form-group">
            <label>Tábla neve:</label>
            <input class="form-control" type="text" name="tablename">
        </div>
        <div class="form-group">
            <label>Forrás:</label>
            <input class="form-control" type="file" name="source">
        </div>
        <input class="btn btn-dark" type="submit" value="Importálás">
        <?php 
            if ($alert != "") echo "<div class='alert alert-danger'>$alert</div>";
            if ($success != "") echo "<div class='alert alert-success'>$success</div>";
        ?>
    </form>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>