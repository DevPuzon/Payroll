<?php
	include 'includes/session.php'; 
	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$date = $_POST['edit_date'];
		$time_in = $_POST['edit_time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['edit_time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

		
		$sql = "SELECT * FROM attendance WHERE id = '$id'";
		$getEmployeequery = $conn->query($sql);
		$getEmployee = $getEmployeequery->fetch_assoc(); 
		$empId = $getEmployee['employee_id'];
		$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$empId'";
		$isFlexiquery = $conn->query($sql);
		$isFlexirow = $isFlexiquery->fetch_assoc(); 
		 
		if(!$isFlexirow['col_is_flexi']){
			$sql = "UPDATE attendance SET date = '$date', time_in = '$time_in', time_out = '$time_out' WHERE id = '$id'";
		
			if($conn->query($sql)){

				$sql = "SELECT * FROM attendance WHERE id = '$id'";
				$query = $conn->query($sql);
				$row = $query->fetch_assoc();
				$emp = $row['employee_id'];
	
				$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$emp'";
				$query = $conn->query($sql);
				$srow = $query->fetch_assoc();
	 
	
				$exattimeout = new DateTime($srow['time_out']);
	
				$mytimein = new DateTime($time_in); 
				$mytimeout = new DateTime($time_out); 
	
				$getOvertime = ($mytimeout->getTimestamp() - 
						$exattimeout->getTimestamp())/3600; 
	
				$getNumhours = 0; 
				
				if($getOvertime > 0){ 
					$getNumhours = ($exattimeout->getTimestamp() - 
						$mytimein->getTimestamp())/3600;  
				}else{  
					$getNumhours = ($mytimeout->getTimestamp() - 
						$mytimein->getTimestamp())/3600;  
				} 
	
				$getNumhours = round($getNumhours, 2);
				$getOvertime = round($getOvertime, 2);
				$logstatus = 1;
						
				$exattimein = new DateTime($srow['time_in']);
				$mytimein = new DateTime($time_in);
	
				$diff = ($mytimein->getTimestamp() - 
				$exattimein->getTimestamp())/60; 
				if($diff > 0 ){
					$logstatus = 0;
				}else{
					$diff =0;
				}
				$diff = round($diff, 2);
	
				$sql = "UPDATE attendance SET overtime = '$getOvertime', num_hr = '$getNumhours',  status = '$logstatus',late ='$diff' WHERE id = '$id'";
				$conn->query($sql);
				$_SESSION['success'] = 'Attendance updated successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}else{
			$sql = "UPDATE attendance SET date = '$date', time_in = '$time_in', time_out = '$time_out',num_hr = '8',  status = '1',late = '0',overtime ='0' WHERE id = '$id'";
		
			if($conn->query($sql)){ 
				$_SESSION['success'] = 'Attendance updated successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:attendance.php');

?>