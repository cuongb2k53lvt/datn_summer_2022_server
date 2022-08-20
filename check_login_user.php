<?php
        require "dbconnect.php";
        $taikhoan = $_POST['taikhoan'];
        $matkhau = $_POST['matkhau'];
        $cur_date_time = date('Y-m-d H:i:s');
        $email = "";
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
        if(strlen($taikhoan)>0 && strlen($matkhau)>0){
            $query = "SELECT * FROM User_FashionShop WHERE user_name = '$taikhoan' && password = '$matkhau' && active_status = 'active'";
            $data = mysqli_query($connect,$query);
            if($data){
                while($row = mysqli_fetch_assoc($data)){
                    $email = $row['email'];
                    $user = new User($row['user_id'], $row['user_name'], $row['password'],
                    $row['email'],$row['full_name'],$row['phone'],$row['sex'],$row['birthdate']
                    ,$row['address'],$row['total_spend'], $row['avatar'],$row['last_login'],$row['login_attemp'],$row['active_status'],$row['account_type']);
                }
                if(gettype($user) == 'object'){
                    $update_cur_time = "UPDATE user_fashionshop SET last_login = '$cur_date_time' WHERE email = '$email'";
                    mysqli_query($connect,$update_cur_time);
                    echo json_encode($user);
                }else{
                    echo "Failed";
                }
            }
        }else{
            echo "Null";
        }
    ?>