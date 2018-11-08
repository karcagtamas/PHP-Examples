<div class="post border rounded col col-6 font-italic">
<?php
if (isset($db))
{
    if (isset($_GET['deletepost']))
    {

        $delete = explode(';',$_GET['deletepost']);
        $writer = $delete[0];
        $date = $delete[1];
        $topic = $_GET['topic'];
        $sql = "DELETE FROM posts WHERE writer = '$writer' and write_time = '$date';";
        mysqli_query($db, $sql);
        header("    : ".$_SERVER['PHP_SELF']."?topic=".$topic);
    }
    $report = "";
    $id = $_GET['topic'];
    $sql = "SELECT t.name, t.creation_time, u.username FROM topics t INNER JOIN users u ON t.creater = u.id WHERE t.id='$id' LIMIT 1;";
    $result = mysqli_query($db, $sql);
    $topic = mysqli_fetch_assoc($result);
    echo "<h2>".$topic['name']."</h2>";
    echo "<h6>Létrehozva: ".$topic['creation_time']."</h6>";
    echo "<h6>Létrehozta: ".$topic['username']."</h6>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_SESSION['username'];
        $content = $_POST['text'];
        if (trim($content) != "")
        {
            $sql = "SELECT id FROM users WHERE username LIKE '$username'";
            $result = mysqli_query($db, $sql);
            $result = mysqli_fetch_assoc($result);
            $userid = $result['id'];
            $sql = "INSERT INTO posts(content, writer, topic) VALUES('$content', '$userid', '$id')";
            mysqli_query($db, $sql);
        }
        else {
            $report = "Nem lehet üres elemet beküldeni!";
        }
    }
} 
?>
</div>
<form action="<?php echo $_SERVER['PHP_SELF']."?topic=$id";?>" method="post" class="border rounded col col-6">
    <div class="form-group">
        <h2>Poszt szövege:</h2>
        <?php
            if ($report != "") echo '<div class="alert alert-danger">'.$report.'</div>';
        ?>
        
        <textarea class="form-control" name="text" cols="30" rows="10"></textarea>
    </div>
    <input class="btn btn-primary"type="submit" value="Küldés">
    <br> <br>
</form>
<?php
if (isset($db))
{
    $id = $_GET['topic'];
    $sql = "SELECT p.content, u.username, p.writer, p.write_time, p.topic FROM posts p INNER JOIN users u ON p.writer = u.id WHERE p.topic = '$id' ORDER BY p.write_time DESC;";
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
        if ($_SESSION['username'] == $i['username']) echo "<a href='".$_SERVER['PHP_SELF']."?topic=".$i['topic']."&deletepost=".$i['writer'].";".$i['write_time']."' class='btn btn-secondary float-right'>Törlés</a>";
        echo "<h2>".$i['username']."</h2>";
        echo "<h6>Létrehozva: ".$i['write_time']."</h6>";
        echo "<hr>";
        echo "<div>".$i['content']."</div>";
        echo "</div>";  
    }
    }
    else
    {
        echo "<div class='post border rounded col col-6'>";
        echo "<h2>Ebben a beszélgetésben még nincs semmilyen tevékenység!</h2>";
         echo "</div>";  
    }
} 
?>
