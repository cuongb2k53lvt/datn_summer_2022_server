<?php
    require "dbconnect.php";
    $new_phone = $_POST['phone'];
    $user_id = $_POST['user_id'];
    $update_phone = "UPDATE user_fashionshop SET phone = '$new_phone' WHERE user_id = '$user_id'";
    $phone_query = mysqli_query($connect,$update_phone);
    if($phone_query){
        echo "ok";
    }else{
        echo "fail";
    }
?>