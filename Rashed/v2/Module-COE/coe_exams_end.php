<?php


//This file ends the running exams.....
//Please proceed to the else part directly.



session_start();
if ( isset($_SESSION['loggedincoe']) == false ){
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
			<p class="text-center">Please <a href="coe-login.html">Login</a> first</p>
		</div>
	</div>
</body>
</html>
';
}
else {

	$test_id = $_GET["ti"];		//This contains test id. NOTE: if $test_id is -1, then end all the exams.....
	

	
	if($test_id == -1){
		//End all the exams
	}
	else{
		//End the exam with id $test_id
		
	}
	
	
	//Simply redirects to running exam page
	header("Location: coe_exams_present.php");
	
	
	
}



?>