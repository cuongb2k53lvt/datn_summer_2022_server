<?php
    require "dbconnect.php";
    $month = $_GET['month'];
    $year = $_GET['year'];
    $status = $_GET['status'];
    $order = $_GET['order'];
    $user_id = $_GET['user_id'];
    if($order == 'increase'){
        $get_bill_by_user = "SELECT * FROM bill_fashionshop WHERE user_id = '$user_id' AND bill_status = '$status' AND MONTH(date_created) = '$month' AND YEAR(date_created) = '$year' ORDER BY amount ASC";
    }else{
        $get_bill_by_user = "SELECT * FROM bill_fashionshop WHERE user_id = '$user_id' AND bill_status = '$status' AND MONTH(date_created) = '$month' AND YEAR(date_created) = '$year' ORDER BY amount DESC";
    }
    $get_bill_detail = "SELECT * FROM detail_bill_fashionshop INNER JOIN products_fashionshop 
    ON products_fashionshop.product_id = detail_bill_fashionshop.product_id INNER JOIN 
    product_size_fashionshop ON product_size_fashionShop.product_size_id = detail_bill_fashionShop.product_size_id 
    ";
    $data_bill = mysqli_query($connect,$get_bill_by_user);
    $data_bill_detail = mysqli_query($connect,$get_bill_detail);
    $arr_bill = array();
    class Bill{
        function Bill($bill_id,$user_id,$date_created,$date_shipped,$receiver_name,$street_address,$city,
        $contact,$status,$amount,$bill_detail){
            $this->bill_id=$bill_id;
            $this->user_id=$user_id;
            $this->date_created=$date_created;
            $this->date_shipped=$date_shipped;
            $this->receiver_name=$receiver_name;
            $this->street_address=$street_address;
            $this->city=$city;
            $this->contact=$contact;
            $this->status=$status;
            $this->amount=$amount;
            $this->bill_detail = $bill_detail;
        }
        function addDetail($bill_detail){
            array_push($this->bill_detail,$bill_detail);
        }
    }
    class BillDetail{
        function BillDetail($detail_id,$product_size_id,$bill_id,$product_id,$quantity,$product_name,$size,$discount_rate,$price){
            $this->detail_id = $detail_id;
            $this->product_size_id = $product_size_id;
            $this->bill_id = $bill_id;
            $this->product_id = $product_id;
            $this->quantity = $quantity;
            $this->product_name = $product_name;
            $this->size = $size;
            $this->discount_rate = $discount_rate;
            $this->price = $price;
        }
    }
    if($data_bill){
        while($row = mysqli_fetch_assoc($data_bill)){
            array_push($arr_bill,new Bill($row['bill_id'],$row['user_id'],$row['date_created'],$row['date_shipped'],
            $row['receiver_name'],$row['street_address'],$row['city'],$row['contact'],$row['bill_status'],$row['amount'],array()));
        }
    }
    while($row = mysqli_fetch_assoc($data_bill_detail)){
        foreach($arr_bill as $bill){
            if($row['bill_id'] == $bill->bill_id){
                $price = $row['price']*(100-$row['discount_rate_bill'])/100;
                $bill->addDetail(new BillDetail($row['detail_id'],$row['product_size_id'],$row['bill_id'],$row['product_id'],$row['quantity'],$row['product_name'],$row['size'],$row['discount_rate_bill'],$price));
            }
        }
    }

    echo json_encode($arr_bill);
?>