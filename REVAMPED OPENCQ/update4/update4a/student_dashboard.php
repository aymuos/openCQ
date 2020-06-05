<?php
session_start();
require('sender_header.php');
//This is the introduction page. Students selects the subject code here.


if ( isset($_SESSION['loggedinstudent']) == false ){
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
<p class="text-center">Please <a href="smain.html">Login</a> first</p>
</div>
</div>
</body>
</html>


';
}
else {
	
	$username=$_SESSION['usernamestudent'];  
	$api_name="student_info.php";
	$data = array(	"key" => key,
					"username" => $username
				);
	
	$result = send_get_request($url.$api_name,$data);
	$sinfo = json_decode($result);

	// echo $result;
	

	$api_name="exam.php";
	$data = array(	"key" => key,
					"username" => 'ALL',
					"examStatus" => '1',
					"examId" => 'ALL',
					"code" => 'ALL',
					"batchPassoutYear" => 'ALL',
					"stream" => 'ALL',
					"visible" => 'ALL'
				);
	
	$res = send_get_request($url.$api_name,$data);
	$exam = json_decode($res);

	// echo $res;
	
	$_SESSION['name'] = $sinfo->name;
	$_SESSION['username'] = $sinfo->username;
	
	
	echo '
	<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<title>Dashboard</title>
		<link rel="icon" href="img/brandinglogo.png" type="image/icon type">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		
		
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/scrimbacss1.css">

	<script>
		 $(document).ready(function(){
			$(\'select\').formSelect();
		});
		
		var obj = {';
			for($i=0;$i<count($exam->result);$i++){
				echo $exam->result[$i]->id;
				echo ':';
				echo '["';
				echo $exam->result[$i]->paperName;
				echo '",';
				
				echo $exam->result[$i]->{'started at'};
				echo ']';
				if($i+1 != count($exam->result))echo ',';
			}
		echo '}
		
		
		function getName() {
			str = document.getElementById("pcd").value;
			document.getElementById("pnm").value = obj[str][0];
			document.getElementById("cnf").disabled = false;
			
		}
		function new_test(){
			//alert("sds");
			str = document.getElementById("pcd").value;
			window.open("jsWorkpg.php?e="+str+"&t="+obj[str][1], "hello", "channelmode=yes,fullscreen=yes");
		}
		
		
		
		
  </script>
	<script src="js/student_dashboard.js"></script>


	</head>
	<body>
	<div id="initial-head">
	<nav>
				<div class="nav-wrapper orange accent-3 z-depth-4">
					<a href="#" class="brand-logo center ">OpenCQ test Platform</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li> <a class="waves-effect waves-light btn grey darken-4" href="student-details.php">
					Account <i class="material-icons left">person</i></a></li>
					<li> <a class="waves-effect waves-light btn grey darken-4" href="logout.php">
					logout <i class="material-icons right" >navigate_next</i></a></li>
					</ul>
					<div class="tlogo" style=" ">
						<img class="logo" src="img/logo256.png" width="100%" alt="Avatar"></img>  
					</div>		
				</div>
			</nav>
	</div>
	<div class="div-timer"">
        <label class="class-label class1">Name : </label><label class="class-label time">';
		
		
		//Put the students name here............
		echo $sinfo->name;
		
		
		
		echo '</label>
        <label class="class-label class2">Roll No : </label><label class="class-label time">';
		
		
		
		//Put the Students Roll no here.............
		echo $sinfo->username;
		
		
		
		echo '</label>
    </div>
	<div style="width: 800px;margin-left:auto;margin-right:auto;">
	<div style="text-align: center;">
	<h3>Instructions</h3>
	</div>
	<ul>
		<li>1. Please select the Paper Code from the drop down menu and confirm the the paper name.</li>
		<li>2. Click on the start button to start the test.</li>
		<li>3. NOTE: Once the test begins you will have to go full screen mode. Please donot come out of the full screen mode under any circumstances. Violating this rule will automatically end your exam</li>		
	</ul>
	</div>
	
	
	<div style="text-align: center;padding-top: 20px;">
		<form>
			<select id="pcd" class="browser-default" style="width: 400px;margin-left: auto;margin-right: auto;" onChange="getName()">
				<option value="" disabled selected>Select Paper Code</option>';
				
				
				for($i=0;$i<count($exam->result);$i++){


					//$conn = OpenCon();
					
				
					echo '<option value="'.($exam->result[$i]->{'id'}).'">';
					
					
					//Please put the paper code here........
					echo $exam->result[$i]->{'code'};
					
					
					echo '</option>';
					
				}
			echo '</select>
			<div style="padding-top: 30px;">
				<label style="font-size: 15px;color: #000000;">Paper Name : </label>&emsp;
				<input id="pnm" type="text" style="width: 400px;font-size: 20px" value="" readonly>
				<input id="exmid" type="text" style="width: 400px;font-size: 20px" value="" readonly hidden>
			</div>
			<button id="cnf" class="btn" style="margin-top: 25px;" disabled onclick="new_test()">Confirm and Begin Test</button>
		</form>
	</div>

	
	';
	
	
}


?>
	