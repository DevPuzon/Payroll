<?php
	include 'includes/session.php';
    $output = array('error'=>false);

    $mark = $_POST['mark'];
    $tbl_id = $_POST['tbl_id']; 
    $sql =  "UPDATE `tbl_seasonpayroll` SET `col_markapproved` =$mark  where col_table_id = '$tbl_id'";
    if($conn->query($sql)){
        // $_SESSION['success'] = 'Saved successfully'.$sql;
        $output['error'] = false;
        $output['message'] = 'Approved successfully';
    }
    else{ 
        $output['error'] = true;
        $output['message'] = $conn->error;
    }  
 

    echo json_encode($output);
?>