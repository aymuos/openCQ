<?php
session_start();




//This file will actually update the database.Proceed to the else part.







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

	$id = $_POST["ques_id"];					//question id
	$updated_chapter = $_POST["chapter-del"];	//modified chapter's name
	$updated_problem = $_POST["mod_stat"];		//modified problem statement
	$updated_correct = $_POST["cropt"];			//modified correct option
	$updated_incorrect1 = $_POST["incropt1"];	//modified incorrect option 1
	$updated_incorrect2 = $_POST["incropt2"];	//modified incorrect option 2
	$updated_incorrect3 = $_POST["incropt3"];	//modified incorrect option 3

	
	
	
	//Make necessary changes in the database here............
	
	
	
	
	//Redirects to "mod-a-ques5.php"
	header('location: mod-a-ques5.php');
}

?>
