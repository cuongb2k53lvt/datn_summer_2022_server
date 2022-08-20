<?php
    require "dbconnect.php";
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $score = $_POST['score'];
    $comment = $_POST['comment'];
    $check_result = 0;
    $sum_score = 0;
    $count_rating = 0;
    $get_user_rating = "SELECT * FROM rating_fashionshop WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $data_get_user_rating = mysqli_query($connect,$get_user_rating);
    while($row = mysqli_fetch_assoc($data_get_user_rating)){
        $check_result++;
    }
    if($check_result==0){
        $insert_rating = "INSERT INTO rating_fashionshop VALUES(null,'$user_id','$product_id','$score','$comment')";
        mysqli_query($connect,$insert_rating);
    }else{
        $update_rating = "UPDATE rating_fashionshop SET score = '$score', comment = '$comment' WHERE user_id = '$user_id' AND product_id = '$product_id'";
        mysqli_query($connect,$update_rating);
    }
    $select_rating_by_product = "SELECT * FROM rating_fashionshop WHERE product_id = '$product_id'";
    $data_rating = mysqli_query($connect,$select_rating_by_product);
    while($row = mysqli_fetch_assoc($data_rating)){
        $sum_score+=$row['score'];
        $count_rating++;
    }
    $score_update = $sum_score/$count_rating;
    $update_product_rating = "UPDATE products_fashionshop SET rating = '$score_update' WHERE product_id = '$product_id'";
    mysqli_query($connect,$update_product_rating);
    echo $score_update;
?>