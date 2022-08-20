<?php
    require "dbconnect.php";
    $product_id = $_GET['product_id'];
    $query_get_product = "SELECT * FROM products_fashionshop INNER JOIN clothes_type_fashionshop ON 
    products_fashionshop.type_id = clothes_type_fashionshop.type_id INNER JOIN brand_fashionshop ON 
    products_fashionshop.brand_id = brand_fashionshop.brand_id WHERE product_id = '$product_id'";
    $query_get_sizes = "SELECT * FROM product_size_fashionshop WHERE product_id = '$product_id'";
    $query_get_photo = "SELECT * FROM product_photo_fashionshop WHERE product_id = '$product_id'";
    $data_sizes = mysqli_query($connect,$query_get_sizes);
    $data_photo = mysqli_query($connect,$query_get_photo);
    $data_product = mysqli_query($connect,$query_get_product);
    $product = '';
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
        $product = new Product($row['product_id'],$row['type'],$row['name'],$row['product_name'],$row['description_prd'],$row['price'],$row['cost'],$row['date_added'],$row['rating'],$row['discount_rate'],$row['location'],$row['material'],$row['status'],array(),array());
    }
    while($row = mysqli_fetch_assoc($data_photo)){
        $product->addPhoto($row['photo']);
    }
    while($row = mysqli_fetch_assoc($data_sizes)){
        $product->addSize(new ProductSize($row['product_size_id'],$row['size'],$row['remain_product'],$row['total_product']));
    }
    echo json_encode($product);
?>