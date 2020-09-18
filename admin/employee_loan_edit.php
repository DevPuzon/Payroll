<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){

		$employee_id = $_POST['employee_id'];
		$loan = $_POST['loan'];

		$sql = "update tbl_employee_loan set col_loan = $loan where col_employee_id = '$employee_id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee loan updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: employee_loan.php');

?>