<?php
    require "dbconnect.php";
    $user_id = $_GET['user_id'];
    $get_cart = "SELECT * FROM cart_fashionshop WHERE user_id = '$user_id'";
    $arr_cart_item = array();
    $data_cart = mysqli_query($connect,$get_cart);
    class CartItem{
        function CartItem($cart_id,$user_id,$product_id,$size_id,$quantity){
            $this->cart_id = $cart_id;
            $this->user_id = $user_id;
            $this->product_id = $product_id;
            $this->size_id = $size_id;
            $this->quantity = $quantity;
        }
    }
    while($row = mysqli_fetch_assoc($data_cart)){
        array_push($arr_cart_item, new CartItem($row['cart_id'],$row['user_id'],$row['product_id'],$row['size_id'],$row['quantity']));
    }
    echo json_encode($arr_cart_item);
?>