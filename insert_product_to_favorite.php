<?php
    require "dbconnect.php";
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $insert_favorite = "INSERT INTO follow_product_fashionshop VALUES(null,'$user_id','$product_id')";
    $get_favorite = "SELECT * FROM follow_product_fashionshop WHERE user_id = '$user_id'";
    $get_favorite_data = mysqli_query($connect,$get_favorite);
    $check = 0;
    while($row = mysqli_fetch_assoc($get_favorite_data)){
        if($product_id == $row['product_id']){
            $check++;
        }
    }
    if($check>0){
        echo "false";
    }else{
        mysqli_query($connect,$insert_favorite);
        echo "true";
    }
?>