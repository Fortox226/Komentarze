<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'komentarze';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
  } //else {
//     echo "Connect succesfuly";
// }
?>