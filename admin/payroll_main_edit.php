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
 
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) --> 
    <section class="content-header">
      <h1>
        Payroll item
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li  >Payroll </li>
        <li class="active">Payroll item</li>
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
        <div  class="col-xs-12"> 
          <h3 id="markapproved" hidden class="text-danger">Mark as approved</h3>
          <div class="box">
            <div class="box-header with-border"> 
              <a id="btn_markapproved" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-like "></i> Mark as approved </a>
              
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payForm"> 
                  <h4>
                 <?php include 'includes/scripts.php'; ?> 
                  <?php 
                    $table_id =$_GET['table_id'];
                    $sql = "SELECT * FROM `tbl_seasonpayroll` where col_table_id = '".$_GET['table_id']."' GROUP by col_table_id order by col_fromdate";
                    $query = $conn->query($sql); 
                    $row = $query->fetch_assoc();
                    echo $row['col_fromdate']." - ".$row['col_todate'];
                    
                    if($row['col_markapproved'] == 1){
                        echo "
                        <script>
                        $(function(){
                          $('#markapproved').show();
                          $('#btn_markapproved').html('Mark as unapproved');
                        });
                        </script>";
                    }
                    echo "<input type='hidden' id='get_markapproved' value='".$row['col_markapproved']."'>";
                    ?>
                  </h4> 
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
                        <th>Default overtime hours</th>  
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
                        <th>Employee Loan</th> 
                        <th>Personal</th> 
                        <th>Charges</th> 
                        <th>PhilCare</th> 
                        <th>Other deduction</th> 
                        <th>Total deduction</th> 
                        <th>Net Pay</th>  
                      </thead>
                  <tbody>
                  <?php  
                    $sql = "SELECT * FROM `tbl_seasonpayroll` where `col_table_id` = '".$_GET['table_id']."'";
                    $query = $conn->query($sql); 
                    while($row = $query->fetch_assoc()){
                      $spayrollid = $row['col_spayrollid'];   
                      $empid = $row['col_employeeid'];   
                      $countday = $row['col_total_days'];
                      $counthrs = $row['col_total_hours'];
                      $salary =  $row['col_gross'];
                      $riceIncentive = $row['col_rice_incentive']; 
                      $motorAllowance = $row['col_motor_allowance']; 
                      $salaryAdvance = $row['col_salary_advance']; 
                      $leave = $row['col_leave']; 
                      $adjustment = $row['col_adjustment']; 

                      $personal = $row['col_personal']; 
                      $charges = $row['col_charges']; 
                      $philcare = $row['col_philcare']; 

                      $totalgross = $row['col_total_gross_pay'];

                      $taxableIncome = $row['col_taxable_income'];
                      $otherDeduc = $row['col_other_deduction'];

                      $totalDeduc = $row['col_total_deduction']; 

                      $netPay = $row['col_net_pay']; 
                      echo "
                        <tr>
                          <td> <a onclick=editItem($spayrollid)  class='btn btn-primary btn-sm btn-flat'><i class='fa fa-pencil'></i> 
                          </a> <a  onclick=deleteItem($spayrollid) class='btn btn-danger btn-sm btn-flat'><i class='fa fa-trash'></i> </a> 
                          ".$empid." </td> 
                          <td>".$row['col_employee_lastname'].", ".$row['col_employee_firstname']."</td>
                          <td>".$row['col_department']."</td>
                          <td>".$countday."</td>  
                          <td>".number_format($counthrs, 2)."</td>  
                          <td>".number_format($row['col_rate'], 2)."</td>  
                          <td>".number_format($row['col_ratepermonth'], 2)."</td>  
                          <td>".number_format($row['col_defovertime'], 2)."</td> 
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
                          <td>".number_format($row['col_loan'], 2)."</td> 
                          <td>".number_format($personal, 2)."</td> 
                          <td>".number_format($charges, 2)."</td> 
                          <td>".number_format($philcare, 2)."</td> 
                          <td>".number_format($otherDeduc, 2)."</td> 
                          <td>".number_format($totalDeduc, 2)."</td> 
                          <td>".number_format($netPay, 2)."</td>   
                        </tr>
                      ";
                    }

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
<script> 
function editItem(id){
    console.log("editItem"+id);
    window.location.href = "payroll_main_edit_item.php?item_id="+id;
}
function deleteItem(id){ 
  console.log("deleteItem"+id); 
  if (confirm("Do you want to delete?")) { 
    $.ajax({
      type: 'POST',
      url: 'payroll_main_api_edit_item_delete.php',
      data: {spayrollid:id},  
      dataType: 'json',
      success: function(response){  
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{  
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message); 
          setTimeout(function(){ window.location.reload(); }, 1500);
        }
      } 
    });
  }  
}
 
$('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $('#btn_markapproved').click(function(e){
    var get_markapproved  = $("#get_markapproved").val(); 
    if(get_markapproved == undefined){
        get_markapproved = 0;
    }
    if(get_markapproved == 0){
        get_markapproved =1;
    }else{
        get_markapproved =0;
    }
    var tbl_id = location.search.split('table_id=')[1];
    console.log(get_markapproved);
    $.ajax({
      type: 'POST',
      url: 'payroll_main_api_markapproved.php',
      data: {mark:get_markapproved,tbl_id:tbl_id},  
      dataType: 'json',
      success: function(response){
        console.log(response); 
        
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{  
          $("#btn_markapproved").html("Mark as unapproved");
          if(get_markapproved == 1){
             $("#get_markapproved").val(0);
          }else{
             $("#get_markapproved").val(1);
          }
          window.location.reload();
        }
      } 
    });
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
