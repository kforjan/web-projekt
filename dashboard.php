<?php
require_once './auth-functions.php';
checkLoginState();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <title>Dashboard</title>
</head>
<body>
<div class="sidenav">
<figure>
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Emoji_u1f36d.svg/2048px-Emoji_u1f36d.svg.png" width="100" height="100" alt="CandyShop logo" aria-label="CandyShop logo" />
  </figure>
  <br>
  <br>
  <br>
  <br>
  <a href="index.php">Početna</a>
  <hr>
  <a href="../dashboard/items/index.php">Proizvod</a>
  <hr>
  <a href="../dashboard/orders/index.php">Narudžbe</a>
  <hr>
  <a href="logout.php">Odjava</a>
  <hr>
</div>
    <div style="margin-left:300px;">
    <div style="padding-top: 135px; margin-left:50px;">
        <h2>Info 1</h2>
        <h2>Info 2</h2>
        <h2>Info 3</h2>
</div>
</div>
</body>
</html>
