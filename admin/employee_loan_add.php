<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){

		$employee_id = $_POST['employee_id'];
		$loan = $_POST['loan'];

		$sql = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
		$query = $conn->query($sql);

		if($query->num_rows > 0){ 
			$sql = "SELECT * FROM tbl_employee_loan WHERE col_employee_id = '$employee_id'";
			$query = $conn->query($sql);
			if($query->num_rows == 0){
				$sql = "INSERT INTO tbl_employee_loan (col_employee_id, col_loan) VALUES ('$employee_id', '$loan')";
				if($conn->query($sql)){
					$_SESSION['success'] = 'Employee loan added successfully';
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			}else{
				$_SESSION['error'] ='Employee id is existing you can only modify it.'; 
			}
		} else{
			$_SESSION['error'] ='Employee ID not found'; 
		} 
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: employee_loan.php');

?>