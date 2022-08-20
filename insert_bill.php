<?php
    require "dbconnect.php";
    $user_id = $_POST['user_id'];
    $receiver_name = $_POST['receiver_name'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $contact = $_POST['contact'];
    $amount = $_POST['amount'];
    $cur_date = date("Y-m-d");
    $insert_bill = "INSERT INTO bill_fashionshop VALUES(null,'$user_id','$cur_date','1900-01-01','$receiver_name','$street_address','$city','$contact','Chờ duyệt','$amount','empty')";
    $data_insert_bill = mysqli_query($connect, $insert_bill);
    if($data_insert_bill){
        $cur_bill_id = '';
        $get_cur_bill = "SELECT * FROM bill_fashionshop WHERE user_id = '$user_id' ORDER BY bill_id DESC LIMIT 1";
        $data_cur_bill = mysqli_query($connect,$get_cur_bill);
        if($data_cur_bill){
            while($row = mysqli_fetch_assoc($data_cur_bill)){
                $cur_bill_id = $row['bill_id'];
            }
        }
        echo $cur_bill_id;
    }
?>