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
    <title>Proizvodi</title>
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
    <div id="add_item_row">
        <div id="add_item_button">
        <a href="add-item.php" style="font-weight:700;">Dodaj proizvod</a>
        </div>
    </div>
<table style="margin-top:30px">
    <thead>
      <tr>
      <!-- SLIKA -->
      <th></th>
      <th>Ime</th>
      <th>Cijena</th>
      <th>Količina</th>
      <!-- UREDI BUTTON -->
      <th></th>
      </tr>
    </thead>
    <?php
    require_once '../../db.php';
    $sql = "SELECT * FROM items";
    $stmt =  mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: index.php?error=stmterror");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($rows = mysqli_fetch_all($res, MYSQLI_ASSOC)) {
        foreach ($rows as $row) {
            echo <<<text
                <tr>
                <td><img src="{$row["url"]}" width="160" height:"90"></td>
                <td>{$row["name"]}</td>
                <td>{$row["price"]}</td>
                <td>{$row["quantity"]}</td>
                <td>
                <form action="update-item.php" method="POST">
                    <input type="text" name="name" value="{$row['name']}" style="display:none;">
                    <input type="text" name="price" value="{$row['price']}" style="display:none;">
                    <input type="text" name="url" value="{$row['url']}" style="display:none;">
                    <input type="text" name="quantity" value="{$row['quantity']}" style="display:none;">
                    <input type="text" name="id" value="{$row['id']}" style="display:none;">
                    <button id="button_edit_item" type="submit" name="submit">Azuriraj podatke</button>    
                </form>
                </td>
                </tr>
                text;
        }
    }
    ?>
</div>
</body>

</html>