<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){ 
		$employee_id = $_POST['employee_id'];

		$sql = "delete from tbl_employee_loan where col_employee_id = '$employee_id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee loan deleted successfully';
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