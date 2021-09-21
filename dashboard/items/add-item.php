<?php
    require_once '../../auth-functions.php';
    checkLoginState();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../css/style.css" />
    <link rel="stylesheet" href="/../css/itemPage.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <title>Dodaj proizvod</title>
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
    <a  href="../../index.php">Početna</a>
    <hr>
    <a style="color:black; font-weight:700;">Proizvod</a>
    <hr>
    <a href="../orders/index.php">Narudžbe</a>
    <hr>
</div>
<div style="margin-left:300px;">
    <div id="add_item_form">
    <h2 id="add_item_title">Dodaj novi proizvod</h2>
    <form action="add-item-inc.php" method="post"><br>
        <label for="name">Ime proizvoda: </label><br>
        <input class="add_item_input" type="text" name="name" required><br>
        <label for="price">Cijena proizvoda: </label><br>
        <input class="add_item_input" type="number" name="price" required min="0.01" value="0" step="0.01"><br>
        <label for="quantity">Količina proizvoda: </label><br>
        <input  class="add_item_input" type="number" name="quantity" min="1" value="1" step="1" required><br>
        <label for="url">Url slike proizvoda: </label><br>
        <input  class="add_item_input" type="text" name="url" required><br>
        <button id="add_item_submit" type="submit" name="submit">Dodaj proizvod</button><br>
    </form>
    </div>
</div>
</body>
</html>