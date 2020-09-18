<style>
.my-custom-scrollbar {
position: relative;
height: 70%;
overflow: auto;
}
 tr:hover{ 
  background-color: #DADADA; 
  }
.table-wrapper-scroll-y {
display: block;
}th:first-child, td:first-child
{
  position:sticky;
  left:0px;
  background-color:#FFF;
}
</style>
<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini" >
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll add item
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li  >Payroll </li>
        <li class="active">Payroll add item</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">  

      <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
      </div>
      <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
      </div>
  		
      <div class="row">
        <div class="col-xs-12">
          <div class="box"> 
            <div class="box-header with-border">
              <a id="addnew" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-floppy-o"></i> Save </a>
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payForm">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" 
                    class="form-control pull-right col-sm-8"
                     id="reservation" 
                     name="date_range"
                      value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                  </div>
                  <!-- <button type="button" class="btn btn-success btn-sm btn-flat" id="payroll"><span class="glyphicon glyphicon-print"></span> Payroll</button>
                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Payslip</button> -->
                </form>
              </div>
            </div> 
            <div style="padding:10px;">
              <div class="table-wrapper-scroll-y my-custom-scrollbar">
                  <table id="example1" class="table table-bordered table-striped mb-0">
                  <thead>
                    <th>Employee ID</th>
                    <th>Employee Name</th> 
                    <th>Department</th> 
                    <th>No. of days</th>  
                    <th>No. of hours</th>  
                    <th>Rate per hour</th>  
                    <th>Rate per month</th>  
                    <th>Defualt overtime hour/s</th>  
                    <th>Gross</th> 
                    <th>Rice incentive</th> 
                    <th>Motor allowance</th> 
                    <th>Salary advance</th> 
                    <th>Leave</th> 
                    <th>Adjustment</th> 
                    <th>Total Gross pay</th> 
                    <th>Taxable income</th> 
                    <th>SSS</th> 
                    <th>PhilHealth</th> 
                    <th>Pagibig</th> 
                    <th>SSS Loan</th> 
                    <th>Pagibig Loan</th>  
                    <th>Personal</th> 
                    <th>Charges</th> 
                    <th>PhilCare</th> 
                    <th>Other deduction</th> 
                    <th>Total deduction</th> 
                    <th>Net Pay</th>  
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
                      $query = $conn->query($sql);
                      $drow = $query->fetch_assoc();
                      $deduction = $drow['total_amount'];  
                      
                      $to = date('Y-m-d');
                      $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                      if(isset($_GET['range'])){
                        $range = $_GET['range'];
                        $ex = explode(' - ', $range);
                        $from = date('Y-m-d', strtotime($ex[0]));
                        $to = date('Y-m-d', strtotime($ex[1]));
                      }

                      $sql = "SELECT *, SUM(num_hr) AS total_hr, attendance.employee_id AS empid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id left join tbl_deduction on tbl_deduction.col_employeeid = employees.employee_id LEFT JOIN tbl_department ON tbl_department.col_departmentid=employees.department_id left join tbl_employee_loan on tbl_employee_loan.col_employee_id = employees.employee_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";
                      
                      $query = $conn->query($sql);
                      $total = 0;
                      $sqlSaveTable = "INSERT INTO `tbl_seasonpayroll`(`col_table_id`, `col_employeeid`, `col_employee_firstname`, `col_employee_lastname`,`col_department`,`col_total_days`,`col_total_hours`,`col_rate`,`col_ratepermonth`,`col_defovertime`, `col_gross`, `col_rice_incentive`, `col_motor_allowance`, `col_salary_advance`, `col_leave`, `col_adjustment`, `col_total_gross_pay`, `col_taxable_income`, `col_sss`, `col_philhealth`, `col_pagibig`, `col_sss_loan`, `col_pagibig_loan` ,`col_personal`, `col_charges`, `col_philcare`,`col_other_deduction`,`col_total_deduction`, `col_net_pay`,`col_fromdate`,`col_todate` )VALUES";
                      $values = "";
                      $letters = '';
                      $numbers = '';
                      foreach (range('A', 'Z') as $char) {
                          $letters .= $char;
                      }
                      for($i = 0; $i < 10; $i++){
                        $numbers .= $i;
                      }
                      $tableid = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 2);

                      while($row = $query->fetch_assoc()){
                        $empid = $row['empid']; 
                        $sqlCDay ="SELECT count(id) as countday FROM `attendance` WHERE employee_id = '$empid' and date BETWEEN '$from' AND '$to'";       
          
                        $cDayQuery = $conn->query($sqlCDay);
                        $cDayRow = $cDayQuery->fetch_assoc();
                        
                        $sqlGetAllOTime ="SELECT SUM(overtime) as col_defovertime  FROM `attendance` WHERE employee_id = '$empid' and date BETWEEN '$from' AND '$to'";       
                        // echo $sqlGetAllOTime;
                        $queryGetAllOTime = $conn->query($sqlGetAllOTime);
                        $rowGetAllOTime = $queryGetAllOTime->fetch_assoc();
                        $getAllOTime = $rowGetAllOTime['col_defovertime'];
                        $countday = $cDayRow['countday'];
                        // $salary = $row['rate'] * $row['total_hr'];
                        $salary = $row['col_ratepermonth'] ;
                        $riceIncentive = 0 ;
                        $motorAllowance = 0 ;
                        $salaryAdvance = 0 ;
                        $leave =0 ;
                        $adjustment = 0 ;

                        $personal = 0 ;
                        $charges =0 ;
                        $philcare = 0 ;
                        $other_deduction = 0 ;

                        $totalgross = $riceIncentive+
                        $motorAllowance+$salaryAdvance
                        +$leave+$adjustment
                        +$salary;

                        $taxableIncome = $salary+$salaryAdvance+$leave;

                        $totalDeduc = $row['col_sss']+ $row['col_pagibig']+
                        $row['col_philhealth']+ $row['col_sss_loan']+  
                        $row['col_pagibig_loan']+
                        $personal + $charges + $philcare +$other_deduction;

                        $netPay = $totalgross - $totalDeduc;
                       
                        $values = $values."('$tableid',
                        '".$row['employee_id']."','".$row['firstname']."',
                        '".$row['lastname']."','".$row['col_department']."','$countday',
                        '".$row['total_hr']."',
                        '".$row['rate']."',
                        '".$row['col_ratepermonth']."',
                        '".$getAllOTime."',
                        '".$salary."',
                        '".$riceIncentive."',
                        '".$motorAllowance."',
                        '".$salaryAdvance."', 
                        '".$leave."','".$adjustment."',
                        '".$totalgross."','".$taxableIncome."',
                        '".$row['col_sss']."','".$row['col_philhealth']."',
                        '".$row['col_pagibig']."','".$row['col_sss_loan']."',
                        '".$row['col_pagibig_loan']."','".$personal."',
                        '".$charges."','".$philcare."','".$other_deduction."',
                        '".$totalDeduc."','".$netPay."', 
                        '$from','$to'),";

                        echo "
                          <tr>
                            <td>".$row['employee_id']."</td> 
                            <td>".$row['lastname'].", ".$row['firstname']."</td>
                            <td>".$row['col_department']."</td> 
                            <td>".$countday."</td> 
                            <td>".number_format($row['total_hr'], 2)."</td>  
                            <td>".number_format($row['rate'], 2)."</td> 
                            <td>".number_format($row['col_ratepermonth'], 2)."</td> 
                            <td>".number_format($getAllOTime, 2)."</td> 
                            <td>".number_format($salary, 2)."</td> 

                            <td>".number_format($riceIncentive, 2)."</td> 
                            <td>".number_format($motorAllowance, 2)."</td> 
                            <td>".number_format($salaryAdvance, 2)."</td> 
                            <td>".number_format($leave, 2)."</td> 
                            <td>".number_format($adjustment, 2)."</td>   

                            <td>".number_format($totalgross, 2)."</td> 
                            <td>".number_format($taxableIncome, 2)."</td> 
                            <td>".number_format($row['col_sss'], 2)."</td> 
                            <td>".number_format($row['col_philhealth'], 2)."</td>  
                            <td>".number_format($row['col_pagibig'], 2)."</td> 
                            <td>".number_format($row['col_sss_loan'], 2)."</td> 
                            <td>".number_format($row['col_pagibig_loan'], 2)."</td>  
                            <td>".number_format($personal, 2)."</td> 
                            <td>".number_format($charges, 2)."</td> 
                            <td>".number_format($philcare, 2)."</td> 
                            <td>".number_format($other_deduction, 2)."</td> 
                            <td>".number_format($totalDeduc, 2)."</td> 
                            <td>".number_format($netPay, 2)."</td>   
                          </tr>
                        ";
                      }
                      $sqlSaveTable = $sqlSaveTable . $values; 
                      $sqlSaveTable = substr($sqlSaveTable, 0, -1);  
                      $sqlSaveTable = trim(preg_replace('/\s+/', ' ', $sqlSaveTable));
                      echo "<p id='sqlSaveTable' style='visibility: collapse; height: 0px;'>$sqlSaveTable</p>";
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?> 
<script>  

$('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('#addnew').click(function(e){
    var sql = $("#sqlSaveTable").text(); 
    console.log(sql);
    $.ajax({
      type: 'POST',
      url: 'payroll_main_api_add.php',
      data: {sql:sql},  
      dataType: 'json',
      success: function(response){
        console.log(response); 
        
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message); 
          setTimeout(function(){ window.location.href = "payroll_main.php"; }, 1500);
          
        }
      } 
    });
  }); 
  
  $(function(){
    $("#reservation").on('change', function(){
      var range = encodeURI($(this).val());
      window.location = 'payroll_main_add.php?range='+range;
    });
  });

  $('#payroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payroll_generate.php');
    $('#payForm').submit();
  });

  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payslip_generate.php');
    $('#payForm').submit();
      });

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'position_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#posid').val(response.id);
      $('#edit_title').val(response.description);
      $('#edit_rate').val(response.rate);
      $('#del_posid').val(response.id);
      $('#del_position').html(response.description);
    }
  });
}


</script>
</body>
</html>
