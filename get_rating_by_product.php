<?php
    require "dbconnect.php";
    $product_id = $_GET['product_id'];
    $select_rating = "SELECT * FROM rating_fashionshop WHERE product_id = '$product_id'";
    $data_rating = mysqli_query($connect,$select_rating);
    $arr_rating = array();
    class Rating{
        function Rating($rating_id,$user_id,$product_id,$score,$comment){
            $this->rating_id = $rating_id;
            $this->user_id = $user_id;
            $this->product_id = $product_id;
            $this->score = $score;
            $this->comment = $comment;
        }
    }
    while($row = mysqli_fetch_assoc($data_rating)){
        array_push($arr_rating,new Rating($row['rating_id'],$row['user_id'],$row['product_id'],$row['score'],$row['comment']));
    }
    echo json_encode($arr_rating);
?>