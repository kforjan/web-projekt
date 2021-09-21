<?php
require_once '../../auth-functions.php';
require_once '../../db.php';
require_once './orders-functions.php';
checkLoginState();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css" />
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <title>Orders</title>
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
  <a href="../../index.php">Početna</a>
  <hr>
  <a href="../items/index.php">Proizvod</a>
  <hr>
  <a style="color:black; font-weight:700;">Narudžba</a>
  <hr>
  <a href="../../logout.php">Odjava</a>
  <hr>
</div>
<div style="margin-left:300px;">
    <table>
    <thead>
      <tr>
      <th>Ime i Prezime</th>
      <th>Telefon</th>
      <th>Adresa</th>
      <th>Info o proizvodu</th>
      </tr>
    </thead>
    <?php
        foreach (retrieveAllOrders($conn) as $order) {    
            echo <<<text
                <tr>
                <td>{$order['firstname']} {$order["lastname"]}</td>
                <td>{$order["telephone"]}</td>
                <td>{$order["adress"]}</td>
                <td>{$order["orderText"]}</td>
                </tr>
                text;
        }
    ?>
    </table>
</div>
</body>
</html>