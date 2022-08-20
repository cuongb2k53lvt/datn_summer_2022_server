<?php
    require "dbconnect.php";
    $user_id = $_GET['user_id'];
    $get_all_product = "SELECT * FROM products_fashionshop INNER JOIN clothes_type_fashionshop ON 
    products_fashionshop.type_id = clothes_type_fashionshop.type_id INNER JOIN brand_fashionshop ON 
    products_fashionshop.brand_id = brand_fashionshop.brand_id INNER JOIN follow_product_fashionshop ON 
    products_fashionshop.product_id = follow_product_fashionshop.product_id WHERE follow_product_fashionshop.user_id = '$user_id'";
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