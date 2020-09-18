<?php session_start(); ?>
<?php include 'header.php'; ?>
<body class="hold-transition login-page">

<style>
#my_camera{
 width: 320px;
 height: 240px;
 border: 1px solid black;
}
</style> 
<script type="text/javascript" src="webcamjs/webcam.min.js"></script>
<div class="login-box">
  	<div class="login-logo">
  		<p id="date"></p>
      <p id="time" class="bold"></p>
  	</div>
  
  	<div class="login-box-body">
 	<h4 class="login-box-msg">WELCOME TO TAP WORLD EXPRESS INC.</h4>   
   <h4 class="login-box-msg">Enter Employee ID</h4>

    	<form id="attendance" method="post" action="" enctype="multipart/form-data"  >
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">Time In</option>
              <option value="out">Time Out</option>
            </select>
          </div>
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control input-lg" id="employee" name="employee" required>
        		<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      		</div>
          <div class="form-group">
            <label for="desc">Description</label>
            <textarea required  class="form-control" id="desc"  name="desc" rows="3"></textarea>
          </div>
                <!-- <div class="form-group">
                  <input type="file" class="form-control-file" 
                  id="proof" name="proof">
                  <label for="proof">Proof</label>
                </div> -->
                
              <!-- <div class="col-sm-9">
                <input type="file" name="proof" id="proof" >
              </div>
              <label for="proof" class="col-sm-3 control-label">Proof</label>  -->
              
            <div id="my_camera"></div>
            <input type=button value="Take Snapshot" onClick="take_snapshot()"> 
            <div id="results" ></div> 
          <div class="container">
            <div class="row justify-content-between">
              <div class="col-xs-4">
              </div>
              <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Sign In</button>
              </div>
            </div>
          </div>
    	</form>
  	</div> 

		<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
  		
</div>  

<?php include 'scripts.php' ?>
<script type="text/javascript">

Webcam.set({  
  image_format: 'jpeg',
  jpeg_quality: 480
});
Webcam.attach( '#my_camera' );  
function take_snapshot() { 
  Webcam.snap( function(data_uri) { 
    console.log(data_uri);
  document.getElementById('results').innerHTML = 
  '<img id="imgid" src="'+data_uri+'"/>';
  } );
}

var interval = setInterval(function() {
  var momentNow = moment();
  $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
  $('#time').html(momentNow.format('hh:mm:ss A'));
}, 100);

$('#attendance').submit(function(e){ 
  e.preventDefault(); 
  var img = $('#imgid').prop('src');
  console.log(img);
  if(!img){
    //null image
    console.log("imgnull");
    alert('Please take a photo');
    return
  } 
  var attendance = new FormData(this);   
  attendance.append("img", img); 
  console.log(attendance); 
  $.ajax({
    type: 'POST',
    url: 'attendance.php',
    data: attendance,
    dataType: "json",
    contentType: false,
    processData: false,
    success: function(response){
    console.log('response');
    console.log(response);
    console.log("res"+response.error);
    if(response.error){
    $('.alert').hide();
    $('.alert-danger').show();
    $('.message').html(response.message);
    }
    else{
    $('.alert').hide();
    $('.alert-success').show();
    $('.message').html(response.message);
    $('#employee').val('');
    }
    },error: function(err){
    console.log(err);
    }
  });
});
</script>
</body>
</html>