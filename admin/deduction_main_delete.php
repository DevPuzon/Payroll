<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['deduction_id'];
		$sql = "DELETE FROM tbl_deduction WHERE col_deductionid = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Item deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: deduction_main.php');
	
?>