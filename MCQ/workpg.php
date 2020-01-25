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
else {

	$conn = OpenCon();

	try{
		$query = "SELECT * FROM exam WHERE is_active='1'";
		execute($conn,$query,"",[],$stmt);
		$result = get_data($stmt);
		close($stmt);
		$query = "SELECT exam_marks.user_id AS user_id FROM exam_marks INNER JOIN exam ON exam.exam_id = exam_marks.exam_id WHERE exam.is_active = '1' AND exam_marks.user_id = ?";
		execute($conn,$query,"s",[get_user()],$stmt);
		//print(get_user());
		$result1= get_data($stmt);
		close($stmt);
		$n = 0;
		if(!$result){
			exit("No exam is live");
		}
		else{
			$n = $result[0]['num'];
		}
		if($result1){
			exit("You have already taken this exam");
		}
		$query = "SELECT exam_choices.question AS q,exam_choices.choice AS c,exam_choices.is_marked AS m,exam_choices.is_right AS r FROM exam_choices INNER JOIN exam ON exam_choices.exam_id=exam.exam_id WHERE exam.is_active='1' AND exam_choices.user_id = ?";
		execute($conn,$query,"s",[get_user()],$stmt);
		$raw_paper = get_data($stmt);
		close($stmt);
		if(!$raw_paper){
			exit("Question Paper is not ready");
		}
		$paper = paper($raw_paper);

	}
	catch(Exception $e){
		report($e);
		exit("error");
	}



	echo '





<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="workpgcuss.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<title> Your Workspace </title>
<script>document.createElement("top_res")</script>


<script type="text/javascript">

	function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};



	function saveFunc(){
		var str = "save-opt.php?";
		for( var j = 1 ; j <='. $n .'; j++ ){
			var id = document.getElementsByName(\'quesid\'+j);
			str = str + "quesid" + j + "=" + encodeURIComponent(id[0].value) +"&";
			var radios = document.getElementsByName(\'question\'+j);
			var temp = "-1";
			for (var i = 0, length = radios.length; i < length; i++) {
				if (radios[i].checked) {;
					temp = radios[i].value ;
					break;
				}
			}
			str = str + "ques" + j + "=" + encodeURIComponent(temp) + "&";
		}
		window.location.href = str + "submit=0";
	}
	
	
	
	
	function submitFunc(){
		var str = "save-opt.php?";
		for( var j = 1 ; j <='. $n .'; j++ ){
			var id = document.getElementsByName(\'quesid\'+j);
			str = str + "quesid" + j + "=" + encodeURIComponent(id[0].value) +"&";
			var radios = document.getElementsByName(\'question\'+j);
			var temp = "-1";
			for (var i = 0, length = radios.length; i < length; i++) {
				if (radios[i].checked) {;
					temp = radios[i].value ;
					break;
				}
			}
			str = str + "ques" + j + "=" + encodeURIComponent(temp) + "&";
		}
		window.location.href = str + "submit=1";
	}
	
	
	
	


</script>


</head>


<body>
<h2> GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY , KOLKATA
</h2>
<top_res>Welcome to Online MCQ test Platform</top_res>
 
<h1> ATTEMPT THE FOLLOWING 10 QUESTIONS </h1>

';


//Do not do anything
if(isset($_GET["xYreT"])){
echo '
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Answer successfully <strong>saved!</strong>
</div>
';
}

echo '<div id="form_wrapper">';

	
	$ct=1;	//Do not delete this variable....
	

	//This loop prints 10 question along with its answer
	foreach($paper as $key=>$value){
		//Do not do anything
		echo '<div class="w3-panel w3-border w3-round-xlarge option_cont"> <p><b>Question '.$ct.' :</b></p><br><input name="quesid'.$ct.'" type="text" value="';
		
		
		
		//Please put the question id of the i th question in this echo statement..............
		echo get_id($key);
		
		
		//Do not do anything
		echo '" disabled hidden><textarea class="box" type="text" placeholder=" Problem Statement......" name="problem-statement" disabled>';
		
		
		
		
		//Put the question ststement in this echo statement.
		echo $key;
		
		
		$value = choice_ordering($value);
		
		
		//Do not do anything
		echo '</textarea><br><br><form id="form'.$ct.'"><input type="radio" name="question'.$ct.'" value="'; 
				
				
				
				
		//Please put option 1 here......
		echo $value[0][0];
				


				
				
		//If option 1 has to be marked then please put a condition in the if statement that is true.
		if($value[0][1]=="1"){
			echo '" checked >';
		}
		else{
			echo '" >';
		}

		
				
		//please put option 1 here again......It is not a mistake.
		echo $value[0][0];

				

				
				
		//Do not do anything
		echo '<br><input type="radio" name="question'.$ct.'" value="';
				
				
		

		
		//Please put option 2 here......
		echo $value[1][0];
		
				
				
		//If option 2 has to be marked then please put a condition in the if statement that is true.
		if($value[1][1]=="1" ){
			echo '" checked >';
		}
		else{
			echo '" >';
		}
				

		//please put option 2 here again......It is not a mistake.
		echo $value[1][0];
		
		
		
				
				
		//Do not do anything
		echo '<br><input type="radio" name="question'.$ct.'" value="';
				
				
				
			
		//Please put option 3 here......
		echo $value[2][0];
		
				
				
				
				
				
		//If option 3 has to be marked then please put a condition in the if statement that is true.
		if($value[2][1] == "1"){
			echo '" checked >';
		}
		else{
			echo '" >';
		}
				
				
				
				
				
			
		//please put option 3 here again......It is not a mistake.
		echo $value[2][0];
		
				
		

		//Do not do anything
		echo '<br><input type="radio" name="question'.$ct.'" value="';
		
		
		
		
		//please put option 4 here.
		echo $value[3][0];
		
				
				
		//If option 4 has to be marked then please put a condition in the if statement that is true.
		if( $value[3][1] == "1"){
			echo '" checked >';
		}
		else{
			echo '" >';
		}
				
				
		
		
		
		//please put option 4 here again......It is not a mistake.
		echo $value[3][0];
		
				
				
				
				
		//Do not do anything
		echo '<br></form></div>';
		
		$ct = $ct + 1 ;

	}






echo '



</div>

<div class="drama">

<button class="button btn-success" onclick="saveFunc()">Save</button>
<button class="button btn-danger" onclick="submitFunc()">Submit</button>
</div>

</body>
</html>



';
CloseCon($conn);
}

?>