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
    <h2 id="add_item_title">Uredi proizvod</h2>
    <?php
    require_once '../../auth-functions.php';
    checkLoginState();
    if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $url = $_POST["url"];
    $quantity=$_POST["quantity"];
    echo <<<text
    <form action="update-item-inc.php" method="POST">
    <br>
    <label for="name">Ime proizvoda</label>
    <br>
    <input class="add_item_input" type="text" name="name" value="{$name}">
    <br>
    <label for="price">Cijena proizvoda</label>
    <br>
    <input class="add_item_input" type="text" name="price" value="{$price}">
    <br>
    <label for="quantity">Količina</label>
    <br>
    <input class="add_item_input" type="text" name="quantity" value="{$quantity}">
    <br>
    <label for="url">url proizvoda</label>
    <br>
    <input class="add_item_input" type="text" name="url" value="{$url}">
    <br>
    <input class="add_item_input" type="text" name="id" value="{$id}" style="display:none;">
    <br>
    <div id="edit_button_row">
    <input class="edit_item_buttons" type="submit" name="update" value="Azuriraj podatke" />  
    <input class="edit_item_buttons" type="submit" name="delete" value="Obrisi proizvod" />  
    <div>
    </form>
    text;
}
else{
    header("location: index.php?error=nijeMuDobro");
    exit();
}
?>
    </div>
</div>
</body>
</html>
