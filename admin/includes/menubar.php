<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTS</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="header">MANAGE</li>
        
        <li><a href="attendance.php"><i class="fa fa-calendar"></i> <span>Attendance</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Employees</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="employee.php"><i class="fa fa-circle-o"></i> Employee List</a></li>
            <li><a href="employee_loan.php"><i class="fa fa-circle-o"></i> Employee Loan</a></li>
            <!-- <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Overtime</a></li> -->
            <!-- <li><a href="cashadvance.php"><i class="fa fa-circle-o"></i> Cash Advance</a></li> -->
            <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Schedules</a></li>
            <li><a href="deduction_main.php"><i class="fa fa-circle-o"></i> Deductions</a></li>
          </ul>
        </li>
        <!-- <li><a href="deduction.php"><i class="fa fa-file-text"></i> Deductions</a></li> -->
        <li><a href="position.php"><i class="fa fa-suitcase"></i> Positions</a></li>
        <li><a href="department_main.php"><i class="fa fa-building-o"></i> Department</a></li>
        <li class="header">PRINTABLES</li>
        
        <?php  
            $sql = "SELECT * FROM `tbl_seasonpayroll` GROUP by col_table_id order by col_fromdate desc";
            $query = $conn->query($sql); 
            $row = $query->fetch_assoc();  
            echo "<li><a href='payroll_main.php?table_id=".$row['col_table_id']."'><i class='fa fa-files-o'></i> <span>Payroll</span></a></li> ";
          ?> 
        <li><a href="schedule_employee.php"><i class="fa fa-clock-o"></i> <span>Schedule</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>