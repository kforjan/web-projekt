<?php
function validateName($name)
{
    $error = false;
    if (strlen($name) <= 0) $error = true;
    return $error;
}

function validatePrice($price)
{
    $error = false;
    if (!filter_var($price, FILTER_VALIDATE_FLOAT) || $price <= 0) $error = true;
    return $error;
}

function validateUrl($url)
{
    $error = false;
    if (!filter_var($url, FILTER_VALIDATE_URL)) $error = true;
    return $error;
}

function validateQuantity($quantity)
{
    $error = false;
    if (!filter_var($quantity, FILTER_VALIDATE_INT) || $quantity <= 0) $error = true;
    return $error;
}

function addItem($conn, $name, $price, $url, $quantity) {
    $sql = "INSERT INTO items (name, price, url, quantity) VALUES (?, ?, ?, ?);";

    $stmt =  mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){ 
      header("location: add-item.php?error=error=stmterror2");
      exit();
    }
    mysqli_stmt_bind_param($stmt,"ssss", $name, $price, $url, $quantity);
    mysqli_stmt_execute($stmt);
       
    mysqli_stmt_close($stmt);
    header("location: index.php");
    exit();
}