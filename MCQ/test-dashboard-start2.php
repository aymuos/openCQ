<?php
include 'db_connection.php';

session_start();





//Test id will be provided. Please start the corresponding test.
//Proceed to the else part directly.





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
	

	$test_id = $_POST["ti"];	//Contains test id to start a test
	
	
	
	
	//Make necessary changes in the database here..............
	$conn = OpenCon();

	try{
		$query = "SELECT * FROM exam WHERE is_active = '1'";
		execute($conn,$query,"",[],$stmt);
		$live=get_data($stmt);
		close($stmt);
		if($live){
			exit("An exam is already live");
		}
		$query = "UPDATE exam SET is_active = '1' WHERE exam_id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		close($stmt);
	}
	catch(Exception $e){
		report($e);
		exit("error");
	}
	
	CloseCon($conn);
	//Simply redirects to test-dashboard-start3.php
	header("Location: test-dashboard-start3.php");
}	
?>
	