<?php
    require "dbconnect.php";
    $user_id = $_POST['user_id'];
    $size_id = $_POST['size_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $get_cart = "SELECT size_id FROM cart_fashionshop WHERE user_id = '$user_id'";
    $insert_cart = "INSERT INTO cart_fashionshop VALUES (null,'$user_id','$product_id','$size_id','$quantity')";
    $get_data = mysqli_query($connect,$get_cart);
    $check = 0;
    while($row = mysqli_fetch_assoc($get_data)){
        if($size_id == $row['size_id']){
            $check++;
        }
    }
    if($check>0){
        echo "duplicated";
    }else{
        $data_insert = mysqli_query($connect,$insert_cart);
        if($data_insert){
            echo "ok";
        }else{
            echo "false".mysqli_error($connect);
        }
    }
?>