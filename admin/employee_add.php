<?php
	include 'includes/session.php';
 
	$employee_id = $_POST['employee_id'];
 
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$birthdate = $_POST['birthdate'];
	$contact = $_POST['contact'];
	$gender = $_POST['gender'];
	$position = $_POST['position'];
	$department = $_POST['department'];
	$schedule = $_POST['schedule'];
	$filename = $_FILES['photo']['name'];

	//deduction
	
	$sss = $_POST['sss'];
	$philhealth = $_POST['philhealth'];
	$pagibig = $_POST['pagibig'];
	$sss_loan = $_POST['sss_loan'];
	$pagibig_loan = $_POST['pagibig_loan'];
		



	if(!empty($filename)){
		move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
	}
	//creaxting employeeid
	$letters = '';
	$numbers = '';
	foreach (range('A', 'Z') as $char) {
		$letters .= $char;
	}
	for($i = 0; $i < 10; $i++){
		$numbers .= $i;
	}
	$docid = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
	//
	$sql = "INSERT INTO employees (employee_id, firstname, lastname, address, birthdate, contact_info, gender, position_id,department_id ,schedule_id, photo, created_on) VALUES ('$employee_id', '$firstname', '$lastname', '$address', '$birthdate', '$contact', '$gender', '$position','$department' , '$schedule', '$filename', NOW())";
	$sqlDeduction = "insert into tbl_deduction(col_deductionid,col_employeeid,col_sss,col_philhealth,col_pagibig,col_sss_loan,col_pagibig_loan)
	values('$docid','$employee_id','$sss','$philhealth','$pagibig','$sss_loan','$pagibig_loan')";
	
	if($conn->query($sql) && $conn->query($sqlDeduction)){
		$_SESSION['success'] = 'Employee added successfully';
	}
	else{
		$sqlDel = "delete from employees where employee_id = '$employee_id'";
		$conn->query($sqlDel);
		$_SESSION['error'] = $conn->error;
	}

	header('location: employee.php'); 
?>