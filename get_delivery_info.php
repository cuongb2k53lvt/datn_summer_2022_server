<?php
    require "dbconnect.php";
    $user_id = $_GET['user_id'];
    $get_delivery_info = "SELECT * FROM delivery_info_fashionshop WHERE user_id = '$user_id'";
    $data_delivery_info = mysqli_query($connect,$get_delivery_info);
    class DeliveryInfo{
        public $delivery_id;
        function DeliveryInfo($delivery_id, $user_id, $receiver_name, $street_address, $city, $contact){
            $this->delivery_id = $delivery_id;
            $this->user_id = $user_id;
            $this->receiver_name = $receiver_name;
            $this->street_address = $street_address;
            $this->city = $city;
            $this->contact = $contact;
        }
    }
    if($data_delivery_info){
        $delivery_id = new DeliveryInfo("null","null","null","null","null","null");
        while($row = mysqli_fetch_assoc($data_delivery_info)){
            $delivery_id = new DeliveryInfo($row['delivery_id'],$row['user_id'],$row['receiver_name'],$row['street_address'],$row['city'],$row['contact']);
            echo json_encode($delivery_id);
        }
        if($delivery_id->delivery_id == "null"){
            echo json_encode($delivery_id);
        }
    }
    // if($delivery_info!='empty'){
    //     echo json_encode($delivery_id);
    // }else{
    //     echo $delivery_info;
    // }
    
?>