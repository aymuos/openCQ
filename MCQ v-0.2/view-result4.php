<?php

include 'db_connection.php';
//This page dispalys the answer script of a student for the given test...
//Please proceed to the else part......




session_start();
if ( isset($_SESSION['loggedinmaster']) == false ){
	echo ' 
	<html>
		<head>
			<title>Oops!!!</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		</head>
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


	$roll = $_GET["st_id"];				//Roll no/username of the student whose answer script is to be dispalyed
	$test_id = $_GET["test_id"];		//test id
	$student_id = $roll;
	$conn = OpenCon();
	$exam_id = $test_id;

	try{
		$query = "SELECT * FROM student WHERE id = ?";
		execute($conn,$query,"s",[$roll],$stmt);
		$student = get_data($stmt);
		close($stmt);

		$query = "SELECT * FROM student_allocation WHERE student_id = ? AND exam_id = ?";
		execute($conn,$query,"si",[$student_id,$exam_id],$stmt);
		$allocation = get_data($stmt);
		close($stmt);

		/*$query = "SELECT * FROM student WHERE id = ?";
		execute($conn,$query,"s",[$_SESSION['username']],$stmt);
		$student = get_data($stmt);
		close($stmt);*/
		/*if(!$allocation){
			
			$query = "SELECT * FROM exam_question WHERE exam_id = ?";
			execute($conn,$query,"i",[$exam_id],$stmt);
			$quest = get_data($stmt);
			close($stmt);

			$n = count($quest);

			$arr = [];
			for($i = 0 ; $i<$n;$i = $i + 1 ){
				$arr[]=$i;
			}
			shuffle($arr);

			$shuffle = implode(".",$arr);
			$query = "INSERT INTO student_allocation(student_id,exam_id,is_active,shuffle) VALUES (?,?,'1',?)";
			execute($conn,$query,"sis",[$_SESSION['username'],$exam_id,$shuffle],$stmt);
			close($stmt);
			foreach($quest as $value){
				$arr = [];
				for($i = 0 ; $i<4;$i = $i + 1 ){
					$arr[]=$i;
				}
				shuffle($arr);
	
				$shuffle = implode(".",$arr);
				$query = "INSERT INTO exam_mark(student_id,exam_question_id,shuffle) VALUES (?,?,?)";
				execute($conn,$query,"sis",[$_SESSION['username'],$value['id'],$shuffle],$stmt);
				close($stmt);

				$query = "SELECT id FROM exam_choice WHERE exam_question_id = ?";
				execute($conn,$query,"i",[$value['id']],$stmt);
				$cho = get_data($stmt);
				close($stmt);

				$query = "INSERT INTO attempt_choice(student_id,exam_choice_id) VALUES (?,?),(?,?),(?,?),(?,?)";
				execute($conn,$query,"sisisisi",[$_SESSION['username'],$cho[0]['id'],$_SESSION['username'],$cho[1]['id'],$_SESSION['username'],$cho[2]['id'],$_SESSION['username'],$cho[3]['id']],$stmt);
				close($stmt);
			}
			$query = "SELECT * FROM student_allocation WHERE student_id = ? AND exam_id = ?";
			execute($conn,$query,"si",[$student_id,$exam_id],$stmt);
			$allocation = get_data($stmt);
			close($stmt);
		}*/

		if($allocation[0]['is_active']=='0'){
			$query = "SELECT * FROM exam_question WHERE exam_id = ? ORDER BY id";
			execute($conn,$query,"i",[$exam_id],$stmt);
			$question = get_data($stmt);
			close($stmt);

			$arr = $question;

			$permut = explode(".",$allocation[0]['shuffle']);

			for($i=0;$i<count($permut);$i = $i + 1){
				$arr[$i] = $question[$permut[$i]];
			}


			$query = "SELECT * FROM exam WHERE id = ?";
			execute($conn,$query,"i",[$exam_id],$stmt);
			$exam = get_data($stmt);
			close($stmt);

		}
		else{
			exit("already in exam");
		}

		

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
</head>


<body>
<h2> GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY , KOLKATA
</h2>
<top_res>Welcome to OpenCQ test Platform</top_res>
	<div>
		<p style="float:left";>Name : &emsp; <b><font size="4">';
		
		
		//Please put the students name here...........
		echo $student[0]['name'];
		
		
		 echo '</font></b></p>
		<p style="float:right">Roll No :&emsp;<b><font size="4">'.$roll.'</font></b></p><br><br>
		<p style="float:left">Department : &emsp; <b><font size="4">';
		
		
		//Please put the department of the student.........
		echo $student[0]['stream'];
		
		
		
		echo '</font></b></p>
		<p style="float:right"> Marks :&emsp;<b><font size="4">';
		
		$hambacount = 0;
		foreach($question as $v){
			$query = "SELECT * FROM exam_mark WHERE student_id = ? AND exam_question_id = ?";
			execute($conn,$query,"si",[$student_id,$v['id']],$stmt);
			$mark = get_data($stmt);
			close($stmt);
			if($mark[0]['mark']==1){
				$hambacount = $hambacount + 1;
			}

		}
		
		echo $hambacount;
		//Please put the marks achieved by the student here..........
		//echo $res[0]['mark'];
		
		
		
		echo '</font></b></p>
	</div>
<h1> ANSWER SCRIPT </h1>
';



echo '<div id="form_wrapper">';


	$ct=1;	//Do not delete this variable....
	
	
	//This loop prints 10 question along with its answer
	foreach($arr as $value){
		//Do not do anything
		echo '<div class="w3-panel w3-border w3-round-xlarge option_cont"> <p><b>Question... :</b></p><br><input type="text" value="';
		
		
		
		//Please put the question id of the i th question in this echo statement..............
		echo $value['id'];
		
		
		//Do not do anything
		echo '" disabled hidden><textarea class="box" type="text" placeholder=" Problem Statement......" readonly>';
		
		
		
		
		//Put the question ststement in this echo statement.
		echo $value['name'];
		
		//$choices = choice_ordering($value);
		$query = "SELECT * FROM exam_choice WHERE exam_question_id = ? ORDER BY is_right DESC";
		execute($conn,$query,"i",[$value['id']],$stmt);
		$choice = get_data($stmt);
		close($stmt);

		$query = "SELECT shuffle FROM exam_mark WHERE exam_question_id = ?";
		execute($conn,$query,"i",[$value['id']],$stmt);
		$shuffle = get_data($stmt);
		close($stmt);

		$p = $choice;

		$per = explode(".",$shuffle[0]['shuffle']);

		for($i=0;$i<count($per);$i = $i+1){
			$p[$i]=$choice[$per[$i]];
		}
		$ac = 0;

		$query = "SELECT is_marked FROM attempt_choice WHERE student_id = ? AND exam_choice_id = ?";
		execute($conn,$query,"si",[$student_id,$p[0]['id']],$stmt);
		$atm = get_data($stmt);
		close($stmt);
		//Do not do anything
		echo '</textarea><br><br>';
		
		
		
		$img = 1;		//if there is an image then this if condition is satisfied...
		if($img == 1){
			echo '<img style="max-width: 800;" src="';
			
			
			//Put the image url here...........
			echo $value['url'];
			
			
			echo '">';
			
		}
		
		
		
		
		echo '<form><input type="radio"'; 
				
				
		//If option 1 has to be marked then please put a condition in the if statement that is true.
		if( $atm[0]['is_marked']=='1'){
			$ac = $p[0]['id'];
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}

		
				
		//please put option 1 here......
		echo $p[0]['name'];

				
		
				
				
		//Do not do anything
		echo '<br><input type="radio"';
				
				
				
				
		//If option 2 has to be marked then please put a condition in the if statement that is true.
		$query = "SELECT is_marked FROM attempt_choice WHERE student_id = ? AND exam_choice_id = ?";
		execute($conn,$query,"si",[$student_id,$p[1]['id']],$stmt);
		$atm = get_data($stmt);
		close($stmt);
				
				
		//If option 1 has to be marked then please put a condition in the if statement that is true.
		if( $atm[0]['is_marked']=='1'){
			$ac = $p[1]['id'];
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}

		
				
		//please put option 1 here......
		echo $p[1]['name'];
		
		
		
				
				
		//Do not do anything
		echo '<br><input type="radio" ';
				
				
				
				
		//If option 3 has to be marked then please put a condition in the if statement that is true.
		$query = "SELECT is_marked FROM attempt_choice WHERE student_id = ? AND exam_choice_id = ?";
		execute($conn,$query,"si",[$student_id,$p[2]['id']],$stmt);
		$atm = get_data($stmt);
		close($stmt);

				
				
		//If option 1 has to be marked then please put a condition in the if statement that is true.
		if( $atm[0]['is_marked']=='1'){
			$ac = $p[2]['id'];
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}

		
				
		//please put option 1 here......
		echo $p[2]['name'];
		
				
		

		//Do not do anything
		echo '<br><input type="radio" ';
		
		

				
		//If option 4 has to be marked then please put a condition in the if statement that is true.
				//If option 3 has to be marked then please put a condition in the if statement that is true.
				$query = "SELECT is_marked FROM attempt_choice WHERE student_id = ? AND exam_choice_id = ?";
				execute($conn,$query,"si",[$student_id,$p[3]['id']],$stmt);
				$atm = get_data($stmt);
				close($stmt);
				//Do not do anything
						
						
				//If option 1 has to be marked then please put a condition in the if statement that is true.
				if( $atm[0]['is_marked']=='1'){
					$ac = $p[3]['id'];
					echo ' checked disabled>';
				}
				else{
					echo ' disabled>';
				}
		
				
						
				//please put option 1 here......
				echo $p[3]['name'];
		
		/*$ca;
		$ver = 0;
		
		foreach($choices as $x){

			if($x[2] == "1"){
				$ca=$x[0];
				if($x[1] == "1"){
					$ver = 1;
				}
				break;
			}

		}*/
				
				
				
		//Do not do anything
		echo '<br><br>
		<p><b>Correct Answer :</b>&emsp;';
		
		
		//Please put the correct answer here...........
		echo $choice[0]['name'];
		
		
		
		
		echo '</p>
		<p><b>Verdict :&emsp;';
		
		
		
		//If the student  marks the answer correctly then this if statement is satisfied..........
		if($choice[0]['id'] == $ac){
			echo '<font size="4" color="green">Correct</font></b>';
		}
		else{
			echo '<font size="4" color="red">Wrong</font></b>';
		}
		
		
		
		
		echo '</p>	
		</form></div>';
	
		
		$ct = $ct + 1 ;

	}



//Rest of the code remains same...............




echo '

<form method="post" action="view-result3.php">
</div>
<input name="test_id" type="text" value="';
echo $test_id;
echo '" readonly hidden>

<div class="drama">
<button type="submit" class="button btn-danger">Back</button>
</div>
</form>


</body>
</html>
';



}
 
 
 ?>
