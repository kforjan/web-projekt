<?php
$servername = "eu-cdbr-west-01.cleardb.com";
$username = "b3a245c339162a";
$password = "74681909";
$dbname = "heroku_e0239b728b9cba5";
$port = "3306";
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}