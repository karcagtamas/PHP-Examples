<?php
    session_start();
include("database.php");
$report = "";
$errorusername = false;
$errorpassword = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
     $username = $_POST['username'];
     $password = $_POST['password'];
     $repassword = $_POST['repassword'];

     if (trim($password) == "") { $errorpassword = true; $report = "Kötelező kitölteni a jelszó mezőt!";}
     else if (strlen(trim($password)) != strlen($password)) { $errorpassword = true; $report = "Nem tartalmazhat szóközt a jelszó!";}
     else if ($password != $repassword) {$errorpassword = true; $report = "A két jelszó nem egyezik!";}

     if (trim($username) == "") { $errorusername = true; $report = "Kötelező kitölteni a felhasználónév mezőt!";}     
     else if (strlen(trim($username)) != strlen($username)) { $errorusername = true; $report = "Nem tartalmazhat szóközt a felhasználónév!";}
     else{

        $sql = "SELECT COUNT(username) FROM users WHERE username LIKE '$username';";
        $result = mysqli_query($db, $sql);
        if (mysqli_fetch_array($result)[0] != 0) {$errorusername = true; $report = "Már létezik ilyen felhasználónév";}
     }

     if (!$errorpassword && !$errorusername)
     {
         $hash = password_hash($password, PASSWORD_DEFAULT);
         $sql = "INSERT INTO users(username, password) VALUES ('$username', '$hash');";
         mysqli_query($db, $sql);
         header("location: login.php");
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
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">
    <title>Registration</title>
</head>
<style>
    form{
        margin: 10px;
    }
     a{
        color: white;
        text-dacoration: none;
    }
    a: hover{
        color: white;
        text-decoration: none;
    }
    *{
        font-family: 'Noto Serif', serif!important;
    }
</style>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="col col-4 border rounded">
    <div class="form-group">
    <label>Felhasználónév:</label>
    <input class="form-control" type="text" name="username">
    </div>
    <div class="form-group">
    <label>Jelszó:</label>
    <input class="form-control" type="password" name="password">
    </div>
    <div class="form-group">
    <label>Jelszó újra:</label>
    <input class="form-control" type="password" name="repassword">
    </div>
    <a href="login.php" id="log" class="btn btn-primary float-right">Bejelentkezés</a>
    <input class="btn btn-primary" type="submit" value="Regisztráció">
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