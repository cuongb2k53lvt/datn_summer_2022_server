<?php
    require "dbconnect.php";
    $size_id = $_POST['size_id'];
    $bill_id = $_POST['bill_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $cart_id = $_POST['cart_id'];
    $discount_rate = $_POST['discount_rate'];
    $insert_bill_detail = "INSERT INTO detail_bill_fashionshop VALUES(null,'$size_id','$bill_id','$product_id','$quantity','$discount_rate')";
    $data_insert_detail = mysqli_query($connect,$insert_bill_detail);
    if($data_insert_detail){
        $delete_cart_item = "DELETE FROM cart_fashionshop WHERE cart_id = '$cart_id'";
        mysqli_query($connect,$delete_cart_item);
    }
?>