<?php
require_once '../db.php';
session_start();

$telephone = $firstname = $lastname = $adress = "";

if (isset($_POST['submit'])) {
    $cartItems = $_SESSION['cartItems'];
    $firstname = test_input($_POST["firstname"]);
    $lastname = test_input($_POST["lastname"]);
    $adress = test_input($_POST["adress"]);
    $telephone = test_input($_POST["telephone"]);


    $invalidQuantityItems = retrieveInvalidQuantityItems($conn, $cartItems);
    if (count($invalidQuantityItems) == 0) {
        $_SESSION["invalidQuantityItems"] = [];
        updateDB($conn, $cartItems);
        addOrder($conn, $cartItems, $firstname, $lastname, $adress, $telephone);
        header("location:success.php");
        exit();
    } else {
        $_SESSION["invalidQuantityItems"] = $invalidQuantityItems;
        header("location: index.php");
        exit();
    }
} else {
    header("location: index.php");
    exit();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function retrieveInvalidQuantityItems($conn, $cartItems)
{
    $invalidQuantityItems = [];
    $res = retrieveCartItemsFromDatabase($conn, $cartItems);

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            foreach ($cartItems as $item) {
                if ($row['name'] == $item["name"]) {
                    if ($row['quantity'] < $item["quantity"]) {
                        array_push($invalidQuantityItems, $item['name']);
                    }
                }
            }
        }
    } else {
        header("location: index.php?error=noSuchItemsFound");
        exit();
    }

    return $invalidQuantityItems;
}

function retrieveCartItemsFromDatabase($conn, $cartItems)
{
    $whereStatement = "";
    foreach ($cartItems as $item) {
        $whereStatement .= "name='" . $item["name"] . "' OR ";
    }

    $whereStatement = substr($whereStatement, 0, -3);

    $sql = "SELECT * FROM items WHERE " . $whereStatement . ";";
    $stmt =  mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: index.php?error={$whereStatement}");
        exit();
    }
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function updateDB($conn, $cartItems)
{
    foreach ($cartItems as $item) {
        $sql = "UPDATE items SET quantity = quantity - ? WHERE name = ?;";

        $stmt =  mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: add-item.php?error=error=stmterror2");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "is", $item['quantity'], $item['name']);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }
}

function addOrder($conn, $cartItems, $firstname, $lastname, $adress, $telephone)
{
    $order = "";
    foreach ($cartItems as $item) {
        $order .= $item['name'] . ' - x' . $item['quantity'] . ' ';
        $sql = "INSERT INTO orders (firstname, lastname, adress, telephone, orderText) VALUES (?, ?, ?, ?, ?);";

        $stmt =  mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: add-item.php?error=error=stmterror2");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $adress, $telephone, $order);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }
}
