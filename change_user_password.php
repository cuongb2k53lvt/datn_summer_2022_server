<?php
    require "dbconnect.php";
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $user_id = $_POST['user_id'];
    $check = 0;
    $get_pw = "SELECT * FROM user_fashionshop WHERE user_id = '$user_id'";
    $data_pw = mysqli_query($connect,$get_pw);
    if($data_pw){
        while($row = mysqli_fetch_assoc($data_pw)){
            if($password == $row['password']){
                $check++;
            }
        }
    }
    if($check>0){
        $update_password = "UPDATE user_fashionshop SET password = '$new_password' WHERE user_id = '$user_id'";
        $pw_query = mysqli_query($connect,$update_password);
        if($pw_query){
            echo "ok";
        }
    }
    else{
        echo "fail";
    }
?>