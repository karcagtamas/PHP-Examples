<?php
if (isset($db))
{
    if (isset($_GET['delete']))
    {
        $deleted = $_GET['delete'];
        $sql = "DELETE FROM topics WHERE id = '$deleted';";
        mysqli_query($db, $sql);
        header("location: ".$_SERVER['PHP_SELF']);
    }
    $modify = 0;
    if (isset($_GET['modify']))
    {
        $modify = $_GET['modify'];
    }
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
        if ($modify == 0) echo "<a href='".$_SERVER['PHP_SELF']."?topic=".$i['id']."' class='btn btn-secondary float-right'>Megnyitás</a>";
        if ($modify != $i['id']) echo "<h2>".$i['name']."</h2>";
        else 
        {
            echo "<a href='$_SERVER[PHP_SELF]' class='btn btn-secondary float-right'>Vissza</a>";
            echo "<form action='".$_SERVER['PHP_SELF']."' method='post' class='col col-12'>";
            echo "<input type='text' name='modify' value='".$i['name']."'>";
            echo "<input class='btn btn-secondary' type='submit' value='Mentés'>";
            echo "</form>";
        }
        if ($modify == 0 && $_SESSION['username'] == $i['username']) echo "<a href='".$_SERVER['PHP_SELF']."?delete=".$i['id']."' class='btn btn-secondary float-right' style='margin-left:5px;'>Törlés</a>";
        if ($modify == 0 && $_SESSION['username'] == $i['username']) echo " <a href='".$_SERVER['PHP_SELF']."?modify=".$i['id']."' class='btn btn-secondary float-right'>Szerkesztés</a>";
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