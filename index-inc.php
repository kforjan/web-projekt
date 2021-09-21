<?php
require_once "./db.php";

if (isset($_POST["retrieveItems"])) {
    echo json_encode(retrieveAllItems($conn));
}

function retrieveAllItems($conn) {
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
    return $items;
}