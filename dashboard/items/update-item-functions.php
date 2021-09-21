<?php
function updateItem($conn, $id, $name, $price, $url, $quantity) {
    $sql = "UPDATE items SET name = ?, price = ?, url = ?, quantity = ? WHERE id = ?;";

    $stmt =  mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){ 
      header("location: add-item.php?error=error=stmterror2");
      exit();
    }
    mysqli_stmt_bind_param($stmt,"sdsds" ,$name, $price, $url, $quantity, $id);
    mysqli_stmt_execute($stmt);
       
    mysqli_stmt_close($stmt);
    header("location: index.php");
    exit();
}

function deleteItem($conn, $id) {
    $sql = "DELETE FROM items WHERE id = ?;";

    $stmt =  mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){ 
      header("location: add-item.php?error=error=stmterror2");
      exit();
    }
    mysqli_stmt_bind_param($stmt,"s", $id);
    mysqli_stmt_execute($stmt);
       
    mysqli_stmt_close($stmt);
    header("location: index.php");
    exit();
}