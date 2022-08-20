<?php
$to_email = 'cuongb253lvt@gmail.com';
$subject = 'Mã xác nhận đăng kí tài khoản';
$message = uniqid();
$headers = "From: cuongb2k53lvt@gmail.com";
if($check = mail($to_email,$subject,$message,$headers)){
    echo "ok".$check;
}else{
    echo "sorry".$check;
}

?>