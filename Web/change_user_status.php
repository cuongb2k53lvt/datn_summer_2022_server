<?php
    require "../dbconnect.php";
    $user_name = $_POST['user_name'];
    $active_status = $_POST['status'];
    $update_status = "UPDATE user_fashionshop SET active_status = 'active' WHERE user_name = '$user_name'";
    if($active_status == "active"){
        $update_status = "UPDATE user_fashionshop SET active_status = 'deactive' WHERE user_name = '$user_name'";
    }
    mysqli_query($connect,$update_status);
    echo '<script type="text/JavaScript"> 
        window.open("http://localhost/FashionShop-phpServer/Web/list_user.php","_self");
        </script>';
?>