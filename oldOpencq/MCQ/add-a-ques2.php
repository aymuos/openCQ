<?php

//This file will add the question to the database.
//please proceed to the else part directly.
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

	$chname = $_POST["chapter-name"]; //This is the chapter name
	$chid = get_id($chname);  		
	$statement = $_POST["problem-statement"];	//This has the problem statement
	$qid = get_id($statement);
	$co = $_POST["correct"];					//This is the correct option
	$coid = get_id($co);
	$ico1 = $_POST["incorrect1"];				//This is the incorrect option 1
	$icoid1 = get_id($ico1);
	$ico2 = $_POST["incorrect2"];				//This is the incorrect option 2
	$icoid2 = get_id($ico2);
	$ico3 = $_POST["incorrect3"];				//This is the incorrect option 2
	$icoid3 = get_id($ico3);
	$correct = "1";
	$incorrect = "0";
	$conn = OpenCon();
	#mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


	try{
		$conn->autocommit(FALSE);
		try{
			
			$query = "INSERT INTO questions (question_id, question, chapter_id) VALUES (?, ?, ?)";
			execute($conn,$query,"sss",[$qid,$statement,$chid],$stmt);
			close($stmt);
		}
		catch(Exception $e){
			if($conn->errno === 1062){
				echo "Duplicate Question";
			}
			throw $e;
		}
		try{

			$query = "INSERT INTO choices (question_id, choice_id, choice, is_right) VALUES (?, ?, ?, ?)";
			execute($conn,$query,"ssss",[$qid,$coid,$co,$correct],$stmt);
			close($stmt);

			execute($conn,$query,"ssss",[$qid,$icoid1,$ico1,$incorrect],$stmt);
			close($stmt);

			execute($conn,$query,"ssss",[$qid,$icoid2,$ico2,$incorrect],$stmt);
			close($stmt);

			execute($conn,$query,"ssss",[$qid,$icoid3,$ico3,$incorrect],$stmt);
			close($stmt);			
		}
		catch(Exception $e){
			if($conn->errno === 1062){
				echo "Duplicate Choice";
			}
			throw $e;
		}
		$conn->autocommit(TRUE);
		CloseCon($conn);
		header('location: add-a-ques3.php');
	}
	catch(Exception $e){
		$conn->rollback();
		exit($e->getMessage());
	}

	//Add this question to the database here.






	//Redirects to "add-a-ques3.php"
	
}
?>
