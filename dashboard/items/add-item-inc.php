<?php
require_once '../../auth-functions.php';
checkLoginState();

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $price = $_POST["price"];
    $url = $_POST["url"];
    $quantity = $_POST["quantity"];

    require_once './add-item-functions.php';
    require_once '../../db.php';
    
    if (validateName($name) !== false) {
        header("location: add-item.php?error=name_not_valid");
        exit();
    }
    if (validatePrice($price) !== false) {
        header("location: add-item.php?error=price_not_valid");
        exit();
    }
    if (validateUrl($url) !== false) {
        header("location: add-item.php?error=url_not_valid");
        exit();
    }
    if (validateQuantity($quantity) !== false) {
        header("location: add-item.php?error=quantity_not_valid");
        exit();
    }



    addItem($conn, $name, $price, $url, $quantity);
    header("location: index.php");
    exit();
    
}
else{
    header("location: admin.php");
    exit();
}
