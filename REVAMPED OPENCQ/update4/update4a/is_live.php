<?php

	require('sender_header.php');

session_start();
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



	$test_id = $_SESSION['ti'];

	$api="is_live_exam.php";
	$data = array(		"key" => key,
						"examId" => $test_id
					);
	$result = send_get_request($url.$api,$data);
	echo $result;
	
}
?>





