<?php
    require "../dbconnect.php";
    $uname = $_POST['uname'];
    $psw = $_POST['psw'];
    $re_psw = $_POST['psw-repeat'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $check = 0;
    if($psw != $re_psw){
        echo '<script type="text/JavaScript"> 
        alert("Mật khẩu không trùng khớp"'.$psw.$re_psw.');
        window.open("http://datn4.000webhostapp.com/Web/Signup_employee.php","_self");
        </script>';
    }
    $get_employee = "SELECT * FROM employee";
    $data_employee = mysqli_query($connect,$get_employee);
    if($data_employee){
        while($row = mysqli_fetch_assoc($data_employee)){
            if($row['employee_account'] == $uname){
                $check++;
            }
        }
    }
    if($check>0){
        echo '<script type="text/JavaScript"> 
        alert("Tài khoản đã tồn tại");
        window.open("http://datn4.000webhostapp.com/Web/Signup_employee.php","_self");
      </script>';
    }else{
        $insert_employee = "INSERT INTO employee VALUES(null,'$name','$uname','$psw','$contact','$address','$email')";
        mysqli_query($connect,$insert_employee);
        echo '<script type="text/JavaScript"> 
        alert("Đăng kí thành công");
        window.open("http://datn4.000webhostapp.com/Web/Signup_employee.php","_self");
      </script>';
    }
?>