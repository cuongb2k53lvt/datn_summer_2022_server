<?php
    require "../dbconnect.php";
    $clothes_type = $_POST['inputAddType'];
    $query = "INSERT INTO Clothes_Type_FashionShop VALUES (null, '$clothes_type')";
    $query_data = mysqli_query($connect,$query);
    if($query_data){
        echo '<script type="text/JavaScript"> 
        alert("Thêm loại thành công");
        history.back();
      </script>';
    } else{
        echo '<script type="text/JavaScript"> 
        alert("Thêm loại lỗi"'.mysqli_error($connect).');
        history.back();
      </script>';
    }
    if(mysqli_errno($connect) == 1062){
      echo '<script type="text/JavaScript"> 
        alert("Trùng tên loại quần áo");
        history.back();
      </script>';
    }
?>