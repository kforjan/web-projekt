<?php
require_once '../../db.php';
require_once './update-item-functions.php';

if(isset($_POST["update"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $url = $_POST["url"];
    $quantity = $_POST["quantity"];

    updateItem($conn, $id, $name, $price, $url, $quantity);

} elseif (isset($_POST['delete'])) {
    $id = $_POST["id"];
    deleteItem($conn, $id);
} else {
    header("location: index.php?error=somethingwentwrong");
    exit();
}
