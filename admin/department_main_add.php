<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$department = $_POST['department']; 

		$sql = "INSERT INTO tbl_department (col_department) VALUES ('$department')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Department added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: department_main.php');

?>