<?php
session_start();




//When a student starts the test then this page opens up. Developers
//please see that if test was already created (means the student is entering second time to the test area) 
//then simply redirect to "workpg.php". Else generate the random questions and update the daatbase.
//proceed to the else part directly.



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
	
	
	//If the student if entering first time in the test region then 
	//generate all the random questions here and make necessary changes to
	//the database...else do nothing
	
	
	
	
	//Redirect to "workpg.php"
	header('location: workpg.php');
}

?>