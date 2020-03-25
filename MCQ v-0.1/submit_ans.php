<?php
	session_start();
	include 'db_connection.php';

	err("I am called");
	$conn = OpenCon();


	
	$exam_id = $_GET["exam_id"];		//This is exam id
	//exit($exam_id);
	err("\nexamid = ".$exam_id."\n");
	try{
		$query = "SELECT COUNT(*) AS c FROM exam_question WHERE exam_id = ?";
		execute($conn,$query,"i",[$exam_id],$stmt);
		$result = get_data($stmt);
		close($stmt);
	}
	catch(Exception $e){
		report($e);
	}

	$len = $result[0]['c'];	//Put the no of question here.......
	err("\nlen = ".$len."\n");
	//report($len);
	for($i=1;$i<=1;$i++){
		//$ques_id = $_GET["qid".$i];		//This is the question id
		//$optid = $_GET["opt".$i];		//This is the option id. If this is 0 then no option is clicked.
		err("\noptid = ".$optid."\n");
		//Make necessary changes to the database here.......
		try{
		/*$query = "SELECT * FROM exam_question WHERE id = ?";
		execute($conn,$query,"i",[$qid],$stmt);
		$question = get_data($stmt);
		close($stmt);*/
		$conn->autocommit(FALSE);
		$query = "UPDATE student_allocation SET is_active= '0' WHERE student_id = ? AND exam_id = ?";
		execute($conn,$query,"si",[$_SESSION['username'],$exam_id],$stmt);
		close($stmt);
		/*$query = "SELECT * FROM exam_choice WHERE exam_question_id = ? ORDER BY is_right DESC";
		execute($conn,$query,"i",[$ques_id],$stmt);
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
			execute($conn,$query,"is",[$ques_id,$_SESSION['username']],$stmt);
			close($stmt);
		}
		//exit("hamba");*/
		$conn->autocommit(TRUE);
		}
		catch(Exception $e){
			$conn->rollback();
			report($e);
		}
		//echo $ques_id;
		//echo $opt_id;
		//echo 'You paper has been sumbitted successfully';
	}
		
	
	
	
?>
