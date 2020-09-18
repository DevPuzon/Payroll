<?php
	$conn = new mysqli('localhost', 'root', 'KzofDp930F3x', 'ryjq_hrms_payroll');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>
