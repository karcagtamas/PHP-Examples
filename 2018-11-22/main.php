<?php
    include("connect.php");
    $db->query("SET CHARACTER SET utf8");
    $cities = array();

    function search_min($db){
        $min = 0;

        $sql = "SELECT v.terulet FROM varos v ORDER BY v.terulet LIMIT 1;";
        $result = $db->query($sql);
        $min = $result->fetch_assoc();
        return $min['terulet'];
    }

    function search_max($db){
        $max = 0;

        $sql = "SELECT v.terulet FROM varos v ORDER BY v.terulet DESC LIMIT 1;";
        $result = $db->query($sql);
        $max = $result->fetch_assoc();

        return $max['terulet'];
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $cname = $_POST['cname'];
        $min = $_POST['min'];
        $max = $_POST['max'];
        $region = $_POST['region'];

        if ($min == "") $min = search_min($db);
        if ($max == "") $max = search_max($db);

        $sql = "SELECT v.id, v.vnev, m.mnev, v1.vtip, v.jaras, v.kisterseg, v.kisterseg, v.nepesseg, v.terulet FROM varos v
        INNER JOIN varostipus v1 ON v.vtipid = v1.id
        INNER JOIN megye m ON v.megyeid = m.id
        WHERE v.vnev LIKE '%$cname%' and m.id = '$region' and v.terulet <= '$max' and v.terulet >= '$min';";

        $result = $db->query($sql);

        while ($datas=$result->fetch_assoc())
        {
            array_push($cities, $datas);
        }
    }
    else
    {
        $sql = "SELECT v.id, v.vnev, m.mnev, v1.vtip, v.jaras, v.kisterseg, v.kisterseg, v.nepesseg, v.terulet FROM varos v
        INNER JOIN varostipus v1 ON v.vtipid = v1.id
        INNER JOIN megye m ON v.megyeid = m.id;";

       

        $result = $db->query($sql);

        while ($datas=$result->fetch_assoc())
        {
            array_push($cities, $datas);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Szürő</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <div id="form" class="border rounded row">
            <div class="form-group col-4">
                <label>Városnév: </label>
                <input type="text" name="cname" class="form-control">
            </div>
            <div class="form-group col-4">
                <label>Terület: </label> <br>
                <label>Minimum: </label>
                <input type="number" name="min" class="form-control">
                <label>Maximum:</label>
                <input type="number" name="max" class="form-control">
            </div>
            <div class="form-group col-4">
                <label>Megye: </label>
                <select name="region" class="form-control" >
                    <?php
                        $regions = array();
                        
                        $sql = "SELECT m.id, m.mnev FROM megye m;";
                        $result = $db->query($sql);
                        while ($datas=$result->fetch_assoc())
                        {
                            array_push($regions, $datas);
                        }
                        foreach ($regions as $i) {
                            echo "<option value='$i[id]'>$i[mnev]</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <input type="submit" value="Szűrés" class="btn btn-dark col-4 offset-4">
    </form>
    <?php
        if (count($cities) == 0)
        {
            echo "<h1>Nincs megjeleníthető adat!</h1>";
        }
        else
        {
            echo "<h1 class='text-center'>Városok</h1>";
            echo "<table class='col-10 offset-1 border rounded'>";
            echo "<tr>";
            echo "<th>Id</th>";
            echo "<th>Városnév</th>";
            echo "<th>Megyenév</th>";
            echo "<th>Város típusa</th>";
            echo "<th>Járás</th>";
            echo "<th>Kistérség</th>";
            echo "<th>Népesség</th>";
            echo "<th>Terület</th>";
            echo "</tr>";
            foreach ($cities as $city) {
                echo "<tr>";
                foreach ($city as $i) {
                    echo "<td>$i</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    
    ?>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php
$db->close(); 
?>