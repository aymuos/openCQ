<?php
include 'db_connection.php';

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
	$updated_chapter = $_POST["chapter-del"];	//chapter's name of the question
	$updated_problem = $_POST["mod_stat"];		//problem statement to be deleted
	$updated_correct = $_POST["cropt"];			//correct option
	$updated_incorrect1 = $_POST["incropt1"];	//incorrect option 1
	$updated_incorrect2 = $_POST["incropt2"];	//ncorrect option 2
	$updated_incorrect3 = $_POST["incropt3"];	//incorrect option 3

	
	
	
	//Make necessary changes in the database here............
	$conn = OpenCon();
	try{
		$query = "DELETE FROM questions WHERE question_id = ?";
		execute($conn,$query,"s",[$id],$stmt);
		close($stmt);

	}
	catch(Exception $e){
		report($e);
		exit("error");
	}
	

	
	CloseCon($conn);
	
	//Redirects to "del-a-ques5.php"
	header('location: del-a-ques5.php');
}

?>
