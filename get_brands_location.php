<?php
    require "dbconnect.php";
    $select_brand = "SELECT location FROM brand_fashionshop GROUP BY location";
    $location_data = mysqli_query($connect,$select_brand);
    $location_arr = array();
    if($location_data){
        while($row = mysqli_fetch_assoc($location_data)){
            array_push($location_arr,$row['location']);
        }
    }
    echo json_encode($location_arr);
?>