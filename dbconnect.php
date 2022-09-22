<?php
	$connect = mysqli_connect("localhost:3306","root","Tr@nduc1710","datn4");
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	mysqli_query($connect, "SET NAME 'utf8'");
?>