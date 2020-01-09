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

	$chname = $_POST["chapter-name"]; 		//This is the chapter name
	$statement = $_POST["problem-statement"];	//This has the problem statement
	$co = $_POST["correct"];					//This is the correct option
	$ico1 = $_POST["incorrect1"];				//This is the incorrect option 1
	$ico2 = $_POST["incorrect2"];				//This is the incorrect option 2
	$ico3 = $_POST["incorrect3"];				//This is the incorrect option 2


	$conn = OpenCon();
	$conn->set_charset("utf8mb4");
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	$q=$statement;
	$c=$chname;
	$right_choice=$co;
	$choice1=$ico1;
	$choice2=$ico2;
	$choice3=$ico3;
	$one = '1';
	$zero = '0';
	$c_id = preg_replace('/\s/','',$c);
	$c_id = strtolower($c_id);
	$q_id = preg_replace('/\s/','',$q);
	$q_id = strtolower($q_id);
	$q_id = $c_id . $q_id; 
	$right_choice_id = preg_replace('/\s/','',$right_choice);
	$right_choice_id = strtolower($right_choice_id);
	$choice1_id = preg_replace('/\s/','',$choice1);
	$choice1_id = strtolower($choice1_id);
	$choice2_id = preg_replace('/\s/','',$choice2);
	$choice2_id = strtolower($choice2_id);
	$choice3_id = preg_replace('/\s/','',$choice3);
	$choice3_id = strtolower($choice3_id);
	$continue=1;
	try{

		$conn->autocommit(FALSE);
		try{
			$stmt1 = $conn->prepare("INSERT INTO question (question_id, question , chapter_id) VALUES (?, ?, ?)");
			$stmt1->bind_param("sss",$q_id,$q,$c_id);
			$stmt1->execute();
			$stmt1->close();
		}catch(Exception $e){
			$continue=0;
			if($conn->errno === 1062){
				#echo "Duplicate Question ";
			}
			else{
				#echo $e->getMessage();
			}
			throw $e;
		}
		try{
			#$conn->autocommit(FALSE);
			$stmt3 = $conn->prepare("INSERT INTO choice (question_id , choice_id, choice, is_right_choice) VALUES (?,?,?,?)");
			$stmt3->bind_param("ssss",$q_id,$right_choice_id,$right_choice,$one);
			$stmt3->execute();
			$stmt3->close();
			$stmt4 = $conn->prepare("INSERT INTO choice (question_id , choice_id, choice, is_right_choice) VALUES (?,?,?,?)");
			$stmt4->bind_param("ssss",$q_id,$choice1_id,$choice1,$zero);
			$stmt4->execute();
			$stmt4->close();
			$stmt5 = $conn->prepare("INSERT INTO choice (question_id , choice_id, choice, is_right_choice) VALUES (?,?,?,?)");
			$stmt5->bind_param("ssss",$q_id,$choice2_id,$choice2,$zero);
			$stmt5->execute();
			$stmt5->close();
			$stmt6 = $conn->prepare("INSERT INTO choice (question_id , choice_id, choice, is_right_choice) VALUES (?,?,?,?)");
			$stmt6->bind_param("ssss",$q_id,$choice3_id,$choice3,$zero);
			$stmt6->execute();
			$stmt6->close();
			#$conn->autocommit(TRUE)
		}catch(Exception $e){
			#$conn->rollback();
			if($conn->errno === 1062){
				#echo "Duplicate Choice";
			}
			else{
				#echo $e->getMessage();
			}
			throw $e;
		}
		$conn->autocommit(TRUE);
		CloseCon($conn);
		header('location: add-a-ques3.php');
	}catch(Exception $e){
		$conn->rollback();

	}
	CloseCon($conn);



	//Add this question to the database here.






	//Redirects to "add-a-ques3.php"
	
}
?>
