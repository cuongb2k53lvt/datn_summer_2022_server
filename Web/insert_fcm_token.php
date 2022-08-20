<?php
    require "../dbconnect.php";
    $user_id = $_POST['user_id'];
    $token = $_POST['token'];
    $insert_fcm_token = "INSERT INTO fcm_token_fashionshop VALUES(null,'$user_id','$token')";
    $data_insert = mysqli_query($connect,$insert_fcm_token);
    if($data_insert){
        echo "ok";
    }else{
        echo "fail";
    }
?>