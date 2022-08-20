<?php
    require "dbconnect.php";
    $select_type = "SELECT DISTINCT type FROM clothes_type_fashionshop INNER JOIN products_fashionshop ON clothes_type_fashionshop.type_id = products_fashionshop.type_id";
    $data = mysqli_query($connect,$select_type);
    $arr_type = array();
    if($data){
        while($row = mysqli_fetch_assoc($data)){
            array_push($arr_type,$row['type']);
        }
    }
    echo json_encode($arr_type);
?>