<?php 
session_start();
include("database.php");
if (!isset($_SESSION['username']))
{
    header('location: login.php');
}
if (isset($_GET['id']))
{
    $sql = "SELECT n.id, n.title, n.creation_time, n.last_modify, u.username, n.content FROM news n
    INNER JOIN users u ON n.creater = u.id
    WHERE n.id = $_GET[id] and n.end_time > NOW();";
    $result = $db->query($sql);
    $news = array();
    if ($result->num_rows > 0)
    {
        $news = $result->fetch_assoc();
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
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">
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
    #logout{
        margin: 20px;
    }
    #back{
        margin: 20px;
    }
    .element{
        margin: 10px;
        padding: 10px;
        background-color: #ffffcc;
    }
    *{
        font-family: 'Noto Serif', serif!important;
    }
</style>
<body>
    <a href="logout.php" id="logout" class="btn btn-primary float-right col-1">Kijelentkezés</a>
    <a href="portal.php" id="back" class="btn btn-primary float-right col-1">Vissza</a>
    <div class="username border rounded col-9">
        <h1>Belépett felhasználó: <?php echo $username ?></h1>
        <small>Regisztráció: <?php echo $reg_time ?></small>
       
    </div>
    <div>
        <?php
            if (count($news) > 0)
            {
                
                    echo "<div class='element border rounded'>";
                    echo "<h4>$news[title]</h4>";
                    echo "<small>Megjelenés dátuma: $news[creation_time]</small><br>";
                    echo "<small>Készítette: $news[username]</small>";
                    if (!is_null($news['last_modify']))
                    echo "<br><small>Utoljára szerkesztve: $news[last_modify]</small>";
                    echo "<hr>";
                    echo "<p>$news[content]</p>";
                    echo "</div>";
            }
            else 
            {
                echo "<div class='element border rounded'>";
                echo "<h1>Nincs megjeleníthető adat!</h1>";
                echo "</div>";
            }
        ?>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>