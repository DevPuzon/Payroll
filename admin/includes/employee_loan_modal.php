<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Employee Loan</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_loan_add.php">
          		  <div class="form-group">
                  	<label for="employee_id" class="col-sm-3 control-label">Employee Id</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="employee_id" name="employee_id" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Loan</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="loan" name="loan" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
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
            	<h4 class="modal-title"><b>Update Employee Loan</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_loan_edit.php"> 
                <div class="form-group">
                    <label for="edit_employee_id" class="col-sm-3 control-label">Employee Id</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_employee_id" readonly name="employee_id">
                    </div>
                </div>
				<div class="form-group">
                    <label for="edit_employee_name" class="col-sm-3 control-label">Employee Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_employee_name" readonly name="employee_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_employee_loan" class="col-sm-3 control-label">Loan</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_employee_loan" name="loan">
                    </div>
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

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_loan_delete.php">
            		<input type="hidden" id="del_employee_id" name="employee_id">
            		<div class="text-center">
	                	<p>DELETE</p>
	                	<h2 id="del_employee_name" class="bold"></h2>
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


     