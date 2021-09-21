<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/loginPage.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
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
  <header>
      <figure id="menu_button" role="menu" style="opacity:0">
        <img id="menu_button_ic" src="assets/svg/ic-menu-navigation.svg" alt="Menu Button" aria-label="Menu" class="img-fluid" />
      </figure>
      <figure>
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Emoji_u1f36d.svg/2048px-Emoji_u1f36d.svg.png" width="100" height="100" alt="CandyShop logo" aria-label="CandyShop logo" />
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
  <div id='login_form'>
      <form action="auth.php" method="post">
      <h3 id="login_title">Login form</h3>

        <label for="email">Email: </label>
        <br>
        <br>
        <input class="login_input" type="text" name="email" required>
        <br>
        <br>
        <label for="password">Password: </label>
        <br>
        <br>
        <input class="login_input" type="password"  name="password" height="150" required>
        <br>
          <button type="submit" name="submit" id="button_submit">Login</button>
      </form>
  </div>
    <footer>
      <div id="footer_first_row">
        <div aria-label="footer_logo">
        <figure>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Emoji_u1f36d.svg/2048px-Emoji_u1f36d.svg.png" width="50" height="50" alt="CandyShop logo" aria-label="CandyShop logo" />
        </figure>
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
            <img src="assets\svg\instagram_icon.svg" alt="instagram_icon" class="social_network_icon" aria-label="Link to candyshop.hr instagram">
          </a>
          <a href="http://twitter.com">
            <img src="assets\svg\twitter_icon.svg" alt="twitter_icon" class="social_network_icon" aria-label="Link to candyshop.hr twitter">
          </a>
          <a href="http://facebook.com">
            <img src="assets\svg\facebook_icon.svg" alt="facebook_icon" class="social_network_icon" aria-label="Link to candyshop.hr facebook" style="padding-right: 0px;">
          </a>
        </div>
        <div aria-label="Other links">
          <a href="http://polica.com" class="footer_pages_2" aria-label="security policy">Polica privatnosti</a>
          <a href="http://uvjeti_korištenja.com" class="footer_pages_2" aria-label="terms of use">Uvjeti
            korištenja</a>
          <a href="http://candyshop.hr" class="footer_pages_2" aria-label="copyright 2021 candyshop.hr" style="padding-right: 0px;">©2021 candyshop.hr</a>
        </div>
      </div>
    </footer>
    </div>
</body>
</html>