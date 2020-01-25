<?php

include 'db_connection.php';

//This file creates a test in the database from the provided information.
//This doesnot begins a test.



session_start();

$conn = OpenCon();



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




	$test_id = $_POST["ti"];		//Test Id to be ended
	//err($test_id."\n");
	
	try{
		$query = "SELECT * FROM exam WHERE exam_id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		$exam = get_data($stmt);
		close($stmt);
		//err($exam[0]['exam_id']."\n");
		$query = "SELECT DISTINCT(user_id) AS u FROM exam_questions WHERE exam_id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		$users = get_data($stmt);
		close($stmt);
	}
	catch(Exception $e){
		report($e);
		exit("error");
	}
	
	if($exam[0]['is_active'] == "0"){
		exit("exam already ended");
	}
	try{
		$conn->autocommit(FALSE);
		foreach($users as $value){
			$id = $value['u'];
			//err($id."\n");
			$query = "SELECT exam_marks.user_id AS user_id FROM exam_marks INNER JOIN exam ON exam.exam_id = exam_marks.exam_id WHERE exam.is_active = '1' AND exam_marks.user_id = ?";
			execute($conn,$query,"s",[$id],$stmt);
			//print(get_user());
			$result1= get_data($stmt);
			close($stmt);
			if($result1){
				;
			}
			else{
				$query = "INSERT INTO exam_marks(user_id, exam_id, question) SELECT user_id, exam_id, question FROM exam_questions WHERE user_id = ? AND exam_id = ?";
				execute($conn,$query,"si",[$id,$test_id],$stmt);
				close($stmt);
				$query = "SELECT exam_choices.question AS q,exam_choices.choice AS c,exam_choices.is_marked AS m,exam_choices.is_right AS r FROM exam_choices INNER JOIN exam ON exam_choices.exam_id=exam.exam_id WHERE exam.is_active='1' AND exam_choices.user_id = ?";
				execute($conn,$query,"s",[$id],$stmt);
				$raw_paper = get_data($stmt);
				close($stmt);
				if(!$raw_paper){
					exit("Question Paper is not ready");
				}
				$paper = paper($raw_paper);
				foreach($paper as $key=>$value){
					$count = 0;
					foreach( $value as $x){
						if($x[1] == "1" and $x[2] == "1"){
							$count = $count+1;
						}
					}
					if($count === 1){
						$query = "UPDATE exam_marks SET marks = '1' WHERE user_id = ? AND exam_id = ? AND question = ?";
						execute($conn,$query,"sis",[$id,$test_id,$key],$stmt);
						close($stmt);
					}
				}

			}
		}
		$query = "UPDATE exam SET is_active = '0' WHERE exam_id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		close($stmt);
		$conn->autocommit(TRUE);
	}
	catch(Exception $e){
		$conn->rollback();
		report($e);
		exit("error");
	}

	CloseCon($conn);
	//Simply redirects to test-dashboard-create3.....
	header("Location: test-dashboard-end3.php");
	
}
?>