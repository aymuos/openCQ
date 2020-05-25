<?php

//This file saves the subject/course code selected from existing course code already enrolled by the 
//teacher.Save this in the session so that whenever any change
//is made to the database then the subject code is retrived from the session.
//Proceed to the else part directly.


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
	
	$code = $_POST["subject-code"];		//This is the course code selected by the teacher...
	//echo $code;
	
	$_SESSION["sub_code"] = $code;
	
	
	
	
	include 'db_connection.php';
	include 'server_send_code_functions.php';
	$conn = OpenCon();
	$name = findName($conn,$code);
	$_SESSION["paper_name"] = $name;
	

	CloseCon($conn);
	

	
	//uncomment these lines
	//Simply redirects to master dashboard
	header("Location: master-dashboard.php");
	
}

?>