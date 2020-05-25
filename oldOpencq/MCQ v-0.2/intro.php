<?php
session_start();

//This is the introduction page. Students selects the subject code here.
include 'db_connection.php';

if ( isset($_SESSION['loggedin']) == false ){
echo ' 

<html>
<head>
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
	echo '
	<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<title>Test Page</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="scrimbacss1.css">

	<script>
		 $(document).ready(function(){
			$(\'select\').formSelect();
		});
		
		function getId(){
			str = document.getElementById("pcd").value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("exmid").value = this.responseText;
					document.getElementById("cnf").disabled= false;
				}
			};
			xmlhttp.open("GET", "server_send_exam_id.php?q=" + encodeURIComponent(str), true);
			xmlhttp.send();
		}
		
		
		function getName() {
			getId();
			str = document.getElementById("pcd").value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("pnm").value = this.responseText;
				}
			};
			xmlhttp.open("GET", "server_send_code.php?q=" + encodeURIComponent(str), true);
			xmlhttp.send();
		}
		
  </script>



	</head>
	<body>
	<div id="initial-head">
	<nav>
		<div class="nav-wrapper orange accent-3 z-depth-4">
			<a class="brand-logo center ">OpenCQ test Platform</a>
			<div class="tlogo" style=" ">
				<img class="logo" src="logo256.png" width="100%" alt="Avatar"></img>  
			</div>		
		</div>
	</nav>
	</div>
	<div class="div-timer"">
        <label class="class-label class1">Name : </label><label class="class-label time">';
		$conn = OpenCon();
		try{
			$query = "SELECT * FROM student WHERE id = ?";
			execute($conn,$query,"s",[$_SESSION['username']],$stmt);
			$student = get_data($stmt);
			close($stmt);


			$query = "SELECT * FROM exam WHERE is_active = '1'";
			execute($conn,$query,"",[],$stmt);
			$exam = get_data($stmt);
			close($stmt);

		}
		catch(Exception $e){
			report($e);
		}
		
		//Put the students name here............
		echo $student[0]['name'];
		
		
		
		echo '</label>
        <label class="class-label class2">Roll No : </label><label class="class-label time">';
		
		
		
		//Put the Students Roll no here.............
		echo $student[0]['id'];
		
		
		
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
		<form method="post" action="jsWorkpg.php">
			<select name="pCode" id="pcd" class="browser-default" style="width: 400px;margin-left: auto;margin-right: auto;" onChange="getName()">
				<option value="" disabled selected>Select Paper Code</option>';
				
				
				foreach($exam as $value){

					//$conn = OpenCon();
					
				
					echo '<option>';
					
					
					//Please put the paper code here........
					echo $value['subject_id'];
					
					
					echo '</option>';
					
				}
			echo '</select>
			<div style="padding-top: 30px;">
				<label style="font-size: 15px;color: #000000;">Paper Name : </label>&emsp;
				<input id="pnm" name="pName" type="text" style="width: 400px;font-size: 20px" value="" readonly>
				<input id="exmid" name="examId" type="text" style="width: 400px;font-size: 20px" value="" readonly hidden>
			</div>
			<button id="cnf" type="submit" class="btn" style="margin-top: 25px;" disabled>Confirm and Begin Test</button>
		</form>
	</div>
	
	
	';
	
	
}


?>
	