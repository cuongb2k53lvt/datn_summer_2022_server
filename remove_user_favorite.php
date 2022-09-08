<?php
    require "dbconnect.php";
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $delete_favorite = "DELETE FROM follow_product_fashionshop WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $delete_data = mysqli_query($connect,$delete_favorite);
    if($delete_data){
        echo 'ok';
    }
?>