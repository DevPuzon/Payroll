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
        Deduction List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Deductions</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- <div class="box-header with-border">
               <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div> -->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Employee ID</th> 
                  <th>Name</th>
                  <th>SSS</th>
                  <th>PhilHealth</th>
                  <th>Pagibig</th>
                  <th>SSS loan</th>
                  <th>Pagibig loan</th> 
                  <th>Tools</th> 
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM `tbl_deduction` left join employees on employees.employee_id = tbl_deduction.col_employeeid";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['employee_id']; ?></td>
                          <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                          <td><?php echo $row['col_sss']; ?></td>
                          <td><?php echo $row['col_philhealth']; ?></td>
                          <td><?php echo $row['col_pagibig']; ?></td>
                          <td><?php echo $row['col_sss_loan']; ?></td>
                          <td><?php echo $row['col_pagibig_loan']; ?></td>
                          
                          <td>
                            <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['col_deductionid']; ?>"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $row['col_deductionid']; ?>"><i class="fa fa-trash"></i> Delete</button>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   


  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/deduction_main_modal.php'; ?>
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
      console.log('delete');
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  }); 

function getRow(id){
      console.log(id);
  $.ajax({
    type: 'POST',
    url: 'deduction_main_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log(response.col_deductionid);
      
      $('.col_deductionid').val(response.col_deductionid);
      $('.col_employeeid').html(response.col_employeeid);
      $('.del_employee_name').html(response.firstname+' '+response.lastname);

      $('.edit_col_deductionid').val(response.col_deductionid);
      $('#edit_employee_id').val(response.col_employeeid);
      $('#edit_sss').val(response.col_sss);
      $('#edit_philhealth').val(response.col_philhealth);
      $('#edit_pagibig').val(response.col_pagibig);
      $('#edit_sss_loan').val(response.col_sss_loan);
      $('#edit_pagibig_loan').val(response.col_pagibig_loan); 
    }
  });
}
</script>
</body>
</html>
