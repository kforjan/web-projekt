<?php

function validateEmail($email)
{
    $error = false;
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {     //vraca TRUE ako prvi parametar zadovoljava email adresu
        $error = true;
    }
    return $error;
}

function validatePassword($pass)
{
    return strlen($pass) <= 0;
}

function authenticateAdmin($conn, $email, $pass)
{
    $error = false;
    $sql = "SELECT * FROM admins WHERE email = ?;";
    $stmt =  mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: admin.php?error=stmterror");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($res)) {
        if (md5($pass) !== $row["password"]) $error = true;
    } else {
        $error = true;
    }

    return $error;


    mysqli_stmt_close($stmt);
}

function checkLoginState() {
    if(!isset($_COOKIE['admin'])) {
        header("location: http://".$_SERVER['HTTP_HOST']."/admin.php");
    }
}