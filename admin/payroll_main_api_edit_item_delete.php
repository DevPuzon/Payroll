<?php
	include 'includes/session.php';
    $output = array('error'=>false);


    $spayrollid = $_POST['spayrollid'];
    $sql = "DELETE FROM `tbl_seasonpayroll` WHERE `col_spayrollid` = $spayrollid";
    if($conn->query($sql)){ 
        $output['error'] = false;
        $output['message'] = 'Deleted successfully';
    }
    else{ 
        $output['error'] = true;
        $output['message'] = $conn->error;
    }  

    echo json_encode($output);
	
?>