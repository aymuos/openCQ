<?php





//This 2d array has the question id and the corresponding
//answer to that question(in string). If the answer is -1 then
//it means no option were marked.
//Eg:
//   $answer[0][0] --> contains question id of first question.
//   $answer[0][1] --> contains the marked answer. If it is "-1" then no answer is marked.
$answer = array(
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
);





	if($_GET["submit"]==0){		//if the student has pressed saved button and not submit button.
		//Redirects to "workpg.php"
		//Please do nothing here.
		header("location: workpg.php?xYreT=1");
	}
	else{
		//Test is ended as student has pressed submit button
		//please make sure to make necessary changes here in the
		//database so that student cannot retake exam.
		
		
		
		
		
		//In the end simply redirect to test-end.php
		header("location: test-end.php");
	}
		
		

?>