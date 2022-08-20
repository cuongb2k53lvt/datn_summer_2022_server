<?php
    require '../dbconnect.php';
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];
    $product_id = $_POST['product_id'];
    $update_quantity = "UPDATE product_size_fashionshop SET total_product = total_product + $quantity, remain_product = remain_product + $quantity WHERE 
    size = '$size' AND product_id = '$product_id'";
    mysqli_query($connect, $update_quantity);
    echo '<script type="text/JavaScript"> 
                alert("Cập nhật thành công");
                history.back()
                </script>';
?>