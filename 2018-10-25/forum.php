<?php 
session_start();
if (!isset($_SESSION['username']))
{
    header('location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_SESSION['username'];
    $text = $_POST['text'];
    $f = fopen('post.txt', "r");
    $current = fread($f, filesize('post.txt'));
    fclose($f);
    $f = fopen('post.txt', "w");
    fwrite($f, $username.";".$text."¤".$current);
    fclose($f);
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Forum</title>
</head>
<style>
    .post{
        margin: 10px;
        padding: 10px;
    }
    form{
        
        margin: 10px;
    
    }
</style>
<body>
    <h1>Belépett felhasználó: <?php echo $_SESSION['username'] ?></h1>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="border rounded col col-6">
    <div class="form-group">
        <label>Poszt szövege</label>
        <textarea class="form-control" name="text" cols="30" rows="10"></textarea>
    </div>
    <input class="btn btn-primary"type="submit" value="Post it">
    <br> <br>
    </form>
    <br>
    <?php
        $f = fopen("post.txt", "r");
        $content = explode('¤', fread($f, filesize('post.txt')));
        foreach ($content as $i) {
            $row = explode(';', $i);
            if (trim($row[0]) != "")
            {
            echo "<div class='post border rounded col col-6'>";
            echo "<h2>".$row[0]."</h2>";
            echo "<div>".$row[1]."</div>";
            echo "</div>";  
            }
        }
        fclose($f); 
    ?>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>