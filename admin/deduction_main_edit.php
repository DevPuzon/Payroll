<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$edit_col_deductionid = $_POST['edit_col_deductionid'];
		 
		$edit_sss = $_POST['edit_sss'];
		$edit_philhealth = $_POST['edit_philhealth'];
		$edit_pagibig = $_POST['edit_pagibig'];
		$edit_sss_loan = $_POST['edit_sss_loan'];
		$edit_pagibig_loan = $_POST['edit_pagibig_loan']; 
		
        $sql = "update tbl_deduction set col_sss = '$edit_sss',
        col_philhealth='$edit_philhealth',col_pagibig='$edit_pagibig'
        ,col_sss_loan='$edit_sss_loan',col_pagibig_loan='$edit_pagibig_loan' 
        where col_deductionid = '$edit_col_deductionid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	} 

	header('location: deduction_main.php');
?>