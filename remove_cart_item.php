<?php
    require "dbconnect.php";
    $cart_id = $_POST['cart_id'];
    $remove_cart_item = "DELETE FROM cart_fashionshop WHERE cart_id = '$cart_id'";
    $data_remove_cart = mysqli_query($connect,$remove_cart_item);
    if($data_remove_cart){
        echo "ok";
    }else{
        echo "fail ".mysqli_connect_error($connect);
    }
?>