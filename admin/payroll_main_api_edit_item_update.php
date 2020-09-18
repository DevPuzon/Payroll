<?php
    include 'includes/session.php';
    

        $output = array('error'=>false);
        
        $spayrollid = $_POST['spayrollid'];
        $no_days = $_POST['no_days'];
        $no_hours = $_POST['no_hours'];
        $department = $_POST['department'];
        $rate = $_POST['rate'];
        $rice_incentive = $_POST['rice_incentive'];
        $motor_allowance = $_POST['motor_allowance'];
        $salary_advance = $_POST['salary_advance'];
        $leave = $_POST['leave'];
        $adjustment = $_POST['adjustment'];
        $sss = $_POST['sss'];
        $philhealth = $_POST['philhealth'];
        $pagibig = $_POST['pagibig'];
        $sss_loan = $_POST['sss_loan'];
        $pagibig_loan = $_POST['pagibig_loan'];
        $personal = $_POST['personal'];
        $charges = $_POST['charges'];
        $philcare = $_POST['philcare'];
        $other_deduction = $_POST['other_deduction'];
        $gross = $_POST['gross'];
        $total_gross_pay = $_POST['total_gross_pay'];
        $taxable_income = $_POST['taxable_income'];
        $total_deduction = $_POST['total_deduction'];
        $net_pay = $_POST['net_pay']; 
        $available_loan = $_POST['available_loan']; 
        $employee_id = $_POST['employee_id']; 
        
        
        $sql = "UPDATE `tbl_seasonpayroll` SET  
        `col_total_days` = '$no_days',`col_total_hours` ='$no_hours',
        `col_department`='$department',
        `col_rate`='$rate',`col_rice_incentive`='$rice_incentive',
        `col_motor_allowance`='$motor_allowance',`col_salary_advance`='$salary_advance',
        `col_leave`='$leave',`col_adjustment`='$adjustment',
        `col_sss`='$sss',`col_philhealth`='$philhealth',
        `col_pagibig`='$pagibig',`col_sss_loan`='$sss_loan',
        `col_pagibig_loan`='$pagibig_loan',`col_personal`='$personal',
        `col_charges`='$charges',`col_philcare`='$philcare',
        `col_other_deduction`='$other_deduction',`col_gross`='$gross',
        `col_total_gross_pay`='$total_gross_pay',`col_taxable_income`='$taxable_income',
        `col_total_deduction`='$total_deduction',`col_net_pay` ='$net_pay'
        where `col_spayrollid` = $spayrollid; ";
        if($conn->query($sql)){
            $sql = "UPDATE `tbl_employee_loan` SET  `col_loan`=$available_loan  WHERE `col_employee_id` = '$employee_id' ";
            $conn->query($sql);
            $output['error'] = false;
            $output['message'] = "Updated successfully";
        }
        else{ 
            $output['error'] = true;
            $output['message'] = $conn->error;
        } 

    echo json_encode($output);
?>