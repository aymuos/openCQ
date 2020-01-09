<?php

//This file will add the question to the database.
//please proceed to the else part directly.

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


	$statement = $_POST["problem-statement"];	//This has the problem statement
	$co = $_POST["correct"];					//This is the correct option
	$ico = $_POST["incorrect1"];				//This is the incorrect option 1
	$ico = $_POST["incorrect2"];				//This is the incorrect option 2
	$ico = $_POST["incorrect3"];				//This is the incorrect option 2






	//Add this question to the database here.






	//Redirects to "add-a-ques3.php"
	header('location: add-a-ques3.php');
}
?>
