<?php 
    include 'includes/session.php';
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'addOvertime':
                addOvertime();
                break;
            case 'removeOvertime':
                removeOvertime();
                break;
        }
    }

    function addOvertime() {  
        include 'includes/conn.php';      
        $id = $_POST['id'];
        
        $addovertime = $_POST['addovertime'];
        $numhour = $_POST['numhour'];
        $isovertime_add = 1;

        $final_numhour = $numhour + $addovertime; 
        $sql = "update `attendance` set isovertime_add= $isovertime_add, num_hr = '$final_numhour'
        where id = $id";
      
		if($conn->query($sql)){ 
            $_SESSION['success'] = 'Overtime added'; 
        }else{
            $_SESSION['error'] = $conn->error; 
        }
    }

    function removeOvertime() { 
        include 'includes/conn.php';
        $id = $_POST['id'];

        $removeovertime = $_POST['removeovertime'];
        $numhour = $_POST['numhour'];
        $isovertime_add = 0;

        $final_numhour = $numhour - $removeovertime;
        $sql = "update `attendance` set isovertime_add= $isovertime_add, num_hr = '$final_numhour'
        where id = $id";
		if($conn->query($sql)){ 
            $_SESSION['success'] = 'Overtime removed'; 
        }else{
            $_SESSION['error'] = $conn->error; 
        }
    }
	header('location: attendance.php');
?>