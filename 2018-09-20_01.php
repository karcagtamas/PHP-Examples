<?php
    $A = $B = $operator = "";
    if (isset($_POST['A']) && isset($_POST['B']) && isset($_POST['operators']))
    {
        $A = $_POST['A'];
        $B = $_POST['B'];
        $operator = $_POST['operators'];
    }
    else
    {
        $A = $B = 0;
        $operator = "+";
    }
    $result = 0;


    $output = "0";
    $button = "";
    $result2 = "";
    if (isset($_POST['output']) && isset($_POST['button']))
    {
        $output = $_POST['output'];
        $button = $_POST['button'];
    }
    if ($button != "=")
    {
        if ($output == "0") $output = $button;
        else $output .= $button;
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Számológép</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="number" name="A" id="A" value="<?php if ($A != '') echo $A; ?>">
        <select name="operators" id="operators">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>            
        </select>
        <input type="number" name="B" id="B" value="<?php if ($B != '') echo $B; ?>">
        <input type="submit" value="=">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if ($operator == "+")
            {
                $result = $A + $B;
            }
            if ($operator == "-")
            {
                $result = $A - $B;
            }
            if ($operator == "*")
            {
                $result = $A * $B;
            }
            if ($operator == "/")
            {
                if ($B != 0) $result = $A / $B;
                else $result = "Nullával nem lehet osztani";
            }     
        }
        ?>
        <input type="number" name="ered" id="ered" value="<?php echo $result; ?>">

        
        

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $button == "=")
        {
            $char = '+';
            if (strpos($output, '+')) $char = '+';
            if (strpos($output, '-')) $char = '-';
            if (strpos($output, '*')) $char = '*';            
            if (strpos($output, '/')) $char = '/';
            
            $string = explode($char, $output);
            $numA = $string[0];
            $numB = $string[1];

            if ($char == "+")
            {
                $result2 = $numA + $numB;
            }
            if ($char == "-")
            {
                $result2 = $numA - $numB;
            }
            if ($char == "*")
            {
                $result2 = $numA * $numB;
            }
            if ($char == "/")
            {
                $result2 = $numA / $numB;
            }
            $output = "";
        }
        ?>
        <br><br><br>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="submit" name="button" value="1">
            <input type="submit" name="button" value="2">
            <input type="submit" name="button" value="3">
            <br>
            <input type="submit" name="button" value="4">
            <input type="submit" name="button" value="5">
            <input type="submit" name="button" value="6">
            <br>
            <input type="submit" name="button" value="7">
            <input type="submit" name="button" value="8">
            <input type="submit" name="button" value="9">
            <br>
            <input type="submit" name="button" value="0">
            <br>
            <input type="submit" name="button" value="+">
            <input type="submit" name="button" value="-">
            <input type="submit" name="button" value="*">
            <input type="submit" name="button" value="/">
            <br>    
            <input type="submit" name="button" value="=">
            <br>
            <input type="text" name="output" id="output" value="<?php if($output != "") echo $output; else echo "0"; ?>">
            <input type="number" name="result" id="result" value="<?php echo $result2; ?>">
        </form>

        
        



    </form>
</body>
</html>