<!-- Add -->
<div class="modal fade" id="addnew">
    <!-- <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Employee</b></h4>
          	</div>
          	<div class="modal-body">
            	<form id="addnewform" name="addnewform" >
          		  <div class="form-group">
                <label for="employee_id" class="col-sm-3 control-label">Employee Id</label>

                <div class="col-sm-9">
                    <input type="text" disabled class="form-control" id="employee_id" name="employee_id" >
                </div>
                </div>
                
                <div class="form-group">
                    <label for="sss" class="col-sm-3 control-label">SSS</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="sss" name="sss" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="philhealth" class="col-sm-3 control-label">PhilHealth</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="philhealth" name="philhealth" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="pagibig" class="col-sm-3 control-label">Pagibig</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="pagibig" name="pagibig" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="sss_loan" class="col-sm-3 control-label">SSS Loan</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="sss_loan" name="sss_loan" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="pagibig_loan" class="col-sm-3 control-label">Pagibig Loan</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="pagibig_loan" name="pagibig_loan" >
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div> -->
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="col_deductionid"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="deduction_main_delete.php">
            		<input type="hidden" class="col_deductionid" name="deduction_id">
            		<div class="text-center">
	                	<p>DELETE ITEM</p>
	                	<h2 class="bold del_employee_name"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div> 
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button> 
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="deduction_main_edit.php">
            		<input type="hidden" class="edit_col_deductionid" name="edit_col_deductionid">
              
          		  <div class="form-group">
                <label for="edit_employee_id" class="col-sm-3 control-label">Employee Id</label>

                <div class="col-sm-9">
                    <input type="text" disabled class="form-control" id="edit_employee_id" name="edit_employee_id" >
                </div>
                </div>
                
                <div class="form-group">
                    <label for="edit_sss" class="col-sm-3 control-label">SSS</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_sss" name="edit_sss" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_philhealth" class="col-sm-3 control-label">PhilHealth</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_philhealth" name="edit_philhealth" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_pagibig" class="col-sm-3 control-label">Pagibig</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_pagibig" name="edit_pagibig" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_sss_loan" class="col-sm-3 control-label">SSS Loan</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_sss_loan" name="edit_sss_loan" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_pagibig_loan" class="col-sm-3 control-label">Pagibig Loan</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_pagibig_loan" name="edit_pagibig_loan" >
                    </div>
                </div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="employee_edit_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script type="text/javascript">
  $(function() { 
    var id = getRanChar(1)+getRanNum(3); 
    $("#employee_id").val(id);


    $('#addnewform').submit(function(e){
      // e.preventDefault(); 
      var form = new FormData(this);  
      form.append("employee_id", id); 
        // dataType: "json",
      $.ajax({
        type: 'POST',
        url: 'employee_add.php',
        data: form,
        contentType: false,
        processData: false,
        success: function(response){
          // console.log("res"+response); 
        } 
      });
    });
    
  });
  function getRanChar(length) {  
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   } 
   return result;
  } 
  function getRanNum(length) { 
     
   var result           = '';
   var characters       = '123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
  } 
</script> -->