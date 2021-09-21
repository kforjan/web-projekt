<?php
session_start();
unset($_SESSION['invalidQuantityItems']);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>čvarci.net</title>
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
  <script>
    let cartItems = [];

    let cartItemCounter = 0;
    let flag = 0;

    let items= [];
    function updateItems(data)
    {
      items=data;
    }

    $.ajax({
            type:'POST',
            url:'index-inc.php',
            dataType: "json",
            data:{retrieveItems: true},
            success:function(data){
                items = data;
            }
        });
    $(document).ready(function() {
      $("#cart-buy-btn").click(function() {
        $.post("cart/cart-inc.php", {
            cartItems: cartItems
          },
          function(data, status) {
            window.location = 'cart/index.php';
          });
      });
    });

    function addToCart(i, id, btnId) {
      const input = document.querySelector(`#${id}`);

      let newItem = {
        ...items[i]
      };
      if (input.value !== "") {
        newItem.quantity = parseInt(input.value);
      }else{
        newItem.quantity = 1;
      }
      cartItems.push(
        newItem
      );
      document.querySelector(`#${btnId}`).disabled = true;
      document.querySelector("#cart-items-count").innerHTML = cartItems.length;
      toggleCart();
    }

    function removeItemFromCart(item) {
      let i = cartItems.findIndex((el) => el.name == item.name);
      cartItems.splice(i, 1);
      i = items.findIndex((el) => el.name == item.name);

      document.querySelector("#cart-items-count").innerHTML = cartItems.length;
      document.querySelector(`div#product_list div:nth-child(${i+1}) button`).disabled = false;


      createCartItems();
    }

    function createCartItem(el) {
      let dropdown = document.querySelector("#dropdown");
      let cartList = document.querySelector("#cart-list");

      let item = document.createElement("div");
      let itemImage = document.createElement("img");
      let itemName = document.createElement("p");
      let nameBold = document.createElement("strong");
      let itemPrice = document.createElement("p");
      let priceBold = document.createElement("strong");
      let itemQuantity = document.createElement("p");
      let quantityBold = document.createElement("strong");
      let itemInfo = document.createElement("div");
      let itemDeleteButton = document.createElement("img");
      let itemNameInput = document.createElement("input");
      let itemQuantityInput = document.createElement("input");

      itemNameInput.setAttribute("name", "items[]");
      itemNameInput.setAttribute("value", el.name);
      itemNameInput.setAttribute("style", "display: none;");
      itemQuantityInput.setAttribute("name", "quantities[]");
      itemQuantityInput.setAttribute("value", el.quantity);
      itemQuantityInput.setAttribute("style", "display: none;");

      itemImage.setAttribute("src", el.url);

      itemDeleteButton.src = "assets/svg/button-delete.svg";
      itemDeleteButton.addEventListener("click", function() {
        removeItemFromCart(el);
      });





      let name = document.createTextNode(el.name);
      let price = document.createTextNode('Cijena: ');
      let priceBoldText = document.createTextNode(`${el.price * el.quantity} kn`);
      let quantity = document.createTextNode('Količina: ');
      let quantityBoldText = document.createTextNode(`${el.quantity}`);

      nameBold.appendChild(name);
      priceBold.appendChild(priceBoldText);
      quantityBold.appendChild(quantityBoldText);

      itemName.appendChild(nameBold);
      itemPrice.appendChild(price);
      itemPrice.appendChild(priceBold);
      itemQuantity.appendChild(quantity);
      itemQuantity.appendChild(quantityBold);



      itemName.classList.add("cart-item-name");
      itemPrice.classList.add("cart-item-price");
      itemQuantity.classList.add("cart-item-quantity");

      item.appendChild(itemImage);
      itemInfo.appendChild(itemName);
      itemInfo.appendChild(itemPrice);
      itemInfo.appendChild(itemQuantity);
      itemInfo.appendChild(itemNameInput);
      itemInfo.appendChild(itemQuantityInput);
      itemInfo.classList.add("cart-item-info");

      item.appendChild(itemInfo);
      item.appendChild(itemDeleteButton);

      item.classList.add("cart-item");
      cartList.appendChild(item);

    }

    function createCartItems() {
      let cartList = document.querySelector("#cart-list");
      cartList.innerHTML = '';
      if (cartItems.length > 3) {
        let itemIndex = cartItemCounter;
        for (let i = 0; i < 3; i++) {
          itemIndex++;
          if (itemIndex > cartItems.length - 1) itemIndex = 0;
          createCartItem(cartItems[itemIndex]);
        }
        createSlider();
      } else {
        removeSlider();
        cartItems.forEach(el => createCartItem(el));
      }
    }

    function removeSlider() {
      if (flag == 1) {
        let dropdown = document.querySelector("#dropdown");
        let sliderUp = document.querySelector("#dropdown p.slider-arrow");
        console.log("ovdje je up");
        console.log(sliderUp);
        let sliderDown = document.querySelector("#dropdown p.slider-arrow:last-of-type");
        console.log("ovdje je down");
        dropdown.removeChild(sliderUp);
        dropdown.removeChild(sliderDown);
        flag = 0;
      }
    }

    function createSlider() {
      if (flag == 0) {
        let dropdown = document.querySelector("#dropdown");
        let firstBr = document.querySelector("#dropdown br:first-of-type");
        let lastBr = document.querySelector("#dropdown br:last-of-type");


        let upSlider = document.createElement("p");
        upSlider.innerHTML = "&uarr;";
        let downSlider = document.createElement("p");
        downSlider.innerHTML = "&darr;";

        upSlider.classList.add("slider-arrow");
        downSlider.classList.add("slider-arrow");

        upSlider.addEventListener("click", function() {
          console.log(cartItemCounter);
          cartItemCounter++;
          if (cartItemCounter > 3) cartItemCounter = 0;
          createCartItems();
          console.log(cartItemCounter);
        });
        downSlider.addEventListener("click", function() {
          console.log(cartItemCounter);
          cartItemCounter--;
          if (cartItemCounter < 0) cartItemCounter = cartItems.length - 1;
          createCartItems();
          console.log(cartItemCounter);
        });

        insertAfter(upSlider, firstBr);
        dropdown.insertBefore(downSlider, lastBr);
        flag = 1;
      }
    }

    function insertAfter(newNode, referenceNode) {
      referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
    }

    function toggleCart() {
      let dropdown = document.querySelector("#dropdown");
      let cartList = document.querySelector("#cart-list");

      createCartItems();

      document.getElementById("dropdown").classList.toggle("show");

    }

    function openCartPage() {

    }

    function openLoginPage() {
      window.location = 'admin.php';
    }
  </script>

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
      <img src="assets\svg\logo.svg" alt="Čvaci.net logo" aria-label="Čvarci.net logo" class="img-fluid" />
  </figure>
  <br>
  <br>
  <br>
  <br>
  <a style="color:black; font-weight:700;">Početna</a>
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
      <img id="menu_button_ic" src="assets/svg/ic-menu-navigation.svg" alt="Menu Button" aria-label="Menu" class="img-fluid"/>
    </figure>

    <figure >
      <img src="assets\svg\logo.svg" alt="Čvaci.net logo" aria-label="Čvarci.net logo" class="img-fluid" />
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
    <main>
      <section id="landing_content" aria-label="Landing content">
        <div id="banner_content">
          <h1 id="prime" aria-label="The best cvarci on your front door">
            Najbolji čvarci na kućnom pragu
          </h1>
          <button id="button_order" aria-label="Order button" type="button">
            <strong aria-label="Delivery">DOSTAVA</strong>
            <span aria-label="Order"> Naruči </span>
          </button>
          <button aria-label="Download button" id="button_download" type="button">
            <strong aria-label="Download">PREUZMI</strong>
            <span aria-label="On Cvarkomat"> Na čvarkomatu </span>
          </button>
        </div>
        <figure id="banner_photo">
          <img aria-label="Photo of cvarci" src="./assets/svg/banner_photo.svg" alt="Cvarci" class="img-fluid" />
        </figure>
      </section>

      <article id="delivery" aria-label="Delivery information">
        <div id="delivery_time" aria-label="Delivery time information">
          <div id="delivery_time_ic">
            <img src="./assets/svg/time_eat.svg" alt="Clock icon" aria-label="Delivery time clock emoticon">
          </div>
          <div id="delivery_time_text" aria-label="We deliver cvarci in less than 30 minutes">
            dostavljamo čvarke za manje od 30 minuta
          </div>
        </div>
        <div id="delivery_driver" aria-label="Delivery driver information">
          <div id="delivery_driver_ic">
            <img src="./assets/svg/delivery.svg" alt="Delivery man icon" aria-label="Delivery man emoticon">
          </div>
          <div id="delivery_driver_text" aria-label="Our drivers ride tomos bikes">
            naši šoferi voze tomose
          </div>
        </div>
        <div id="delivery_france" aria-label="Meat origin information">
          <div id="delivery_france_ic">
            <img src="./assets/svg/paris.svg" alt="Paris icon" aria-label="Paris emoticon">
          </div>
          <div id="delivery_france_text" aria-label="We buy the best pigs from France">
            nabavljamo najbolje prasce iz francuske
          </div>
        </div>
        </div>
      </article>

      <article id="products">
        <h2 id="products_title">Novo u ponudi ! naručite čvarke online</h2>
        <div id="product_list">
        <?php
        require_once "./db.php";
           $items = [];

           $sql = "SELECT * FROM items";
           $stmt =  mysqli_stmt_init($conn);
           if(!mysqli_stmt_prepare($stmt, $sql)){ 
             header("location: add-item.php?error=error=stmterror2");
             exit();
           }
           mysqli_stmt_execute($stmt);
           $res =  mysqli_stmt_get_result($stmt);
           if (mysqli_num_rows($res) > 0) {
               while ($row = mysqli_fetch_assoc($res)) {
                   array_push($items, $row);
               }
           } else {
               header("location: index.php?error=noSuchItemsFound");
               exit();
           }
           mysqli_stmt_close($stmt);

           $counter = 0;
           foreach($items as $item) {
            echo <<<text
            <div class="product_item">
             <img src="{$item['url']}" width="280" height="280" alt="Cvarci product Homemade" aria-label="Cvarci Homemade">
             <div class="product_name" aria-label="Cvarci homemade">{$item['name']}</div>
             <div class="product_price" aria-label="Price 50 kuna">{$item['price']}</div>
             <div class="product_measuring_unit"> / kg</div> <br>
             <div class="product_quantity" aria-label="Quantity of product">Količina:</div>
             <input id="p{$item['id']}-input" class="quantity_input" type="number" name="quantity_input" placeholder="1"> <br>
             <button id="p{$item['id']}-input-button" class="product_button" onclick="addToCart({$counter}, 'p{$item['id']}-input', 'p{$item['id']}-input-button')">Stavi u košaricu</button>
             </div>
            text;
            $counter++;
          }
        ?>
        </div>
      </article>

      <article id="restaurants" aria-label="Restaurants information">
        <div id="restaurants_title">
          <h2 aria-label="You can find our cvarke at">Naše čvarke možete pronaći</h2>
          <button type="button" aria-label="Show all">prikaži sve</button>
        </div>
        <div id="cards_preview" aria-label="Restaurants preview">
          <div class="card_preview" aria-label="Burger d'Lice preview">
            <figure class="food">
              <img src="./assets/images/burger.png" alt="Burger d'Lice" aria-label="Burger d'Lice burger image" />
            </figure>
            <figure>
              <img src="./assets/svg/burger.svg" alt="Burger d'Lice Logo" aria-label="Burger d'Lice logo" />
            </figure>
          </div>
          <div class="card_preview" aria-label="il Pastficio preview">
            <figure class="food">
              <img src="./assets/images/pastificio.png" alt="il Pastficio" aria-label="il Pastficio pasta image" />
            </figure>
            <figure>
              <img src="./assets/svg/pastificio.svg" alt="il Pastficio Logo" aria-label="il Pastficio logo" />
            </figure>
          </div>
          <div class="card_preview" aria-label="Believe preview">
            <figure class="food">
              <img src="./assets/images/believe.png" alt="Believe" aria-label="Believe salad image" />
            </figure>
            <figure>
              <img src="./assets/svg/believe.svg" alt="Believe Logo" aria-label="Believe logo" />
            </figure>
          </div>
          <div class="card_preview" aria-label="Vietnamese Bo preview">
            <figure class="food">
              <img src="./assets/images/vietnamese.png" alt="Bo Vietnamese" aria-label="Bo dish image" />
            </figure>
            <figure>
              <img src="./assets/svg/vietnamese.svg" alt="Bo Vietnamese Logo" aria-label="Bo logo" />
            </figure>
          </div>
        </div>
        <span id="left_arrow" role="button" aria-label="List through restaurants preview to the left">
          <img src="./assets/svg/left_arrow.svg" aria-label="Left arrow" alt="Left arrow" />
        </span>
        <span id="right_arrow" role="button" aria-label="List through restaurants preview to the right">
          <img src="./assets/svg/right_arrow.svg" aria-label="Right arrow" alt="Right arrow" />
        </span>
      </article>
      <section id="branding_partner">
        <div id="branding_partner_content">
          <h2 aria-label="Do you want to be our branding partner?">Želite biti naš brand partner ?</h2>
          <p aria-label="Send us your number and we will contact you in the shortest possible time">
            Pošaljite nam Vaš broj i kontaktirat ćemo Vas u najkraćem moguću
            roku
          </p>
        </div>
        <form id="branding_partner_form" action="/branding_partner_action.php" method="POST">
          <input id="branding_partner_input" type="text" name="email" placeholder="Pošaljite Vašu email adresu" aria-label="Input for email adress">
          <button type="submit" aria-label="Send">pošalji</button>
        </form>
      </section>
      <div id="locationMap">
        <h2 id="h2_map" aria-label="Where can you find our čvarkomats?">Gdje se nalaze naši <br>
          čvarkomati ?</h2>
        <img id="map" src="assets\svg\map.svg" alt="Čvarkomat Locations in the city" aria-label="Map with locations of čvarkomats">
      </div>
      <div id="feature_block">
        <img src="assets\svg\feature_block_klaonice.svg" alt="" class="feature_block_item" aria-label="Number of Butcher houses: 1">
        <img src="assets\svg\feature_block_vrsta_cvaraka.svg" alt="" class="feature_block_item" aria-label="Number of types of čvarci: 6">
        <img src="assets\svg\feature_block_restorani.svg" alt="" class="feature_block_item" aria-label="Number of restaurants: 11">
        <img src="assets\svg\feature_block_najbolja_cijena.svg" alt="" class="feature_block_item" aria-label="Number of best prices: 1">
      </div>
      <div id="instagram_block">
        <div id="first_igBlock">
          <h2 id="h2_igBloc">#čvarcinet</h2>
          <h3 id="h3_igBloc">na instagramu</b>
        </div>
        <div id="second_igBlock">
          <img src="assets\svg\instagram_picture_1.svg" alt="instagram_picture" aria-label="Kitchen pots" class='instagram_picture'>
          <img src="assets\svg\instagram_picture_2.svg" alt="instagram_picture" aria-label="Two people cooking together" class='instagram_picture'>
          <img src="assets\svg\instagram_picture_3.svg" alt="instagram_picture" aria-label="Guy making sandwiches" class='instagram_picture'>
          <img src="assets\svg\instagram_picture_4.svg" alt="instagram_picture" aria-label="Boy fixing his motorbike" class='instagram_picture'>
        </div>
      </div>
    </main>

    <footer>
      <div id="footer_first_row">
        <div aria-label="footer_logo">
          <img src="assets\svg\logo.svg" alt="Čvaci.net logo" aria-label="Čvarci.net logo" class='logo'>
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
            <img src="assets\svg\instagram_icon.svg" alt="instagram_icon" class="social_network_icon" aria-label="Link to čvarci.net instagram">
          </a>
          <a href="http://twitter.com">
            <img src="assets\svg\twitter_icon.svg" alt="twitter_icon" class="social_network_icon" aria-label="Link to čvarci.net twitter">
          </a>
          <a href="http://facebook.com">
            <img src="assets\svg\facebook_icon.svg" alt="facebook_icon" class="social_network_icon" aria-label="Link to čvarci.net facebook" style="padding-right: 0px;">
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