<?php
    require "dbconnect.php";
    $user_id = $_POST['user_id'];
    $receiver_name = $_POST['receiver_name'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $contact = $_POST['contact'];
    $check = 0;
    $get_delivery_info = "SELECT COUNT(*) AS a FROM delivery_info_fashionshop WHERE user_id = '$user_id'";
    $data_delivery_info = mysqli_query($connect,$get_delivery_info);
    while($row = mysqli_fetch_assoc($data_delivery_info)){
        if($row['a'] > 0 ){
            $check = 0;
        }else{
            $check = 1;
        }
    }
    if($check == 1){
        $insert_new = "INSERT INTO delivery_info_fashionshop VALUES (null,'$user_id','$receiver_name','$street_address','$city','$contact')";
        $data_insert = mysqli_query($connect,$insert_new);
        if($data_insert){
            echo 'insert ok';
        }else{
            echo 'insert fail '.mysqli_connect_error($connect);
        }
    }else{
        $update_delivery = "UPDATE delivery_info_fashionshop SET receiver_name = '$receiver_name', street_address = '$street_address', city = '$city', contact = '$contact' WHERE user_id = '$user_id'";
        $data_update = mysqli_query($connect,$update_delivery);
        if($data_update){
            echo 'update ok';
        }else{
            echo 'update fail '.mysqli_connect_error($connect);
        }
    }
?>