<?php
    require "dbconnect.php";
    $size_id = $_POST['size_id'];
    $quantity = $_POST['quantity'];
    $get_quantity = "SELECT remain_product FROM product_size_fashionshop WHERE product_size_id = '$size_id'";
    $data = mysqli_query($connect,$get_quantity);
    $quantity_left = '';
    if(!$data){
        echo "".mysqli_connect_error($connect);
    }
    while($row = mysqli_fetch_assoc($data)){
        $quantity_left = $row['remain_product'];
    }
    if($quantity_left > $quantity){
        echo "ok";
    }else{
        echo "fail";
    }
?>