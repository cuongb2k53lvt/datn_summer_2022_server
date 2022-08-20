<?php
    require "dbconnect.php";
    $bill_id = $_POST['bill_id'];
    $update_cancel_status = "UPDATE bill_fashionshop SET bill_status = 'Chờ hủy' WHERE bill_id = '$bill_id'";
    $data_update = mysqli_query($connect,$update_cancel_status);
    if($data_update){
        echo 'ok';
    }
?>