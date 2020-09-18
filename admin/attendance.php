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
        Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance</li>
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
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              <div class="pull-right">
                <input id="search_date" type="date" 
                onchange="changeDate('search_date')" 
                class="form-control pull-right col-sm-8"
                value="<?php echo $_GET['date']?>">
              </div>
            </div> 
            <div class="box-body">
              <div class="table-wrapper-scroll-y my-custom-scrollbar">

              <table id="example1" class="table table-bordered table-striped mb-0">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Description Time In</th>
                  <th>Proof Time In</th>
                  <th>Time In</th>
                  <th>Description Time Out</th>
                  <th>Proof Time Out</th>
                  <th>Time Out</th>
                  <th>Number of hours</th>
                  <th>Over time (hour/s)</th>
                  <th>Late (minute/s)</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    if(!$_GET['date']){
                      $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ORDER BY attendance.date DESC, attendance.time_in DESC ";
                    }else{
                      $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id where date = '".$_GET['date']."' ";
                    } 
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){ 
                      $status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                      $isOverTimeAdded = ($row['isovertime_add'])?'<span style="cursor:pointer" 
                      data-action="removeOvertime"
                      data-id='.$row['attid'].' 
                      data-numhour='.$row['num_hr'].'
                      data-removeovertime='.$row['overtime'].'
                       name="removeOvertime" value="removeOvertime" class="buttonovertime label label-success pull-right">Remove overtime</span>':
                      '<span  style="cursor:pointer"  
                      data-numhour='.$row['num_hr'].'
                      data-id='.$row['attid'].' 
                      data-action="addOvertime" 
                      data-addovertime='.$row['overtime'].'
                      name="addOvertime" value="addOvertime" 
                      class="buttonovertime label label-primary pull-right">Add overtime</span>';
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['date']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".$row['description']. "</td>
                          <td><a href=../images/".$row['proofimg']."  target='_blank'>View image</a></td>
                          <td>".date('h:i A', strtotime($row['time_in'])).$status."</td>
                          <td>".$row['description_out']. "</td>
                          <td><a href=../images/".$row['proofimg_out']."  target='_blank'>View image</a></td>
                          <td>".date('h:i A', strtotime($row['time_out']))."</td>
                          <td>".$row['num_hr']. "</td>
                          <td>".$row['overtime']. $isOverTimeAdded."</td>
                          <td>".$row['late']."</td>
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit'  data-id='".$row['attid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm btn-flat delete'  data-id='".$row['attid']."'><i class='fa fa-trash'></i> Delete</button>
                          </td>
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
  <?php include 'includes/attendance_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
function changeDate(e){ 
  var input = document.getElementById(e).value;
  window.location.href = "attendance.php?date="+input;
} 
function onEdit(id){
  console.log("onEdit");
  console.log(id);
}
function onDelete(id){
  console.log("onDelete");
  console.log(id);
}

$('.edit').click(function(e){
  e.preventDefault();
  console.log('edit');
  $('#edit').modal('show');
  var id = $(this).data('id');
  getRow(id);
});

$('.delete').click(function(e){
  e.preventDefault();
  console.log('delete');
  $('#delete').modal('show');
  var id = $(this).data('id');
  getRow(id);
});

$('.buttonovertime').click(function(){
    console.log('buttonovertime');
    var clickBtnValue = $(this).val();
    // var ajaxurl = 'ajax.php';
    var data =  {
      'action': $(this).data('action'),
      'id': $(this).data('id'),
      'numhour':$(this).data('numhour'),
      'removeovertime': $(this).data('removeovertime'),
      'addovertime': $(this).data('addovertime'),
    };
    console.log(data);
    $.ajax({
      type: 'POST',
      url: 'attendance_overtime.php',
      data: data, 
      success: function(response){
        // console.log(response);
        window.location.reload();
      }
    });
});
    
function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
} 

</script>
</body>
</html>
