<?php

//This file adds new subject/course code selected by the 
//teacher.
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
	
	$code = $_GET["cn"];		//This has the new course code.....Add it to the database
	echo $code;
	
	
	
	
	//uncomment these lines
	//Simply redirects to master dashboard
	header("Location: select_code.php");
	
}

?>