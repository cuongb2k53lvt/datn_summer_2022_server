<?php
require "dbconnect.php";
$select_brand = "SELECT * FROM brand_fashionshop";
$brand_data = mysqli_query($connect,$select_brand);
$brand_arr = array();
class Brand{
    function Brand($brand_id, $name, $logo, $location, $description){
        $this->brand_id = $brand_id;
        $this->name = $name;
        $this->logo = $logo;
        $this->location = $location;
        $this->description = $description;
    }
}
if($brand_data){
    while($row = mysqli_fetch_assoc($brand_data)){
        array_push($brand_arr, new Brand($row['brand_id'], $row['name'], $row['logo'], $row['location'], $row['description']));
    }
}
echo json_encode($brand_arr);
?>