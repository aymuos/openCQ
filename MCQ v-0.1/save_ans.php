<?php
	session_start();
	include 'db_connection.php';


	$qid = $_GET["qid"];		//This is the question id
	$optid = $_GET["opt"];		//This is the option id
	//echo $optid."*-*-*-";
	//exit("hamba");
	//echo "Answered Saved Successfully!!!";
	//echo $qid;
	//echo $optid;
	$conn = OpenCon();
	try{
		/*$query = "SELECT * FROM exam_question WHERE id = ?";
		execute($conn,$query,"i",[$qid],$stmt);
		$question = get_data($stmt);
		close($stmt);*/
		$conn->autocommit(FALSE);
		$query = "SELECT * FROM exam_choice WHERE exam_question_id = ? ORDER BY is_right DESC";
		execute($conn,$query,"i",[$qid],$stmt);
		$choice = get_data($stmt);
		close($stmt);
		//exit("hamba");

		for($i=0;$i<4;$i=$i+1){
			if($choice[$i]['id'] == $optid){
			//	echo $choice[$i]['id'];
			//	echo $_SESSION['username'];
				$query = "UPDATE attempt_choice SET is_marked = '1' WHERE exam_choice_id = ? AND student_id = ?";
				execute($conn,$query,"is",[$choice[$i]['id'],$_SESSION['username']],$stmt);
				close($stmt);
			}
			else{
			//	echo $choice[$i]['id'];
			//	echo $_SESSION['username']."*";
				$query = "UPDATE attempt_choice SET is_marked = '0' WHERE exam_choice_id = ? AND student_id = ?";
				execute($conn,$query,"is",[$choice[$i]['id'],$_SESSION['username']],$stmt);
				close($stmt);
			}
		}
		if($choice[0]['id']==$optid){
			$query = "UPDATE exam_mark SET mark = 1 WHERE exam_question_id = ? AND student_id = ?";
			execute($conn,$query,"is",[$qid,$_SESSION['username']],$stmt);
			close($stmt);
		}
		//exit("hamba");
		$conn->autocommit(TRUE);
	}
	catch(Exception $e){
		$conn->rollback();
		report($e);
	}


?>
