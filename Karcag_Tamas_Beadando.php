<?php
    $username = $password = $repassword = $nem = $email = $firstname = $lastname = $transport = $birth = "";
    $errusername = $errpassword = $erremail = $errfirstname = $errlastname = $errbirth = "";
    $succes = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $nem = $_POST['radio'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $birth = $_POST['birth'];
        $transport = $_POST['transport'];

        $past = new DateTime("1900-01-01");
        if (strlen($username) < 6) $errusername = "A felhasználó név nem lehet rövidebb 6 karakternél!";
        if (strlen($password) < 8) $errpassword = "A jelszó nem lehet rövidebb 8 karakternél!";
        else if ($password != $repassword) $errpassword = "A két megadott jelszó nem egyezik!";
        if (trim($firstname) == "") $errfirstname = "A vezetéknév nem maradhat üresen!";
        if (trim($lastname) == "") $errlastname = "A keresztnév nem maradhat üresen!";
        if ($birth == "") $errbirth = "Nem adtál meg születési dátumot!";
        else if ($birth > date("Y-m-d")) $errbirth = "Hogy születtél a jövőben?";
        else if ($birth < $past->format("Y-m-d")) $errbirth = "Túl régi születési évet adtál meg!";
        if ($errusername == "" && $errpassword == ""  && $erremail == ""  && $errfirstname == ""  && $errlastname == ""  && $errbirth == "")
        {
            $succes = "Sikeres regisztráció!";
        }
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Alegreya" rel="stylesheet">    
    <title>Regisztráció</title>
</head>
<body>
    <div id="registration-box">
        <h1>Regisztrációs Panel</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Felhasználónév:</label> <br>
        <input type="text" name="username" id="username" value="<?php echo $username;?>"> <br>
        <label>Jelszó:</label> <br>
        <input type="password" name="password" id="password"> <br>
        <label>Jelszó újra:</label> <br>
        <input type="password" name="repassword" id="repassword"> <br>
        <label>E-mail cím:</label> <br>
        <input type="email" name="email" id="email"> <br>
        <label>Születési dátum:</label> <br>
        <input type="date" name="birth" id="birth"> <br>
        <label>Vezetéknév:</label> <br>
        <input type="text" name="firstname" id="firstname"> <br>
        <label>Keresztnév:</label> <br>
        <input type="text" name="lastname" id="lastname"> <br>
        <label>Nem:</label>
        Férfi: <input type="radio" name="radio" id="ch_male" checked="checked">
        Nő: <input type="radio" name="radio" id="ch_female"><br>
        <label>Közlekedési eszköz:</label> <br>
        <select name="transport" id="transport">
            <option value="car">Autó</option>
            <option value="plane">Repülő</option>
            <option value="bike">Bicikli</option>
            <option value="waterbike">Vizi Bicikli</option>
            <option value="bus">Busz</option>
            <option value="train">Vonat</option>
            <option value="mother">Anyu</option>
            <option value="helicopter">Helikopter</option>
            <option value="panzerkampfwagen">Tank</option>
            <option value="jet">Sugármeghajtású Vadászgép</option>      
        </select> <br> <br>
        <div style="text-align:center;">
            <input type="submit" value="Regisztráció" class="button">
        </div>
        </form>
        <div class="err"><?php echo $errusername;?></div>
        <div class="err"><?php echo $errpassword;?></div>
        <div class="err"><?php echo $erremail;?></div>
        <div class="err"><?php echo $errfirstname;?></div>
        <div class="err"><?php echo $errlastname;?></div>
        <div class="err"><?php echo $errbirth;?></div>
        <div class="succes"><?php echo $succes;?></div>
    </div>
</body>
</html>
<style>
    #registration-box{
    border: 1px solid;
    padding: 10px;
    box-shadow: 5px 10px 8px #888888;
    border-radius: 10px;
    margin: auto;
    text-align: center;
    background-color: #990F0F;
    color: snow;
    font-family: 'Alegreya', serif;
    width: 500px;
}
h1{
    font-size: 40px;
    padding: 10px;
    border: 2px solid white;
    border-radius: 10px;
    background-color: #DD7804
}
.button{
    font-size: 40px;
    padding: 10px;
    border: 2px solid white;
    border-radius: 10px;
    background-color: #DD7804;
    color: snow;
    font-family: 'Alegreya', serif;
    font-weight: bold;
}
.button:hover{
    background-color: #914E02;
    transition: 500ms;
}
form{
    text-align: left;
}
label{
    font-size: 20px;
}
input[type=text], input[type=email], input[type=password], input[type=date]
{
    width: 93%;
    font-size: 20px;
    padding: 3px;
    margin: 10px;
}
select{
    width: 95%;    
    font-size: 20px;
    padding: 3px;
    margin: 10px;
}
.err{
    color: #D78181;
    font-size: 20px;
    font-weight: bold;
    font-style: italic;
}
.succes{
    color: #7CD67C;
    font-size: 20px;
    font-weight: bold;
    font-style: italic;
}
</style>