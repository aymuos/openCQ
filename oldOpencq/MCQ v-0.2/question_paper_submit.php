<?php


//Question paper is submitted ........
//Send the question paper to the COE..........make sure that question paper cannot be modified henceforth.
include 'db_connection.php';

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
	
	$test_id = $_GET["ti"];		//This is the test id......
	
	
	//Make necessary changes in the database........
	$conn = OpenCon();

	try{
		$query = "UPDATE exam SET is_active = '2' WHERE id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		close($stmt);
	}
	catch(Exception $e){
		report($e);
	}
	
	
	header("Location: teacher_test_view.php");
	
}


?>