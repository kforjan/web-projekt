<?php
session_start();

if (isset($_POST["cartItems"])) {
    $_SESSION['cartItems'] = $_POST["cartItems"];
    exit();
} else {
    header("location: index.php");
    exit();
}
