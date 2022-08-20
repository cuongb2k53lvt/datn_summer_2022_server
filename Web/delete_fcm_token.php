<?php
    require "../dbconnect.php";
    $user_id = $_POST['user_id'];
    $token = $_POST['token'];
    $delete_fcm_token = "DELETE FROM fcm_token_fashionshop WHERE user_id = '$user_id' AND token = '$token'";
    $data_delete = mysqli_query($connect,$delete_fcm_token);
    if($data_delete){
        echo "ok";
    }else{
        echo "fail";
    }
?>