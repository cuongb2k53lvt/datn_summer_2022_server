<?php
    require "dbconnect.php";
    $confirm_code = $_POST['confirm_code'];
    $new_pw = $_POST['new_pw'];
    $user_name = $_POST['user_name'];
    $get_confirm_code = "SELECT * FROM confirm_code_fashionshop INNER JOIN user_fashionshop ON 
    confirm_code_fashionshop.email = user_fashionshop.email WHERE user_fashionshop.user_name = '$user_name'";
    $data_confirm_code = mysqli_query($connect,$get_confirm_code);
    $check_confirm_code = 0;
    if($data_confirm_code){
        while($row = mysqli_fetch_assoc($data_confirm_code)){
            if($row['code'] == $confirm_code){
                $check_confirm_code++;
            }
        }
    }
    if($check_confirm_code>0){
        $update_pw = "UPDATE user_fashionshop SET password = '$new_pw' WHERE user_name = '$user_name'";
        mysqli_query($connect,$update_pw);
        echo 'ok';
    }else{
        echo 'fail';
    }
?>