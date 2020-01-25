<?php

include 'db_connection.php';

session_start();



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
else{
$conn = OpenCon();

$n = 0;
$eid = "";
try{
	$query = "SELECT * FROM exam WHERE is_active = '1'";
	execute($conn,$query,"",[],$stmt);
	$res = get_data($stmt);
	close($stmt);
	if(!$res){
		exit("No exam live");
	}
	else{
		$n = $res[0]['num'];
		$eid = $res[0]['exam_id'];
	}
	$query = "SELECT exam_marks.user_id AS user_id FROM exam_marks INNER JOIN exam ON exam.exam_id = exam_marks.exam_id WHERE exam.is_active = '1' AND exam_marks.user_id = ?";
	execute($conn,$query,"s",[get_user()],$stmt);
	//print(get_user());
	$res1= get_data($stmt);
	close($stmt);
	if($res1){
		exit("Exam Paper is Already Submitted");
	}

	$query = "SELECT question, cquestion FROM exam_questions WHERE user_id = ? AND exam_id = ?";
	execute($conn,$query,"ss",[get_user(),$eid],$stmt);
	$questions = get_data($stmt);
	close($stmt);
	$quest =[];
	foreach($questions as $value){
		$quest[$value['cquestion']]=$value['question'];
	}

}
catch(Exception $e){
	report($e);
	exit("Error");
}

//This 2d array has the question id and the corresponding
//answer to that question(in string). If the answer is -1 then
//it means no option were marked.
//Eg:
//   $answer[0][0] --> contains question id of first question.
//   $answer[0][1] --> contains the marked answer. If it is "-1" then no answer is marked.
$ct = 1;




$answer = [];
for($i=1 ; $i <= $n ; $i = $i + 1){
	$answer[]=[$quest[$_GET["quesid"."$i"]],get_id($_GET["ques"."$i"])];
}





/*$answer = array(
				array($_GET["quesid1"],$_GET["ques1"]),
				array($_GET["quesid2"],$_GET["ques2"]),
				array($_GET["quesid3"],$_GET["ques3"]),
				array($_GET["quesid4"],$_GET["ques4"]),
				array($_GET["quesid5"],$_GET["ques5"]),
				array($_GET["quesid6"],$_GET["ques6"]),
				array($_GET["quesid7"],$_GET["ques7"]),
				array($_GET["quesid8"],$_GET["ques8"]),
				array($_GET["quesid9"],$_GET["ques9"]),
				array($_GET["quesid10"],$_GET["ques10"]),
);*/

/*foreach($answer as $value){
	err("Question = ".$value[0]." and choice = ".$value[1]."\n");
}*/

try{
	$conn->autocommit(FALSE);
	$query = "UPDATE exam_choices SET is_marked = '0' WHERE user_id = ? AND exam_id = ?";
	execute($conn,$query,"si",[get_user(),$eid],$stmt);
	close($stmt);
	foreach($answer as $value){
		if($value[1] === "-1"){
			;
		}
		else{
			$query = "UPDATE exam_choices SET is_marked = '1' WHERE user_id = ? AND exam_id = ? AND question = ? AND cchoice = ?";
			execute($conn,$query,"siss",[get_user(),$eid,$value[0],$value[1]],$stmt);
			//err("For question ".$value[0]." : Number of rows affected = ".strval($stmt->affected_rows)."\n");
			close($stmt);
		}
	}

	$conn->autocommit(TRUE);
}
catch(Exception $e){
	$conn->rollback();
	report($e);
	exit("Error");
}


	if($_GET["submit"]==0){		//if the student has pressed saved button and not submit button.
		//Redirects to "workpg.php"
		//Please do nothing here.
		header("location: workpg.php?xYreT=1");
	}
	else{
		//Test is ended as student has pressed submit button
		//please make sure to make necessary changes here in the
		//database so that student cannot retake exam.
		try{
			$conn->autocommit(FALSE);
			$query = "INSERT INTO exam_marks(user_id, exam_id, question) SELECT user_id, exam_id, question FROM exam_questions WHERE user_id = ? AND exam_id = ?";
			execute($conn,$query,"si",[get_user(),$eid],$stmt);
			close($stmt);
			$query = "SELECT exam_choices.question AS q,exam_choices.choice AS c,exam_choices.is_marked AS m,exam_choices.is_right AS r FROM exam_choices INNER JOIN exam ON exam_choices.exam_id=exam.exam_id WHERE exam.is_active='1' AND exam_choices.user_id = ?";
			execute($conn,$query,"s",[get_user()],$stmt);
			$raw_paper = get_data($stmt);
			close($stmt);
			if(!$raw_paper){
				exit("Question Paper is not ready");
			}
			$paper = paper($raw_paper);
			foreach($answer as $value){
				$count = 0;
				foreach( $paper[$value[0]] as $x){
					if($x[1] == "1" and $x[2] == "1"){
						$count = $count+1;
					}
				}
				if($count === 1){
					$query = "UPDATE exam_marks SET marks = '1' WHERE user_id = ? AND exam_id = ? AND question = ?";
					execute($conn,$query,"sis",[get_user(),$eid,$value[0]],$stmt);
					close($stmt);
				}
			}

			$conn->autocommit(TRUE);
		}
		catch(Exception $e){
			$conn->rollback();
			report($e);
			exit("error");
		}


		
		//In the end simply redirect to test-end.php
		header("location: test-end.php");
	}
		
}


		

?>