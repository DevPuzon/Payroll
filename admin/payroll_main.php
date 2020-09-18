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
        Payroll
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payroll</li>
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
     
<table id="toexcel"  rules="groups" frame="hsides" style="visibility: collapse;"> 
    <tr> 
        <th>TAPWORLD EXPRESS INC.</th>  
    </tr> 
    <tr> 
        <th>PARAÑAQUE CITY, MANILA	</th>  
    </tr>
    <tr> 
        <th>PAYROLL COVERED</th>  
    </tr>
    <tr>
        <th>Employee ID</th>
        <th>Employee Name</th>
        <th>Department</th>
        <th>No. of days</th>
        <th>No. of hours</th>
        <th>Rate per hour</th>
        <th>Rate per month</th>
        <th>Default overtime hour/s</th>
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
        <th>Employee Loan </th>
        <th>Personal</th>
        <th>Charges</th>
        <th>PhilCare</th>
        <th>Other deduction</th>
        <th>Total deduction</th>
        <th>Net Pay</th>
        <th>SIGNATURE</th>
    </tr>   
   
    <?php  
      $sql = "SELECT * FROM `tbl_seasonpayroll` where `col_table_id` = '".$_GET['table_id']."'";
      $query = $conn->query($sql); 
      while($row = $query->fetch_assoc()){
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
        $otherDeduc = $row['col_other_deduction']; ;

        $totalDeduc = $row['col_total_deduction']; ;

        $netPay = $row['col_net_pay'];  
        echo "
          <tr>
            <td>".$empid."</td> 
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
    <tr></tr>
    <tr></tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

      <td><b>Total deduction</b></td>
      <td><b>Total net pay</b></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <?php
        $sql = "SELECT * FROM `tbl_seasonpayroll` where `col_table_id` = '".$_GET['table_id']."'";
        $query = $conn->query($sql); 
        $totalDeduc =0;
        $netPay =0;
        while($row = $query->fetch_assoc()){
          $totalDeduc =$totalDeduc+ $row['col_total_deduction']; 
          $netPay =$netPay+ $row['col_net_pay'];  
        }
        echo "<td>".number_format($totalDeduc, 2)."</td>
        <td>".number_format($netPay, 2)."</td>";
      ?>
      
    </tr>
    <tr></tr>
    <tr>
      <td>
        PREPARED BY:
      </td>
      <td>
        
      </td>
      <td>
        
      </td>
      <td>
        
      </td>
      <td>
        APPROVED BY:		
      </td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
      <td>
        CHERRY P. CENIZA		
      </td>
      <td>
        
      </td>
      <td>
        
      </td>
      <td>
        
      </td>
      <td>
        HAZEL M. TAYAO		
      </td>
    </tr>
    <tr>
      <td>
        HR AND ACCOUNT OFFICER		
      </td>
      <td>
        
      </td>
      <td>
        
      </td>
      <td>
        
      </td>
      <td>
        PRESIDENT				
      </td>
    </tr>
    </table>
    
          <h3 id="markapproved" class="text-danger" hidden>Mark as approved</h3>
          <div class="box">
            <div class="box-header with-border">
              <a id="addnew" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus "></i> Add new </a>
              <a id="delete" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash "></i> Delete </a>
              <a id="edit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-pencil "></i> Edit </a>
             
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payForm"> 
                  <select class="form-control" name="selecpayroll" id="selecpayroll" > 
                  
                  <?php
                    $sql = "SELECT * FROM `tbl_seasonpayroll` GROUP by col_table_id order by col_fromdate desc";
                    $query = $conn->query($sql); 
                    while($row = $query->fetch_assoc()){
                      if($_GET['table_id'] == $row['col_table_id']){
                        echo "<option selected value='".$row['col_table_id']."'> ".$row['col_fromdate'] ."  -  ". $row['col_todate']."</option>";
                      }else{
                        echo "<option value='".$row['col_table_id']."'> ".$row['col_fromdate'] ."  -  ". $row['col_todate']."</option>";
                      }
                    }
                  ?>
                  </select> 
                  <?php  
                    $sql = "SELECT * FROM `tbl_seasonpayroll` GROUP by col_table_id order by col_fromdate desc";
                    $query = $conn->query($sql); 
                    $row = $query->fetch_assoc();  
                    // if($row['col_table_id'] != '' && $_GET['table_id'] == null ){
                    //   // echo  $row['col_table_id'];
                    //   echo "<script>window.location.href = 'payroll_main.php?table_id=".$row['col_table_id']."'</script>";
                    // } 
                    if($row['col_markapproved'] == 1){
                        echo "
                        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
                        <script>
                        $(function(){
                          $('#markapproved').show();
                          $('#btn_markapproved').html('Mark as unapproved');
                        });
                        </script>";
                    }
                    ?>
                  <button type="button" class="btn btn-success btn-sm btn-flat" onclick="tableToExcel('toexcel')"><span class="glyphicon glyphicon-print"></span> Payroll</button>
                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Payslip</button>
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
                        <th>Default overtime hour/s</th>
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
                          <td>".$empid."</td> 
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<?php include 'includes/scripts.php'; ?> 
<script> 

$('#delete').click(function(e){ 
    var tbl_id = location.search.split('table_id=')[1];
    $.ajax({
      type: 'POST',
      url: 'payroll_main_api_delete.php',
      data: {tbl_id:tbl_id},  
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
    
  
  $('#selecpayroll').change(function(e){
    window.location.href = "payroll_main.php?table_id="+this.value;
  });
  $('#edit').click(function(e){
    var tbl_id = location.search.split('table_id=')[1];
    window.location.href = "payroll_main_edit.php?table_id="+tbl_id;
  });
  $('#addnew').click(function(e){
    window.location.href = "payroll_main_add.php";
  });
 

  $('#payroll').click(function(e){
    // e.preventDefault();
    // $('#payForm').attr('action', 'payroll_generate.php');
    // $('#payForm').submit();
    exportReportToExcel();
  });

  $('#payslip').click(function(e){
    // e.preventDefault();
    // $('#payForm').attr('action', 'payslip_generate.php');
    // $('#payForm').submit();  
    tableid = location.search.split('table_id=')[1]
    window.location.href = 'payslip_view.php?table_id='+tableid;
  }); 
  function exportReportToExcel() {
    let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
    TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
      name: `export.xlsx`, // fileName you could use any name
      sheet: {
        name: 'Sheet 1' // sheetName
      }
    });
  }    
  function fnExcelReport()
    {
      console.log('fnExcelReport');
      var tab_text="<table border='2px'><tr bgcolor='#D9E1F2'>";
      var textRange; var j=0;
      tab = document.getElementById('example1'); // id of table

      for(j = 0 ; j < tab.rows.length ; j++) 
      {     
          tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
          //tab_text=tab_text+"</tr>";
      }

      tab_text=tab_text+"</table>";
      tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
      tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
      tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

      var ua = window.navigator.userAgent;
      var msie = ua.indexOf("MSIE "); 

      if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
      {
          txtArea1.document.open("txt/html","replace");
          txtArea1.document.write(tab_text);
          txtArea1.document.close();
          txtArea1.focus(); 
          sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
      }  
      else                 //other browser not tested on IE 11
          sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

      return (sa);
    }

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
<script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table) {
    var name = $("#selecpayroll :selected").text(); 
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>

</body>
</html>
