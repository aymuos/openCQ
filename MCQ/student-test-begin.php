<?php
include 'db_connection.php';
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
	
	$conn = OpenCon();
	//If the student if entering first time in the test region then 
	//generate all the random questions here and make necessary changes to
	//the database...else do nothing
	try{
		$conn->autocommit(FALSE);
		$query = "SELECT exam_questions.user_id FROM exam_questions INNER JOIN exam ON exam_questions.exam_id=exam.exam_id WHERE exam.is_active='1' AND exam_questions.user_id = ?";
		execute($conn,$query,"s",[get_user()],$stmt);
		$empty = !get_data($stmt);
		close($stmt);
		$query = "SELECT * FROM exam WHERE is_active='1'";
		execute($conn,$query,"",[],$stmt);
		$result = get_data($stmt);
		close($stmt);
		if(!$result){
			exit("No Exam is Live");
		}
		else{
			$n = $result[0]['num'];
		}
		if($empty){
			//Prepare the Question
			$query = "INSERT INTO exam_questions(user_id, exam_id, question) SELECT student.user_id AS user_id, exam.exam_id AS exam_id, questions.question AS question FROM exam INNER JOIN syllabus ON exam.exam_id=syllabus.exam_id INNER JOIN chapters ON syllabus.chapter=chapters.chapter INNER JOIN questions ON questions.chapter_id=chapters.chapter_id INNER JOIN student WHERE exam.is_active = '1' AND student.user_id = ? ORDER BY RAND() LIMIT ?;";
			execute($conn,$query,"si",[get_user(),$n],$stmt);
			close($stmt);
			$query = "SET  @num := 0;";
			execute($conn,$query,"",[],$stmt);
			close($stmt);
			$query = "UPDATE exam_questions SET question_id = @num := (@num+1) WHERE question_id IS NULL;";
			execute($conn,$query,"",[],$stmt);
			close($stmt);
			$query = "INSERT INTO exam_choices(user_id, exam_id, question, choice, is_right) SELECT exam_questions.user_id AS user_id, exam.exam_id AS exam_id, exam_questions.question AS question, choices.choice AS choice, choices.is_right AS is_right FROM exam_questions INNER JOIN questions ON exam_questions.question=questions.question INNER JOIN choices ON questions.question_id = choices.question_id INNER JOIN exam ON exam.exam_id=exam_questions.exam_id WHERE exam.is_active='1' AND exam_questions.user_id = ?;";
			execute($conn,$query,"s",[get_user()],$stmt);
			close($stmt);
		}
		else{
			;
		}

		$conn->autocommit(TRUE);
	}
	catch(Exception $e){
		$conn->rollback();
		report($e);
		exit("Error");
	}
	
	CloseCon($conn);
	//Redirect to "workpg.php"
	header('location: workpg.php');
}

?>