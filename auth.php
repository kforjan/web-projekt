<?php

if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $pass = $_POST["password"];


    require_once 'auth-functions.php';
    require_once 'db.php';
    
    if (validateEmail($email) !== false) {
        header("location: admin.php?error=email_not_valid");
        exit();
    }
    if (validatePassword($pass) !== false) {
        header("location: admin.php?error=password_not_valid");
        exit();
    }
    if (authenticateAdmin($conn, $email, $pass) !== false) {
        header("location: admin.php?error=email_or_password_are_incorrect");
        exit();
    }

    setcookie('admin', 'true', time() + 3600,'/');
    header("location: dashboard/items/index.php");
    exit();
    
}
else{
    header("location: admin.php");
    exit();
}
