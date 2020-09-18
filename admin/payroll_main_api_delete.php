<?php
	include 'includes/session.php';
    $output = array('error'=>false);


    $tbl_id = $_POST['tbl_id'];
    $sql = "DELETE FROM tbl_seasonpayroll WHERE col_table_id = '$tbl_id'";
    if($conn->query($sql)){
        // $_SESSION['success'] = 'Saved successfully'.$sql;
        $output['error'] = false;
        $output['message'] = 'Deleted successfully';
    }
    else{
        // $_SESSION['error'] = $conn->error.$sql;
        $output['error'] = true;
        $output['message'] = $conn->error;
    } 

	// header('location: payroll_main_add.php'); 

    echo json_encode($output);
	
?>