<?php
    require "dbconnect.php";
    $user_name = $_POST['user_name'];
    $to_email = 'empty';
    $subject = 'Mã xác nhận yêu cầu đặt lại mật khẩu';
    $message = uniqid();
    $headers = "From: cuongb2k53lvt@gmail.com";
    $get_email = "SELECT email FROM user_fashionshop WHERE user_name = '$user_name'";
    $data_mail = mysqli_query($connect,$get_email);
    if($data_mail){
        while($row = mysqli_fetch_assoc($data_mail)){
            $to_email = $row['email'];
        }
    }
    if($to_email!='empty'){
        $update_confirm_code = "UPDATE confirm_code_fashionshop SET code = '$message' WHERE email = '$to_email'";
        $data_update_cc = mysqli_query($connect,$update_confirm_code);
        if($data_update_cc){
            mail($to_email,$subject,$message,$headers);
            echo 'ok';
        }
    }else{
        echo 'fail';
    }
    
?>