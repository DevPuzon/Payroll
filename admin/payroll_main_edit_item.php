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
<body class='hold-transition skin-blue sidebar-mini'>
<div class='wrapper'>

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Payroll edit item
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li  >Payroll </li>
        <li class='active'>Payroll item</li>
        <li class='active'>Payroll edit item</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class='content'> 
      <div class='alert alert-success alert-dismissible mt20 text-center' style='display:none;'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <span class='result'><i class='icon fa fa-check'></i> <span class='message'></span></span>
      </div>
      <div class='alert alert-danger alert-dismissible mt20 text-center' style='display:none;'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <span class='result'><i class='icon fa fa-warning'></i> <span class='message'></span></span>
      </div>
      <div class='row'>
        <div  class='col-xs-12'>  
          <div class='box'>
          
          <?php
                    $item_id = $_GET['item_id'];
                    $sql = "select *,tbl_employee_loan.col_loan as col_available_loan ,tbl_seasonpayroll.col_loan as col_loan_deduc from `tbl_seasonpayroll` left join tbl_employee_loan on tbl_employee_loan.col_employee_id = tbl_seasonpayroll.col_employeeid where `col_spayrollid` = $item_id";
                    $query = $conn->query($sql); 
                    $row = $query->fetch_assoc(); 
                    echo "
                    <form id='update' action=''>   
                        <div class='box-header with-border'>
                        <button id='btn_update' type='submit' name='update' class='btn btn-success btn-sm btn-flat'><i class='fa fa-save '></i> Update </button>
                        <input type='hidden' id='spayrollid' name='spayrollid' value='".$row['col_spayrollid']."'>
                        <div class='box-body'>
                            
                            <div class='row'>
                                <div class='form-group col-md-3'>
                                    <label  >Employee Id</label>
                                    <input value='".$row['col_employeeid']."' readonly  type='text' class='form-control' id='employee_id' name='employee_id' placeholder='Employee Id'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label  >Employee name</label>
                                    <input value='".$row['col_employee_firstname']." ".$row['col_employee_lastname']."' readonly  type='text' class='form-control' id='employee_name'  name='employee_name' placeholder='Employee name'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label  >Department</label>
                                    <input value='".$row['col_department']."' readonly  type='text' class='form-control' id='department'  name='department' placeholder='Department'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >No. of days</label>
                                    <input value='".$row['col_total_days']."'    type='text' class='form-control' id='no_days' name='no_days' placeholder='No. of days'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >No. of hours</label>
                                    <input value='".number_format($row['col_total_hours'], 2)."'   type='text' class='form-control' id='no_hours' name='no_hours' placeholder='No. of hours'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Default overtime hours</label>
                                    <input value='".number_format($row['col_defovertime'], 2)."' readonly  type='text' class='form-control' id='no_hours' name='no_hours' placeholder='No. of hours'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Rate per hour</label>
                                    <input value='".number_format($row['col_rate'], 2)."' readonly type='text' class='form-control' id='rate' name='rate' placeholder='Rate per hour'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Rate per month</label>
                                    <input value='".$row['col_ratepermonth']."'   type='text' class='form-control' id='ratepermonth' name='ratepermonth' placeholder='Rate per month' readonly>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label  >Gross</label>
                                    <input value='".$row['col_gross']."' type='text' class='form-control' id='gross' name='gross' placeholder='Gross'>
                                </div>
                            </div> 
                            <br><br>
                            <div class='row' >
                                <div class='form-group col-md-3'>
                                    <label >Rice incentive</label>
                                    <input value='".$row['col_rice_incentive']."'  type='text' class='form-control' id='rice_incentive' name='rice_incentive' placeholder='Rice incentive'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Motor allowance</label>
                                    <input value='".$row['col_motor_allowance']."'  type='text' class='form-control' id='motor_allowance' name='motor_allowance' placeholder='Motor allowance'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Salary advantace</label>
                                    <input value='".$row['col_salary_advance']."'  type='text' class='form-control' id='salary_advance' name='salary_advance' placeholder='Salary advantace'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Leave</label>
                                    <input value='".$row['col_leave']."'  type='text' class='form-control' id='leave' name='leave' placeholder='Leave'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Adjustment</label>
                                    <input value='".$row['col_adjustment']."'  type='text' class='form-control' id='adjustment' name='adjustment' placeholder='Adjustment'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label  >Total gross pay</label>
                                    <input value='".$row['col_total_gross_pay']."'  readonly  type='text' class='form-control' id='total_gross_pay' name='total_gross_pay' placeholder='Total gross pay'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label  >Taxable income</label>
                                    <input value='".$row['col_taxable_income']."'  readonly  type='text' class='form-control' id='taxable_income' name='taxable_income' placeholder='Taxable income'>
                                </div> 
                            </div> 
                            <br><br>
                            <div class='row'>
                                <div class='form-group col-md-3'>
                                    <label >SSS</label>
                                    <input value='".$row['col_sss']."'  type='text' class='form-control' id='sss' name='sss' placeholder='SSS'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >PhilHealth</label>
                                    <input value='".$row['col_philhealth']."'  type='text' class='form-control' id='philhealth' name='philhealth' placeholder='PhilHealth'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Pagibig</label>
                                    <input value='".$row['col_pagibig']."'  type='text' class='form-control' id='pagibig' name='pagibig' placeholder='Pagibig'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >SSS loan</label>
                                    <input value='".$row['col_sss_loan']."'  type='text' class='form-control' id='sss_loan'  name='sss_loan' placeholder='SSS Loan'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Pagibig loan</label>
                                    <input value='".$row['col_pagibig_loan']."'  type='text' class='form-control' id='pagibig_loan'  name='pagibig_loan' placeholder='Pagibig loan'>
                                </div> 
                                <div class='form-group col-md-3'>
                                    <label >Available Employee loan</label>
                                    <input value='".$row['col_available_loan']."' readonly type='text' class='form-control' id='available_loan'  name='available_loan' placeholder='Available employee loan'>
                                    <p class='text-warning'>Once you update the employee loan it will deduct to employee loan module. </p>
                                </div> 
                                <div class='form-group col-md-3'>
                                    <label >Employee loan</label>
                                    <input value='".$row['col_loan_deduc']."'  type='text' class='form-control' id='loan'  name='loan' placeholder='Employee loan'>
                                </div> 
                                <div class='form-group col-md-3'>
                                    <label >Personal</label>
                                    <input value='".$row['col_personal']."'  type='text' class='form-control' id='personal' name='personal'  placeholder='Personal'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Charges</label>
                                    <input value='".$row['col_charges']."'  type='text' class='form-control' id='charges' name='charges' placeholder='Charges'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Philcare</label>
                                    <input value='".$row['col_philcare']."'  type='text' class='form-control' id='philcare' name='philcare' placeholder='Philcare'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Other deduction</label>
                                    <input value='".$row['col_other_deduction']."'  type='text' class='form-control' id='other_deduction' name='other_deduction' placeholder='Other deduction'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label >Total deduction</label>
                                    <input value='".$row['col_total_deduction']."'  type='text' readonly  class='form-control' id='total_deduction' name='total_deduction' placeholder='Total deduction'>
                                </div>
                            </div>
                                
                            <br><br>
                            <div class='row'>
                                <div class='form-group col-md-3'>
                                    <label >Net pay</label>
                                    <input value='".$row['col_net_pay']."'  type='text' readonly  class='form-control' id='net_pay' name='net_pay' placeholder='Net pay'>
                                </div> 
                            </div>
                        </div>
                        
                    </form>
                    "; 
                ?>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?> 
