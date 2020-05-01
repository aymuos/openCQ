<?php
require('sender_header.php');

//This file displays all the available exams that can be started
//Proceed to the else part directly.......



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
	$test_id = $_GET['ti'];
	$username = $_GET['un'];
	if($test_id == '-1')$test_id = 'ALL';
	$url="localhost/update1/api/restart_exam.php";
	$data = array(		"key" => key,
						"username" => $_SESSION['usernamecoe'],
						"password" => $_SESSION['passwordcoe'],
						"examId" => $test_id,
						"studentUsername" => $username
					);
	$result = send_post_request($url,$data);
	echo $result;
	
}


?>