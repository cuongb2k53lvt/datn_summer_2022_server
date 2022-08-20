<?php
    require "dbconnect.php";
    $to_email = $_POST['email'];
    $subject = 'Mã xác nhận đăng kí tài khoản';
    $message = uniqid();
    $headers = "From: cuongb2k53lvt@gmail.com";
    //check email đã được đăng kí
    $select_email_user = "SELECT email FROM user_fashionshop";
    $email_user = mysqli_query($connect,$select_email_user);
    $email_user_check = 0;
    while($row = mysqli_fetch_assoc($email_user)){
        if($row['email'] == $to_email){
            $email_user_check++;
        }
    }
    if($email_user_check==0){
        //check email đã được gửi xác nhận
        $select_email_confirm = "SELECT email FROM confirm_code_fashionshop";
        $email_confirm = mysqli_query($connect,$select_email_confirm);
        $email_confirm_check = 0;
        while($row = mysqli_fetch_assoc($email_confirm)){
            if($row['email'] == $to_email){
                $email_confirm_check++;
            }
        }
        if($email_confirm_check == 0){
            $insert_confirm_code = "INSERT INTO confirm_code_fashionshop VALUES(null,'$to_email','$message')";
            mysqli_query($connect,$insert_confirm_code);
            mail($to_email,$subject,$message,$headers);
            echo 'new';
        }else{
            $update_confirm_code = "UPDATE confirm_code_fashionshop SET code = '$message' WHERE email = '$to_email'";
            mysqli_query($connect,$update_confirm_code);
            mail($to_email,$subject,$message,$headers);
            echo 'existed';
        }
    }else{
        echo 'in use';
    }

?>