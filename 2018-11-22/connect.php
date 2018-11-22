<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', '13a_varosok');

function connect()
{
  $con = mysqli_connect(DB_HOST ,DB_USER ,DB_PASS ,DB_NAME);

  if (mysqli_connect_errno($con)) {
    die("Sikertelen csatlakozás a adatbázishoz:" . mysqli_connect_error());
  }

  mysqli_set_charset($con, "utf8");

  return $con;
}

$db = connect();