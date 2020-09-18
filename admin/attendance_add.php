<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$date = $_POST['date'];
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Employee not found';
		}
		else{
			$row = $query->fetch_assoc();
			$emp = $row['id'];

			$sql = "SELECT * FROM attendance WHERE employee_id = '$emp' AND date = '$date'";
			$query = $conn->query($sql);

			if($query->num_rows > 0){
				$_SESSION['error'] = 'Employee attendance for the day exist';
			}
			else{
				//updates
				$sched = $row['schedule_id'];
				$sql = "SELECT * FROM schedules WHERE id = '$sched'";
				$squery = $conn->query($sql);
				$scherow = $squery->fetch_assoc();
				$logstatus = 1;
					
				$exattimein = new DateTime($scherow['time_in']);
				$mytimein = new DateTime($time_in);

				$diff = ($mytimein->getTimestamp() - 
				$exattimein->getTimestamp())/60; 
				if($diff > 0 ){
					$logstatus = 0;
				}else{
					$diff =0;
				}
				$diff = round($diff, 2);

				//
				$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$emp'";
				$isFlexiquery = $conn->query($sql);
				$isFlexirow = $isFlexiquery->fetch_assoc(); 
				if(!$isFlexirow['col_is_flexi']){  
					$sql = "INSERT INTO attendance (employee_id, date, time_in, time_out, status,late) VALUES ('$emp', '$date', '$time_in', '$time_out', '$logstatus','$diff')";
					
					if($conn->query($sql)){
						$id = $conn->insert_id;

						$sql = "SELECT * FROM attendance WHERE id = '$id'";
						$query = $conn->query($sql);
						$row = $query->fetch_assoc();
						$emp = $row['employee_id'];
			
						$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$emp'";
						$query = $conn->query($sql);
						$srow = $query->fetch_assoc();
			
						$exattimeout = new DateTime($scherow['time_out']);

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
						$sql = "UPDATE attendance SET  overtime = '$getOvertime', num_hr = '$getNumhours' WHERE id = '$id'";
						$conn->query($sql);

						$_SESSION['success'] = 'Attendance added successfully';
					}
					else{
						$_SESSION['error'] = $conn->error;
					}
				}else{
					$sql = "INSERT INTO attendance (employee_id, date, time_in, time_out, status) VALUES ('$emp', '$date', '$time_in', '$time_out', '1')";
					
					if($conn->query($sql)){ 
						$id = $conn->insert_id;
						$sql = "UPDATE attendance SET  num_hr = '8' WHERE id = '$id'";	
						$conn->query($sql);

						$_SESSION['success'] = 'Attendance added successfully';
					}
					else{
						$_SESSION['error'] = $conn->error;
					}
				} 
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	header('location: attendance.php');

?>