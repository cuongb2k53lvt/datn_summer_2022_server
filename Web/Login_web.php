<?php
    require "../dbconnect.php";
    $uname = $_GET['uname'];
    $password = $_GET['password'];
    $get_user = "SELECT * FROM employee WHERE employee_account = '$uname' AND employee_password = '$password'";
    $user_data = mysqli_query($connect,$get_user);
    $check = 0;
    if($user_data){
        while($row = mysqli_fetch_assoc($user_data)){
            $check++;
        }
    }
    if($check++){
        session_start();
        $_SESSION['user_name'] = $uname;
        $_SESSION['password'] = $password;
        echo '<script type="text/JavaScript"> 
        window.open("http://localhost/FashionShop-phpServer/Web/main_page.php","_self");
      </script>';
    }else{
        echo '<script type="text/JavaScript"> 
        alert("Thông tin đăng nhập không chính xác");
        window.open("http://localhost/FashionShop-phpServer/Web/Login_web.html","_self");
      </script>';
    }
?>