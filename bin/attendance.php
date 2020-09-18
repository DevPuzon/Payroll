<?php 

	
	// if(isset($_POST['employee'])){
		if(true){ 
		$output = array('error'=>false);

		include 'conn.php';
		include 'timezone.php';

		$employee = $_POST['employee'];
		$status = $_POST['status'];
		$desc = $_POST['desc']; 

		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		 
 

		$proof = time()."-$status-".".jpeg";
		$ProfileImage = $_POST['img']; 
		$pathId = "images/".$proof ; 
		$pattern = '/data:image\/(.+);base64,(.*)/';
		preg_match($pattern, $ProfileImage, $matches); 
		$imageExtension = $matches[1]; 
		$encodedImageData = $matches[2]; 
		$decodedImageData = base64_decode($encodedImageData); 
		file_put_contents($pathId, $decodedImageData); 


		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$id = $row['id'];

			$date_now = date('Y-m-d');

			if($status == 'in'){
				$sql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'You have timed in for today';
				}
				else{
					//updates
					$sched = $row['schedule_id'];
					// $lognow = date('H:i:s');
					$sql = "SELECT * FROM schedules WHERE id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus=1;
					 
					$sql = "INSERT INTO attendance (employee_id, date, time_in, status,description,proofimg) VALUES ('$id', '$date_now', NOW(), '$logstatus','$desc','$proof')";
					
					if($conn->query($sql)){
						
						$docid = $conn->insert_id;
						$sqlUpdate =  "select * from attendance where id = $docid";
						$rquery = $conn->query($sqlUpdate);
						$rrow = $rquery->fetch_assoc();
						$logstatus = 1;
					
						$exattimein = new DateTime($srow['time_in']);
						$mytimein = new DateTime($rrow['time_in']);

						$diff = ($mytimein->getTimestamp() - 
						$exattimein->getTimestamp())/60; 
						if($diff > 0 ){
							$logstatus = 0;
						}
						
						$diff = round($diff, 2);
						 
						$sqlUpdateT = "update attendance set late = '$diff',status = '$logstatus' where id = $docid";
						$tquery = $conn->query($sqlUpdateT); 

						
						$output['message'] = 'Time in: '.$row['firstname'].' '.$row['lastname'] ;
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}
			}
			else{
				$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND date = '$date_now'";
				$query = $conn->query($sql);
				if($query->num_rows < 1){
					$output['error'] = true;
					$output['message'] = 'Cannot Timeout. No time in.';
				}
				else{
					$row = $query->fetch_assoc();
					if($row['time_out'] != '00:00:00'){
						$output['error'] = true;
						$output['message'] = 'You have timed out for today';
					}
					else{
						
						$sql = "UPDATE attendance SET time_out = NOW() WHERE id = '".$row['uid']."'";
						if($conn->query($sql)){
							$sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['time_in'];
							$time_out = $urow['time_out'];

							$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$id'";
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

							$sql = "UPDATE attendance SET  overtime = '$getOvertime', num_hr = '$getNumhours', description_out = '$desc',proofimg_out ='$proof' WHERE id = '".$row['uid']."'";
							$conn->query($sql);
							$output['message'] = 'Time out: '.$row['firstname'].' '.$row['lastname'];

						}
						else{
							$output['error'] = true;
							$output['message'] = $conn->error;
						}
					} 
				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Employee ID not found';
		}
		
	}
	 
	echo json_encode($output);

?>