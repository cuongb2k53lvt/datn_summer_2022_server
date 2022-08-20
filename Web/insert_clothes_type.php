<?php
    require "../dbconnect.php";
    $clothes_type = $_POST['inputAddType'];
    $query = "INSERT INTO Clothes_Type_FashionShop VALUES (null, '$clothes_type')";
    if(mysqli_query($connect,$query)){
        echo '<script type="text/JavaScript"> 
        alert("Thêm loại thành công");
        window.open("http://localhost/FashionShop-phpServer/Web/product_info_page.php","_self");
      </script>';
    } else{
        echo '<script type="text/JavaScript"> 
        alert("Thêm loại lỗi"'.mysqli_error($connect).');
        window.open("http://localhost/FashionShop-phpServer/Web/product_info_page.php","_self");
      </script>';
    }
    
?>