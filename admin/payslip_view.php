<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) --> 
    <!-- Main content -->
    <section class="content">
    <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Print</button> 
    <?php 
            $sql = "SELECT * FROM `tbl_seasonpayroll` where `col_table_id` = '".$_GET['table_id']."'";
            $query = $conn->query($sql);  
            $count = 0 ;
	        while($row = $query->fetch_assoc()){
                if($count == 3){
                    $count = 0;
                    echo ' <br><br><br><br>';
                }
                echo '
                <h2 align="center">TAP WORLD EXPRESS INC.</h2>
                <h4 align="center">'.$row['col_fromdate']." - ".$row['col_todate'].'</h4>
                <table cellspacing="0" cellpadding="3" style="width: 100%;">  
                     
                    <tr>
                      <td width="25%" align="right">Employee ID: </td>
                      <td width="25%">'.$row['col_employeeid'].'</td>   
                      
                    </tr>
                    
                    <tr>  
                        <td width="25%" align="right">Employee Name: </td>
                         <td width="25%"><b>'.$row['col_employee_lastname']." ".$row['col_employee_firstname'].'</b></td>
                         <td width="25%" align="right">Total Hours: </td>
                         <td width="25%" align="right">'.number_format($row['col_total_hours'], 2).'</td> 
                         
                    </tr>
                    <tr>  
                    <td width="25%" align="right">Department: </td>
                     <td width="25%"><b>'.$row['col_department'].'</b></td>
                     <td width="25%" align="right">Rate per Hour: </td>
                     <td width="25%" align="right">'.number_format($row['col_rate'], 2).'</td>
                    </tr>
                    <tr> 
                        <td></td> 
                        <td></td>
                        <td width="25%" align="right">Total Days: </td>
                        <td width="25%" align="right">'.number_format($row['col_total_days'], 2).'</td> 
                    </tr>
                    <tr> 
                        <td></td> 
                        <td></td>
                         <td width="25%" align="right"><b>Gross Pay: </b></td>
                         <td width="25%" align="right"><b>'.number_format($row['col_total_gross_pay'], 2).'</b></td> 
                    </tr> 
                    <tr> 
                        <td></td> 
                        <td></td>
                         <td width="25%" align="right"><b>Total Deduction:</b></td>
                         <td width="25%" align="right"><b>'.number_format($row['col_total_deduction'], 2).'</b></td> 
                    </tr>
                    <tr> 
                        <td></td> 
                        <td></td>
                         <td width="25%" align="right"><b>Net Pay:</b></td>
                         <td width="25%" align="right"><b>'.number_format($row['col_net_pay'], 2).'</b></td> 
                    </tr>
                </table>
                <br><hr>
                <br>    ' ;
            
            $count ++ ;
            } 
        
        ?>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?> 
</div>
<?php include 'includes/scripts.php'; ?>
<script> 

$(function(){  
  $('#payslip').click(function(e){
      console.log("wqe");
      $(this).hide();
    window.print();
      $(this).show();
  });
});
</script>
</body>
</html>
