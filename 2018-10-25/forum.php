<?php 
session_start();
include("database.php");
if (!isset($_SESSION['username']))
{
    header('location: login.php');
}
if (isset($_GET['topic'])) $event = $_GET['topic'];
else $event = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_SESSION['username'];
    if (isset($_POST['submit'])) { $topicname = $_POST['topicname'];
    $f = true;
    if (trim($topicname) == "") $f = false;

    if ($f)
    {
        $sql = "SELECT id FROM users WHERE username LIKE '$username'";
        $result = mysqli_query($db, $sql);
        $result = mysqli_fetch_assoc($result);
        $userid = $result['id'];
        $sql = "INSERT INTO topics(name, creater) VALUES('$topicname', '$userid');";
        mysqli_query($db, $sql);
    }
    /* $f = fopen('post.txt', "r");
    $current = fread($f, filesize('post.txt'));
    fclose($f);
    $f = fopen('post.txt', "w");
    fwrite($f, $username.";".$text."¤".$current);
    fclose($f); */
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
    <title>Forum</title>
</head>
<style>
    .post{
        margin: 10px;
        padding: 10px;
    }
    form, #modal{
        
        margin: 10px;
    
    }
    a{
        color: white;
        text-decoration: none;
    }
    #logout, #back{
        margin: 20px;
    }
</style>
<body>
    <a href="logout.php" id="logout" class="btn btn-primary float-right">Kijelentkezés</a>
    <?php if($event) echo "<a href='forum.php' id='back' class='btn btn-primary float-right'>Vissza</a>"; ?>
    <h1 class="post border rounded col col-6">Belépett felhasználó: <?php echo $_SESSION['username'] ?></h1>

    <?php if (!$event) echo "<button id='modal' type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>Új beszélgetés létrehozása</button>" ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Új Beszélgetés</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
        <label>Beszélgetés neve:</label>
        <input class="form-control" type="text" name="topicname">
        </div>
        <input class="btn btn-primary" type="submit" value="Mentés" name="submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <br>
    <?php
    if (!$event)
    {
        include("topics.php");
    }
    else
    {
        include("posts.php");
    }
       /*  $f = fopen("post.txt", "r");
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
        fclose($f);  */
    ?>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>