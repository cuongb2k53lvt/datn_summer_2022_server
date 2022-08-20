<?php
    require "dbconnect.php";
    $new_full_name = $_POST['full_name'];
    $user_id = $_POST['user_id'];
    $update_fullname = "UPDATE user_fashionshop SET full_name = '$new_full_name' WHERE user_id = '$user_id'";
    $fullname_query = mysqli_query($connect,$update_fullname);
    if($fullname_query){
        echo "ok";
    }else{
        echo "fail";
    }
?>