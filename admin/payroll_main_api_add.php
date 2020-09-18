<?php
	include 'includes/session.php';
    $output = array('error'=>false);

    $sql = $_POST['sql'];
      
    if($conn->query($sql)){
        // $_SESSION['success'] = 'Saved successfully'.$sql;
        $output['error'] = false;
        $output['message'] = 'Saved successfully';
    }
    else{
        // $_SESSION['error'] = $conn->error.$sql;
        $output['error'] = true;
        $output['message'] = $conn->error;
    } 

	// header('location: payroll_main_add.php');

 

    echo json_encode($output);
?>