<?php 
session_start();
include("database.php");
if (!isset($_SESSION['username']))
{
    header('location: login.php');
}

$sql = "SELECT n.id, n.title, n.creation_time, n.last_modify, u.username, n.picture FROM news n
INNER JOIN users u ON n.creater = u.id
WHERE n.end_time > NOW();";

$result = $db->query($sql);

$news = array();
if ($result->num_rows > 0)
{
    while($row = $result->fetch_assoc()){
        array_push($news, $row);
    }
}

$username = $_SESSION['username'];
$sql = "SELECT u.registration_time FROM users u
WHERE u.username LIKE '$username';";
$result = $db->query($sql);
$result = $result->fetch_array();
$reg_time = $result[0];

$db->close();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Portal</title>
</head>
<style>
    .username{
        margin: 10px;
        padding: 10px;
        background-color: #9966ff;
    }
    a{
        color: white;
        text-decoration: none;
    }
    .element{
        margin: 10px;
        padding: 10px;
        background-color: #ffffcc;
    }
    .btn{
        margin: 5px;
    }
    *{
        font-family: 'Noto Serif', serif!important;
    }
    img{
        height: 100px;
        width: auto;
    }
</style>
<body>
<div class="row">
<div class="username border rounded col-8 col-lg-9">
        <h1>Belépett felhasználó: <?php echo $username ?></h1>
        <small>Regisztráció: <?php echo $reg_time ?></small>
</div>
<div class="col-3 col-lg-2">
<a href="logout.php" class="btn btn-primary col-12">Kijelentkezés</a>
    <a href="new.php" id="new" class="btn btn-primary col-12">Új hír</a>
</div>
</div>
   
    
    <div>
        <?php
            if (count($news) > 0)
            {
                foreach ($news as $i) {
                    echo "<div class='element row border rounded'>";
                    if (is_null($i['picture'])) echo "<div class='col-3 col-lg-2'><img src='default.jpg'></div>";
                    else echo '<div><img class="col-3" src="data:image/jpeg;base64,'.base64_encode( $i['picture'] ).'"/></div>';
                    echo "<div class='col-5 col-lg-8'>";
                    echo "<h4>$i[title]</h4>";
                    echo "<small>Megjelenés dátuma: $i[creation_time]</small><br>";
                    echo "<small>Készítette: $i[username]</small>";
                    if (!is_null($i['last_modify']))
                    echo "<br><small>Utoljára szerkesztve: $i[last_modify]</small>";
                    echo "</div>";
                    echo "<div class='col-4 col-lg-2'>";
                    echo "<a href='view.php?id=$i[id]' class='btn btn-primary col-12'>Megnyitás</a>";
                    echo "<a href='modify.php?id=$i[id]' class='btn btn-primary col-12'>Szerkesztés</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            else 
            {
                echo "<div class='element border rounded'>";
                echo "<h1>Nincs megjeleníthető hír!</h1>";
                echo "</div>";
            }
        ?>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>