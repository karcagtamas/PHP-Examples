<?php
if (isset($db))
{
    $sql = "SELECT t.id, t.name, t.creation_time, u.username FROM topics t INNER JOIN users u ON t.creater = u.id ORDER BY t.creation_time DESC;";
    $result = mysqli_query($db, $sql);
    $array = array();
    while($data = mysqli_fetch_assoc($result))
    {
        array_push($array, $data);
    }
    if (count($array) != 0)
    {
    foreach ($array as $i) {
        echo "<div class='post border rounded col col-6'>";
        echo "<a href=".$_SERVER['PHP_SELF']."?topic=".$i['id']." class='btn btn-secondary float-right'>Megnyitás</a>";
        echo "<h2>".$i['name']."</h2>";
        echo "<h6>Létrehozva: ".$i['creation_time']."</h6>";
        echo "<h6>Létrehozó: ".$i['username']."</h6>";
        echo "</div>";  
    }
    }
    else
    {
         echo "<div class='post border rounded col col-6'>";
         echo "<h2>A fórumon nem található semmilyen beszélgetés!</h2>";
         echo "</div>";  
    }
} 
?>