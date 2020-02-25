<?php


//This file takes the question statement and options from the user.
//Please proceed to the else part directly.



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
	
	$test_id = $_GET["ti"]; //This is the test id.......
	$ch = $_GET["ch"];		//This is the chapter's name.............
	
	
	
	
	$n = 10;  //put no of questions in this chapter here.........
	
	for($i=1;$i<=$n;$i++){
		if($_GET["q".$i] != -1){
			//Add this question to the db.....
			$ques_id = $_GET["q".$i];
			
			
			
		}
	}
	



	//Uncomment these lines..........
	header("Location: question_paper.php?test_id=".$test_id);
	
}


?>
