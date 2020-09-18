<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "select *from  tbl_employee_loan left JOIN employees on col_employee_id = employees.employee_id WHERE col_loan_id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	} 
?>