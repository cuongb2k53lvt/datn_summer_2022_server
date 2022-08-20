<?php
    require "dbconnect.php";
    $email = $_POST['email'];
    $code = $_POST['code'];
    $select_confirm_code = "SELECT * FROM confirm_code_fashionshop";
    $confirm_code_data = mysqli_query($connect,$select_confirm_code);
    $check = 0;
    while($row = mysqli_fetch_assoc($confirm_code_data)){
        if($row['email']==$email && $row['code']==$code){
            $check++;
        }
    }
    if($check>0){
        echo "true";
    }else{
        echo "false";
    }
?>