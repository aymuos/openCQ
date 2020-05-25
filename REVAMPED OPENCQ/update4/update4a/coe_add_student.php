<?php

require('sender_header.php');
//This displays the running exams..........
//Proceed to the else part directly.......



session_start();
if ( isset($_SESSION['loggedincoe']) == false ){
echo ' 
<html>
<head>
<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <title>Oops!!!</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>
<body>
	<div class="well-lg">
		<div class="alert alert-danger">
			<p class="text-center">Please <a href="coe-login.html">Login</a> first</p>
		</div>
	</div>
</body>
</html>
';
}
else {

	

$url=location."student_group_info.php";
$data = array(		"key" => key,
					"stream" => 1,
					"batch_passout_year" => 1,
					"joining_year" => 1,
				);
$result = send_get_request($url,$data);

//echo $result;

$ans = json_decode($result);

echo '

<html>
	<head>
	<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
		<title>COE Dashboard</title>
		
		
		
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- BOOTSTRAP AND MATERIALIZE LIBRARIES-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
    	<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    	<!-- Compiled and minified JavaScript -->
		<!-- end of bootstrap materialize libraries//  create provision for user css-->       
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
		
		
	
		
		<!--user css-->
        <link rel="stylesheet" type="text/css" href="css/temp.css">
		
		
		
		
		
		
<script>
(function ($) {
    $(function () {

        //initialize all modals           
        $(\'.modal\').modal();



        //or by click on trigger
        $(\'.trigger-modal\').modal();

    }); // end of document ready
})(jQuery); // end of jQuery name space
	$(document).ready(function(){
    $(\'select\').formSelect();
  });


	function addition(){
		M.toast({html: "Please Wait! :)", classes: \'rounded\'});
		var roll = $("#roll").val();
		var regExRoll = new RegExp("GCECT[B|M]-[R|L][0-9][0-9]-[1-3][0-9][0-9][0-9]");
		if(!regExRoll.test(roll) || roll.length != 15){
			M.toast({html: "Invalid Roll No! :(", classes: \'rounded\'});
			console.log("over");
			return;
		}
		var year = $("#year").val();
		regExRoll = new RegExp("20[0-9][0-9]");
		if(!regExRoll.test(year) || year.length != 4){
			M.toast({html: "Invalid Registration Year! :(", classes: \'rounded\'});
			console.log("over");
			return;
		}
		var stream = $("#stream").val();
		var name = $("#name").val();
		var pass = $("#psw").val();
		console.log(stream);
		console.log(name);
		$.post("coe_add_student_send.php",
			{
				sroll: roll,
				sname: name,
				sstream: stream,
				syear: year,
				spassword: pass
			},
			function(data, status){
				console.log(data);
				var res = JSON.parse(data);
				if(res.status == "OK"){
					M.toast({html: "Student added successfully! :)", classes: \'rounded\'});
					$("#roll").val("");
					$("#year").val("");
					$("#psw").val("");
					$("#name").val("");
					
				}
				else{
					M.toast({html: res.comment+"! :(", classes: \'rounded\'});
				}
		});
	}
	
	
	
	
	
	

	
</script>
	</head>
	<body>
		<div class="heading">
			<div class="left-logo">
				<img src="img/logo256.png" class="ing">
			</div>
			<label class="writing">Controller of Examination</label>
			<div class="right-logo">
				<a class="ing2" href="logout.php"><i class="material-icons left">input</i>Logout</a>
			</div>
		</div>
	
	
    <div class="container z-depth-5 white" style="background-color: #e6e6e6;width: 90%">
		<div class="row" style="padding-top: 30px">
			<div class="col s12">
				<span  style="font-size: 32px;color: orange"><b>Add Details</b><span>
			</div>
		</div>
		<div class="row">
			<div class="col s0">
			</div>
			<div class="input-field col s3">
				<input id="roll" type="text" class="validate">
				<label for="roll">Roll No</label>
			</div>
			<div class="input-field col s3">
				<input id="name" type="text" class="validate">
				<label for="name">Name</label>
			</div>
			<div class="input-field col s1">
				<select id="stream">
					<option value="CSE">CSE</option>
					<option value="IT">IT</option>
					<option value="CT">CT</option>
				</select>
				<label>Stream</label>
			</div>
			<div class="input-field col s1">
				<input id="year" type="number" class="validate">
				<label for="year">Pass Out Year</label>
			</div>
			
			<div class="input-field col s2">
				<input id="psw" type="text" class="validate">
				<label for="psw">Password</label>
			</div>
			<div class="input-field col s1" style="margin-top: -20px">
				<button class="btn green" onclick="addition()">Add</button>
			</div>
		</div>
		
		
		
		
		
		
		<div class="row" style="padding-top: 00px">
			<div class="col s12">
				<span  style="font-size: 32px;color: red">--OR--<span>
			</div>
		</div>
		<div class="row" style="padding-top: 00px">
			<div class="col s12">
				<span  style="font-size: 32px;color: orange"><b>Upload a CSV File</b><span>
			</div>
		</div>
		<form action="coe_add_student_csv.php" method="POST" enctype="multipart/form-data">
		<div class="row" >
			<div class="col s2">	
			</div>
			<div class="file-field input-field col s6">
				<div class="btn blue">
					<span>File</span>
					<input type="file" name="csvFile">
				</div>
				<div class="file-path-wrapper" style="padding-top: 40px">
					<input class="file-path validate" type="text">
				</div>
			</div>
			<div class="col s1">
				<button type="submit" class="btn green">Upload</button>
			</div>
			<div class="col s1">
				<a class="waves-effect waves-light btn modal-trigger orange" href="#modal1">Help</a>
			</div>
			</form>
			
			
		</div>
		<div class="row" style="padding-bottom: 100px">
					<div class="col s12">
						<a class="btn red" href="coe_view_students.php">Back</a>
					</div>
				</div>
		
	</div>
	
	
	
	
	
	
	
	
	
	
	
	<div id="modal1" class="modal" style="width: 80%">
    <div class="modal-content">
      <h4>Format of the file</h4>
      <p>The extension of the file should be .csv only. The first row will contain the heading and
	  will comprise of 5 columns i.e. <b>email</b>, <b>name</b>, <b>roll</b>, <b>stream</b> and <b>pass out year</b> followed by one or more 
	  rows containing the details of the students. Please look at the image below for the sample. The
	  username of the student will be his/her roll no and the password will be the email provided. The 
	  roll should be strictly of the format GCECT[B/M]-[R/L]XX-XXXX and the stream has to be one of CSE, CT or IT.</p>
	  <img src="img/sample.jpg">
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
    </div>
  </div>
	
	
	
	
	
	
	
	
	
	
	
	





</body>


';


}

?>