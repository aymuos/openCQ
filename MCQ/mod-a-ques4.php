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
	echo $id;
	$updated_chapter = $_POST["chapter-del"];	//modified chapter's name
	$uchid = get_id($updated_chapter);
	$updated_problem = $_POST["mod_stat"];		//modified problem statement
	$uqid = get_id($updated_problem);
	$updated_correct = $_POST["cropt"];			//modified correct option
	$ucoid = get_id($updated_correct);
	$updated_incorrect1 = $_POST["incropt1"];	//modified incorrect option 1
	$uicoid1 = get_id($updated_incorrect1);
	$updated_incorrect2 = $_POST["incropt2"];	//modified incorrect option 2
	$uicoid2 = get_id($updated_incorrect2);
	$updated_incorrect3 = $_POST["incropt3"];	//modified incorrect option 3
	$uicoid3 = get_id($updated_incorrect3);
	
	$correct = "1";
	$incorrect = "0";
	
	//Make necessary changes in the database here............
	$conn = OpenCon();
	try{
		$conn->autocommit(FALSE);
		
		$query = "DELETE FROM questions WHERE question_id = ?";
		execute($conn,$query,"s",[$id],$stmt);
		close($stmt);


		try{
			$query = "INSERT INTO questions (question_id, question, chapter_id) VALUES (?, ?, ?)";
			execute($conn,$query,"sss",[$uqid,$updated_problem,$uchid],$stmt);
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
			execute($conn,$query,"ssss",[$uqid,$ucoid,$updated_correct,$correct],$stmt);
			close($stmt);
			execute($conn,$query,"ssss",[$uqid,$uicoid1,$updated_incorrect1,$incorrect],$stmt);
			close($stmt);
			execute($conn,$query,"ssss",[$uqid,$uicoid2,$updated_incorrect2,$incorrect],$stmt);
			close($stmt);
			execute($conn,$query,"ssss",[$uqid,$uicoid3,$updated_incorrect3,$incorrect],$stmt);
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
	}
	catch(Exception $e){
		$conn->rollback();
		exit($e->getMessage());
	}
	
	
	
	//Redirects to "mod-a-ques5.php"
	header('location: mod-a-ques5.php');
}

?>
