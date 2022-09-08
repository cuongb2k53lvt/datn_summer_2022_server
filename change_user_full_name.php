<?php
    require "dbconnect.php";
    $new_full_name = $_POST['full_name'];
    $user_id = $_POST['user_id'];
    $update_fullname = "UPDATE user_fashionshop SET full_name = '$new_full_name' WHERE user_id = '$user_id'";
    $fullname_query = mysqli_query($connect,$update_fullname);
    $user = 1;
    class User{
        function User($id,$user_name,$password,$email,$full_name,$phone,$sex,$birthdate,$address,$total_spend,$avatar,$last_login,$login_attemp,$active_status,$account_type){
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
            $this->lastLogin = $last_login;
            $this->loginAttemp = $login_attemp;
            $this->activeStatus = $active_status;
            $this->accountType = $account_type;
        }
    }
    if($fullname_query){
        $query = "SELECT * FROM User_FashionShop WHERE user_id = '$user_id'";
        $data = mysqli_query($connect,$query);
        if($data){
            while($row = mysqli_fetch_assoc($data)){
                $user = new User($row['user_id'], $row['user_name'], $row['password'],
                $row['email'],$row['full_name'],$row['phone'],$row['sex'],$row['birthdate']
                ,$row['address'],$row['total_spend'], $row['avatar'],$row['last_login'],$row['login_attemp'],$row['active_status'],$row['account_type']);
            }
        }
        echo json_encode($user);    
    }else{
        echo "fail";
    }
?>