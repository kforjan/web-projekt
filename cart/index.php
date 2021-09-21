<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/cartPage.css">
    <link rel="stylesheet" href="../css/style.css" />
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <title>Document</title>
</head>
<body>
    <script>
    function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
    }
    function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    }
    </script>
    <div id="mySidenav" class="sidenav">
        <figure>
            <img src="..\assets\svg\logo.svg" alt="Čvaci.net logo" aria-label="Čvarci.net logo" class="img-fluid" />
        </figure>
        <br>
        <br>
        <br>
        <br>
        <a href="../index.php">Početna</a>
        <hr>
        <a href="../dashboard/items/index.php">Proizvod</a>
        <hr>
        <a href="../dashboard/orders/index.php">Narudžbe</a>
        <hr>
        <a href="logout.php">Odjava</a>
        <hr>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  </div>
  <header>
    <figure id="menu_button" role="menu" onclick="openNav()">
      <img id="menu_button_ic" src="../assets/svg/ic-menu-navigation.svg" alt="Menu Button" aria-label="Menu" class="img-fluid"/>
    </figure>
    <figure >
      <img src="..\assets\svg\logo.svg" alt="Čvaci.net logo" aria-label="Čvarci.net logo" class="img-fluid" />
    </figure>
    <div id="buttons" aria-label="Account buttons">
      <div id="log_in" aria-label="Log in button">
        <span id="ic_person" class="iconify" data-icon="ic:baseline-person-outline" data-inline="false" aria-label="Person emoticon"></span>
        <span aria-label="Log in" onClick="openLoginPage()"> PRIJAVI SE </span>
      </div>
      <div id="cart" aria-label="Cart">
        <span onclick="toggleCart()" id="ic_cart" class="iconify" data-icon="ic:outline-shopping-cart" data-inline="false" aria-label="Cart Emoticon"></span>
        <span id="cart-items-count" aria-label="Number of items in cart">0</span>
        <div id="dropdown" class="dropdown-content">
          <div>
            <p>Moja košarica</p>
            <hr color=#F2F4FA>
            <br>
            <div id="cart-list">
            </div>
            <br>
            <hr color=#F2F4FA margin=0px>
            <button type="submit" name="submit" id="cart-buy-btn">Kupi sada</button>
          </div>
        </div>
      </div>
    </div>
  </header>
    <table>
    <thead>
      <tr>
      <!-- SLIKA -->
      <th></th>
      <th>Ime</th>
      <th>Cijena</th>
      <th>Količina</th>
      <th>Ukupno</th>
      </tr>
    </thead>
    <?php
            foreach($_SESSION["cartItems"] as $item){
                $style = "";
                if(isset($_SESSION['invalidQuantityItems']))
                {
                    foreach($_SESSION['invalidQuantityItems'] as $invalidItems) {
                    if ($invalidItems == $item['name']) {
                        $style = 'color:red;';
                        break;
                    }
                }
            }
            $total= $item["price"]*$item["quantity"];
            echo <<<text
                <tr>
                    <td><img src="{$item["url"]}" width="160" height="90"></td>
                    <td>{$item["name"]} </td>
                    <td>{$item["price"]}</td>
                    <td><div style ="{$style}">{$item["quantity"]}<div></td>
                    <td>$total</td>
                </tr>
                text;
            }
        ?>
    </table>
    <div id="customer_div">
        <form action="quantity-validation.php" method="post" id="customer_form">
                <h2 id="customer_title">Osobni podaci</h2>
                <label class="customer_label" for="firstname">Ime: </label>
                <br>
                <br>
                <input type="text" class="customer_input" name="firstname" required>
                <br>
                <br>
                <label class="customer_label" for="lastname">Prezime: </label>
                <br>
                <br>
                <input type="text" class="customer_input" name="lastname" required>
                <br>
                <br>
                <label class="customer_label" for="adress">Adresa: </label>
                <br>
                <br>
                <input type="text" class="customer_input" name="adress" required>
                <br>
                <br>
                <label class="customer_label" for="telephone">Broj Mobitela: </label>
                <br>
                <br>
                <input type="text" class="customer_input" name="telephone" required>
                <br>
                <br>
                <br>
                <?php
                    $totalPrice = 0;
                    foreach($_SESSION["cartItems"] as $item){
                        $totalPrice += $item['price'] * $item['quantity'];
                    }
                    echo "<div class=\"customer_label\">Total price: {$totalPrice} HRK</div>"
                ?>
                <button id="cart_submit" type="submit" name="submit">Kupi</button>
            </form>
    </div>
    <footer>
      <div id="footer_first_row">
        <div aria-label="footer_logo">
          <img src="..\assets\svg\logo.svg" alt="Čvaci.net logo" aria-label="Čvarci.net logo" class='logo'>
          <hr id='custom_line'>
        </div>
        <div aria-label="useful_links">
          <a href="http://O_nama.html" class="footer_pages_1" aria-label="About us">O nama</a>
          <a href="http://Cijenik.html" class="footer_pages_1" aria-label="Price list">Cijenik</a>
          <a href="http://Kontakt.html" class="footer_pages_1" aria-label="Contacts">Kontakt</a>
        </div>
      </div>
      <div id="footer_second_row">
        <div aria-label="Social Networks">
          <a href="http://instagram.com">
            <img src="..\assets\svg\instagram_icon.svg" alt="instagram_icon" class="social_network_icon" aria-label="Link to čvarci.net instagram">
          </a>
          <a href="http://twitter.com">
            <img src="..\assets\svg\twitter_icon.svg" alt="twitter_icon" class="social_network_icon" aria-label="Link to čvarci.net twitter">
          </a>
          <a href="http://facebook.com">
            <img src="..\assets\svg\facebook_icon.svg" alt="facebook_icon" class="social_network_icon" aria-label="Link to čvarci.net facebook" style="padding-right: 0px;">
          </a>
        </div>
        <div aria-label="Other links">
          <a href="http://polica.com" class="footer_pages_2" aria-label="security policy">Polica privatnosti</a>
          <a href="http://uvjeti_korištenja.com" class="footer_pages_2" aria-label="terms of use">Uvjeti
            korištenja</a>
          <a href="http://čvarci.net" class="footer_pages_2" aria-label="copyright 2021 čvarci.net" style="padding-right: 0px;">©2021 čvarci.net</a>
        </div>
      </div>
    </footer>
</body>
</html>
