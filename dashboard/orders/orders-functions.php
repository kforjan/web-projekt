<?php
require_once '../../db.php';

    function retrieveAllOrders($conn) {
        $orders = [];

        $sql = "SELECT * FROM orders";
        $stmt =  mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){ 
          header("location: add-item.php?error=error=stmterror2");
          exit();
        }
        mysqli_stmt_execute($stmt);
        $res =  mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($orders, $row);
            }
        } else {
            header("location: index.php?error=noSuchItemsFound");
            exit();
        }
        mysqli_stmt_close($stmt);
        return $orders;
    }