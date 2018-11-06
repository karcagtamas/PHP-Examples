<?php
session_start();
include("database.php");
$report = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* $f = fopen("users.txt", "r");
    $b = true;
    while(!feof($f) && $b)
    {
        $row = explode(';', fgets($f));
        if ($username == $row[0] && $password == $row[1])
        {
            $b = false;
        }
    }
    fclose($f);
    if ($b) $report = "Hibás adatok! Kérjük próbálkozzon újra!";
    else 
    {
        $_SESSION['username'] = $username;
        header('location: forum.php');
    } */

    $sql = "SELECT COUNT(username) FROM users WHERE username LIKE '$username';";
    $result = mysqli_query($db, $sql);
    if (mysqli_fetch_array($result)[0] == 1)
    {
        $sql = "SELECT password FROM users WHERE username LIKE '$username';";
        $result = mysqli_query($db, $sql);
        if (password_verify($password, mysqli_fetch_array($result)[0]))
        {
            $_SESSION['username'] = $username;
            header('location: forum.php');
        }
        else
        {
            $report = "Hibás jelszó, kérjük próbálja újra!";
        }
    }
    else
    {
        $report = "Hibás felhasználónév vagy jelszó!";
    }

}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Login</title>
</head>
<style>
    form{
        margin: 10px;
    }
     a{
        color: white;
        text-decoration: none;
    }
</style>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="col col-4 border rounded">
    <div class="form-group">
    <label>Username</label>
    <input class="form-control" type="text" name="username">
    </div>
    <div class="form-group">
    <label>Password</label>
    <input class="form-control" type="password" name="password">
    </div>
    <div id="reg" class="btn btn-primary float-right"><a href="registration.php">Regisztráció</a></div>
    <input class="btn btn-primary" type="submit" value="Bejelentkezés">
    <br> <br>
    <?php
        if ($report != "")
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$report.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        } 
    ?>
    
    </form>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>