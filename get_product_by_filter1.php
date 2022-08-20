<?php
    require "dbconnect.php";
    $brand_id = $_GET['brand_id'];
    $type = $_GET['type'];
    $value = $_GET['value'];
    $price_range = $_GET['price_range'];
    $brand_condition = '';
    $price_range_condition = '';
    if($brand_id !='Tất cả'){
        $brand_condition = "AND products_fashionshop.brand_id = '$brand_id'";
    }
    if($price_range != 'Tất cả'){
        switch ($price_range) {
            case 'Tier 1':
                $price_range_condition = 'AND products_fashionshop.price < 500000';
                break;
            case 'Tier 2':
                $price_range_condition = 'AND products_fashionshop.price > 500000 AND products_fashionshop.price < 1000000';
                break;
            case 'Tier 3':
                $price_range_condition = 'AND products_fashionshop.price > 1000000 AND products_fashionshop.price < 2000000';
                break;
            case 'Tier 4':
                $price_range_condition = 'AND products_fashionshop.price > 2000000';
                break;                
            default:
                $price_range_condition = '';
                break;
        }
    }
    $get_all_product = "SELECT * FROM products_fashionshop INNER JOIN clothes_type_fashionshop ON 
    products_fashionshop.type_id = clothes_type_fashionshop.type_id INNER JOIN brand_fashionshop ON 
    products_fashionshop.brand_id = brand_fashionshop.brand_id WHERE clothes_type_fashionshop.type = '$type' ".$brand_condition." ".$price_range_condition."  
    ORDER BY products_fashionshop.price ".$value;
    // if($type == 'Tất cả'){
        // $get_all_product = "SELECT * FROM products_fashionshop INNER JOIN clothes_type_fashionshop ON 
        // products_fashionshop.type_id = clothes_type_fashionshop.type_id INNER JOIN brand_fashionshop ON 
        // products_fashionshop.brand_id = brand_fashionshop.brand_id WHERE products_fashionshop.brand_id = '$brand_id'  
        // ORDER BY products_fashionshop.price ".$value;
    // }else{
    //     $get_all_product = "SELECT * FROM products_fashionshop INNER JOIN clothes_type_fashionshop ON 
    //     products_fashionshop.type_id = clothes_type_fashionshop.type_id INNER JOIN brand_fashionshop ON 
    //     products_fashionshop.brand_id = brand_fashionshop.brand_id WHERE products_fashionshop.brand_id = '$brand_id' AND  clothes_type_fashionshop.type = '$type' 
    //     ORDER BY products_fashionshop.price ".$value;
    // }
    $get_all_product_size = "SELECT * FROM product_size_fashionshop";
    $get_all_product_photo = "SELECT * FROM product_photo_fashionshop";
    $data_product = mysqli_query($connect,$get_all_product);
    $data_size = mysqli_query($connect,$get_all_product_size);
    $data_photo = mysqli_query($connect,$get_all_product_photo);
    $arr_product = array();
    class Product{
        function Product($id,$type,$brand,$product_name,$description,$price,$cost,$date_added,$rating,$discount_rate,$location,$material,$status,$sizes,$photos){
            $this->id = $id;
            $this->type = $type;
            $this->brand = $brand;
            $this->product_name = $product_name;
            $this->description = $description;
            $this->price = $price;
            $this->cost = $cost;
            $this->date_added = $date_added;
            $this->rating = $rating;
            $this->discount_rate = $discount_rate;
            $this->location = $location;
            $this->material = $material;
            $this->status = $status;
            $this->sizes = $sizes;
            $this->photos = $photos;
        }
        function addSize($size){
            array_push($this->sizes,$size);
        }
        function addPhoto($photo){
            array_push($this->photos,$photo);
        }
    }
    class ProductSize{
        function ProductSize($size_id,$size,$remain_product,$total_product){
            $this->size_id = $size_id;
            $this->size = $size;
            $this->remain_product = $remain_product;
            $this->total_product = $total_product;
        }
    }
    class ProductPhoto{
        function ProductPhoto($photo){
            $this->photo = $photo;
        }
    }
    while($row = mysqli_fetch_assoc($data_product)){
        array_push($arr_product, new Product($row['product_id'],$row['type'],$row['name'],$row['product_name'],$row['description_prd'],$row['price'],$row['cost'],$row['date_added'],$row['rating'],$row['discount_rate'],$row['location'],$row['material'],$row['status'],array(),array()));
    }
    while($row = mysqli_fetch_assoc($data_size)){
        foreach($arr_product as $product){
            if($row['product_id'] == $product->id){
                $product->addSize(new ProductSize($row['product_size_id'],$row['size'],$row['remain_product'],$row['total_product']));
            }
        }
    }
    while($row = mysqli_fetch_assoc($data_photo)){
        foreach($arr_product as $product){
            if($row['product_id'] == $product->id){
                $product->addPhoto($row['photo']);
            }
        }
    }
    
    echo json_encode($arr_product);
?>