<script>  
 
 $('#update').submit(function(e){ 
    var x = $(this).serializeArray();  
    e.preventDefault(); 
    if($('#available_loan').val() < 0){
      alert("You exceed the available employee loan.")
      return;
    }  
    $.ajax({
      type: 'POST',
      url: 'payroll_main_api_edit_item_update.php',
      data: x,
      dataType: "json", 
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
  });

  $(':input').on('change', function(){ 
    calcu();
  });
  available_loan = $('#available_loan').val()
  function calcu(){
    var forms = $('#update').serializeArray();
    for(var i = 0 ; i < forms.length; i++){
        if(forms[i].value ==''){
            $('#'+forms[i].name).val(0);
        }
    } 
    loan=$('#loan').val();
    $('#available_loan').val(available_loan - loan);  
    employee_id =$('#employee_id').val();
    employee_name =$ ('#employee_name').val();
   
    no_days= $('#no_days').val();
    no_hours = $('#no_hours').val();
    rate = $('#rate').val();
    rice_incentive= $('#rice_incentive').val();
    motor_allowance =$ ('#motor_allowance').val();
    salary_advance = $('#salary_advance').val();
    leave = $('#leave').val();
    adjustment= $('#adjustment').val();
 
    sss = $('#sss').val();
    philhealth =$ ('#philhealth').val();
    pagibig= $('#pagibig').val();
    sss_loan = $('#sss_loan').val();
    pagibig_loan = $('#pagibig_loan').val();
    personal = $('#personal').val();
    charges = $('#charges').val();
    philcare = $('#philcare').val();
    other_deduction = $('#other_deduction').val(); 

    gross = $('#gross').val();
    // $('#gross').val(gross.toFixed(2));

    total_gross_pay =parseFloat(rice_incentive)+
    parseFloat(motor_allowance)+ parseFloat(salary_advance)+
    parseFloat(leave) + parseFloat(adjustment)+
    parseFloat(gross) ; 
    $('#total_gross_pay').val(total_gross_pay.toFixed(2));

    taxable_income=parseFloat(gross)+
    parseFloat(salary_advance)+parseFloat(leave);
    $('#taxable_income').val(taxable_income.toFixed(2));

    total_deduction = parseFloat(sss)+parseFloat(philhealth)
    +parseFloat(pagibig)+parseFloat(sss_loan)+parseFloat(pagibig_loan)+
    parseFloat(personal) +parseFloat(charges)+parseFloat(philcare)
    +parseFloat(other_deduction) + parseFloat(loan);

    $('#total_deduction').val(total_deduction.toFixed(2));

    net_pay = parseFloat(total_gross_pay) - parseFloat(total_deduction);
    $('#net_pay').val(net_pay.toFixed(2)); 
  } 
</script>
</body>
</html>


            	