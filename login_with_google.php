<?php
    require "dbconnect.php";
    $email = $_POST['email'];
    $select_all_user = 'SELECT * FROM User_FashionShop';
    $data_user = mysqli_query($connect,$select_all_user);
    $check_mail_existed = 0;
    $cur_date_time = date('Y-m-d H:i:s');
    $rd_pw = uniqid();
    $user;
    class User{
        function User($id,$user_name,$password,$email,$full_name,$phone,$sex,$birthdate,$address,$total_spend,$avatar,$active_status,$account_type){
            $this->id = $id;
            $this->userName = $user_name;
            $this->password = $password;
            $this->email = $email;
            $this->fullName = $full_name;
            $this->phone = $phone;
            $this->sex = $sex;
            $this->birthdate = $birthdate;
            $this->address = $address;
            $this->totalSpend = $total_spend;
            $this->avatar = $avatar;
            $this->activeStatus = $active_status;
            $this->accountType = $account_type;
        }
    }
    if($data_user){
        while($row = mysqli_fetch_assoc($data_user)){
            if($row['email'] == $email){
                $check_mail_existed++;
                $user = new User($row['user_id'],$row['user_name'],$row['password'],$row['email'],$row['full_name'],$row['phone'],$row['sex'],
                $row['birthdate'],$row['address'],$row['total_spend'],$row['avatar'],$row['active_status'],$row['account_type']);
            }
        }
    }
    if($check_mail_existed>0){
        $update_cur_time = "UPDATE user_fashionshop SET last_login = '$cur_date_time' WHERE email = '$email'";
        mysqli_query($connect,$update_cur_time);
        echo json_encode($user);
    }else{
        $insert_user = "INSERT INTO User_FashionShop VALUES (null,'$email','$rd_pw','$email','$email','empty',
        'empty','1900-01-01','empty',0,'empty','$cur_date_time',0,'active','google')";
        mysqli_query($connect,$insert_user);
        while($row = mysqli_fetch_assoc($data_user)){
            if($row['email'] == $email){
                $user = new User($row['user_id'],$row['user_name'],$row['password'],$row['email'],$row['full_name'],$row['phone'],$row['sex'],
                $row['birthdate'],$row['address'],$row['total_spend'],$row['avatar'],$row['active_status'],$row['account_type']);
            }
        }
        echo json_encode($user);
    }
?>