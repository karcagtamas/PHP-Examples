<?php 
session_start();
include("database.php");
if (!isset($_SESSION['username']))
{
    header('location: login.php');
}
$news = array();

$username = $_SESSION['username'];
$sql = "SELECT u.registration_time, u.id FROM users u
WHERE u.username LIKE '$username';";
$result = $db->query($sql);
$result = $result->fetch_assoc();
$reg_time = $result['registration_time'];
$userid = $result['id'];
$alert = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $content = $_POST['content'];
    $title = $_POST['title'];

    if (strlen($content) == 0 || strlen(trim($content)) == 0 || strlen($title) == 0 || strlen(trim($title)) == 0)
    {
        $alert = "Nem hagyhatsz üresen mezőket!";
    }
    else
    {
        $sql = "INSERT INTO news(title, creater, content, end_time)
        VALUES ('$title', '$userid', '$content', '2018-12-10');";
        $db->query($sql);
        header("location: portal.php");
    }
}

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
    textarea{
        width: 100%;
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
        <div class="element border rounded">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label>Add meg a hír címét:</label>
                <input type='text' name='title' placeholder='Cím'>
                <hr>
                <textarea name="content" rows="10" placeholder="Add meg a szövegét a hírnek"></textarea>
                <input type='submit' value='Mentés' class='btn btn-primary col-1'>
            </form>
        </div>
        <?php if (strlen($alert) != 0 || strlen(trim($alert)) != 0) echo "<div class='alert alert-danger'>$alert</div>"; ?>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>