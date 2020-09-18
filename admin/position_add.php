<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$title = $_POST['title'];
		$rate = $_POST['rate'];
		$ratepermonth = $_POST['ratepermonth'];

		$sql = "INSERT INTO position (description, rate,col_ratepermonth) VALUES ('$title', '$rate','$ratepermonth')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: position.php');

?>