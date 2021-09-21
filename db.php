<?php
$servername = "eu-cdbr-west-01.cleardb.com";
$username = "bd6c8d24cded9d";
$password = "632e975b";
$dbname = "heroku_038551f96723284";
$port = "3306";
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}