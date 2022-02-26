<?php
phpinfo();
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  'Sistran2021',
  'php_mysql_crud',
  8080
) or die(mysqli_erro($mysqli));

?>
