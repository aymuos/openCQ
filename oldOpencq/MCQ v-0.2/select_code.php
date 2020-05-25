<?php

//This file asks the user to enter the subject code...
//Teacher can also add new subjects from here....
//please proceed to the else part directly...

include 'db_connection.php';

include 'select_code_functions.php';


session_start();
if ( isset($_SESSION['loggedinmaster']) == false ){
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
<p class="text-center">Please <a href="master.html">Login</a> first</p>
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
<title>Welcome</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="select_code.css">
		<script>
			function go(){
				var x = document.getElementById("select_ch").value;
				if(x!="-1")
				window.location.href = "add_course.php?cn=" + encodeURIComponent(x); 
			}
			function coder(value){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					myObj = this.responseText;
					document.getElementById("demo").value = this.responseText;
				}
				};
				xmlhttp.open("GET", "server_send_code.php?q=" + encodeURIComponent(value), true);
				xmlhttp.send();
			}
			function coder2(value){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					myObj = this.responseText;
					document.getElementById("demo-modal").value = this.responseText;
				}
				};
				xmlhttp.open("GET", "server_send_code.php?q=" + encodeURIComponent(value), true);
				xmlhttp.send();
			}
		</script>
</head>
<body>
	<div class="some" >
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
				<img class="logo" border="50" src="data/avatar.png" alt="Avatar"></img>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<font face="verdana" color="white" size="6.5px" > Dashboard</font>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Account</a></li>
						<li><a href="master.html"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	
	<h1><b>Please select a course</b></h1>
	
	
	
	<form method="post" action="enter.php">
	
	<div class="selection">
	<label>Paper Code : </label>
        <select class="del-form-control" name="subject-code" onchange="coder(this.value)" required>
			<option value="" disabled selected>-- select an option -- </option>	
		';
		
		
		
		
	//***Please modify this portion to display all the course that A TEACHER HAS ALREADY ENROLLED in the dropdown list.***\\\
	
	$conn = OpenCon();


	$arr = subjects_already_allocated($conn,$_SESSION['usernamemaster']);

	$len = 5;	//"len" contains the total no of course to be displayed.
	foreach($arr as $value){		
		echo '<option>';
		
		
		//Please put the subject code (eg: CS205) in this echo statement.
		echo $value;
		

		
		echo '</option>';
	}		



	echo '	
	</select>
    </div>
	<div class="output">
		<label>Course Selected : </label>
		<input id="demo" class="box" type="text" disabled>
	</div>
	<div class="btn-cont">
		
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="func()">Add a New Course</button>
		<button type="submit" class="btn btn-success">Go</button>
	<div>
	</form>
	
	
	
	
	
	
	
	
	

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Please Select the Course</b></h4>
      </div>
      <div class="modal-body">
		<label>Paper Code : </label>
        <select class="del-form-control" id="select_ch" onchange="coder2(this.value)">
			<option value="-1" selected disabled>------Please Select a Subject Code------</option>
		
		
		';
			
		
		
		
		//Here all the available course id is given.
		//Simply take ALL THE COURSES' CODE from the database and display here.......
		$arr = all_available_subjects($conn);
		
		foreach($arr as $value){

			echo '<option>';
			
			
			//Put the paper/course code here.....
			echo $value;
			
			
			echo '</option>';
			
			
			
		}
		
		//Rest of the part remains same...
		
		
		echo '
		</select>
		<div class="output">
			<label>Course Selected : </label>
			<input id="demo-modal" class="box" type="text" disabled>
		</div>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" onclick="go()">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
	
	
</body>
</html>
';
CloseCon($conn);
}

?>