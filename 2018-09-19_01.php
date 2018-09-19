<?php
    if(isset($_POST['A']) && isset($_POST['B']))
    {
        $A = $_POST['A'];
        $B = $_POST['B'];
    }
    else
    {
        $A = $B = "";
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="2018-09-19_01.css">
    <title>Téglalap</title>
</head>
<body>
    <div id="frame">
    <fieldset id="input">
        <legend>Téglalap</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <label>A:</label>
            <input type="number" name="A" id="A" step="0.001" min="0">
            <br> <br>
            <label>B:</label>
            <input type="number" name="B" id="B" step="0.001" min="0">
            <br><br>
            <div id="buttonframe">
                <input type="submit" value="Számítás" id="button">
            </div>
            
        </form>
    </fieldset>
    <br>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $A = htmlspecialchars($_POST['A']); 
            $B = htmlspecialchars($_POST['B']);
            $Kerület = ($A + $B) * 2;
            $Terület = $A * $B;
            echo "<fieldset id='data'>";
            echo "<legend>Adatok</legend>";
            echo "Kerület: $Kerület px";
            echo "<br> <br>";
            echo "Terület: $Terület px";
            echo "</fieldset>";
            echo "<br>";
            echo "<div id='rectangle' style='width:".$A."px; height:".$B."px'></div>";
        }
    ?>
    </div>
</body>
</html>