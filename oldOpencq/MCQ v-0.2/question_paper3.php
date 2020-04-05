<?php


//This file takes the question statement and options from the user.
//Please proceed to the else part directly.
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

	$id = $_GET["q"];	//Question id to be deleted
	//echo $id;
	$test_id = $_GET["ti"];     //This is the test id
	
	err("\n$id\n");
	err("\n$test_id\n");
	
	$conn = OpenCon();
	try{
	    /*$query = "SELECT name,url FROM question WHERE id = ?";
		execute($conn,$query,"i",[$id],$stmt);
		$question = get_data($stmt);
		close($stmt);
		err("\ndata extracted\n");*/
		$query = "DELETE FROM exam_question WHERE id = ?";
		execute($conn,$query,"i",[$id],$stmt);
		close($stmt);
		err("\nsuccess\n");
	}
	catch(Exception $e){
		report($e);
	}
	
	
	//Make necessary changes to the DB to delete the question....
	
	
	
	
	
	//Please uncomment these lines...........
	header("Location: question_paper.php?test_id=".$test_id);
	
}

?>