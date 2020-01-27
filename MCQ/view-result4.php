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

	$conn = OpenCon();


	try{
		$query1 = "SELECT question AS q, choice AS c, is_marked AS m, is_right AS r FROM exam_choices WHERE user_id = ? AND exam_id = ?";
		$query2 = "SELECT user_id AS roll, name , department AS dept FROM student WHERE user_id = ?";
		$query3 = "SELECT SUM(marks) AS mark FROM exam_marks WHERE user_id = ? AND exam_id = ?";
		execute($conn,$query1,"si",[$roll,$test_id],$stmt);
		$raw_paper = get_data($stmt);
		close($stmt);
		$paper = paper($raw_paper);
		execute($conn,$query2,"s",[$roll],$stmt);
		$user = get_data($stmt);
		close($stmt);
		execute($conn,$query3,"si",[$roll,$test_id],$stmt);
		$res = get_data($stmt);
		close($stmt);
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
<top_res>Welcome to Online MCQ test Platform</top_res>
	<div>
		<p style="float:left";>Name : &emsp; <b><font size="4">';
		
		
		//Please put the students name here...........
		echo $user[0]['roll'];
		
		
		 echo '</font></b></p>
		<p style="float:right">Roll No :&emsp;<b><font size="4">'.$roll.'</font></b></p><br><br>
		<p style="float:left">Department : &emsp; <b><font size="4">';
		
		
		//Please put the department of the student.........
		echo $user[0]['dept'];
		
		
		
		echo '</font></b></p>
		<p style="float:right"> Marks :&emsp;<b><font size="4">';
		
		
		//Please put the marks achieved by the student here..........
		echo $res[0]['mark'];
		
		
		
		echo '</font></b></p>
	</div>
<h1> ANSWER SCRIPT </h1>
';



echo '<div id="form_wrapper">';


	$ct=1;	//Do not delete this variable....
	
	
	//This loop prints 10 question along with its answer
	foreach($paper as $key=>$value){
		//Do not do anything
		echo '<div class="w3-panel w3-border w3-round-xlarge option_cont"> <p><b>Question... :</b></p><br><input type="text" value="';
		
		
		
		//Please put the question id of the i th question in this echo statement..............
		echo 'Soumya';
		
		
		//Do not do anything
		echo '" disabled hidden><textarea class="box" type="text" placeholder=" Problem Statement......" readonly>';
		
		
		
		
		//Put the question ststement in this echo statement.
		echo $key;
		
		$choices = choice_ordering($value);
		
		
		
		//Do not do anything
		echo '</textarea><br><br><form><input type="radio"'; 
				
				
		//If option 1 has to be marked then please put a condition in the if statement that is true.
		if( $choices[0][1] == "1"){
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}

		
				
		//please put option 1 here......
		echo $choices[0][0];

				

				
				
		//Do not do anything
		echo '<br><input type="radio"';
				
				
				
				
		//If option 2 has to be marked then please put a condition in the if statement that is true.
		if($choices[1][1] == "1" ){
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}
				

		//please put option 2 here.......
		echo $choices[1][0];
		
		
		
				
				
		//Do not do anything
		echo '<br><input type="radio" ';
				
				
				
				
		//If option 3 has to be marked then please put a condition in the if statement that is true.
		if( $choices[2][1] == "1"){
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}
				
				
				
				
				
			
		//please put option 3 here.......
		echo $choices[2][0] ;
		
				
		

		//Do not do anything
		echo '<br><input type="radio" ';
		
		

				
		//If option 4 has to be marked then please put a condition in the if statement that is true.
		if( $choices[3][1] == "1"){
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}
				
				
		
		
		
		//please put option 4 here .......
		echo $choices[3][0];
		
		$ca;
		$ver = 0;
		
		foreach($choices as $x){

			if($x[2] == "1"){
				$ca=$x[0];
				if($x[1] == "1"){
					$ver = 1;
				}
				break;
			}

		}
				
				
				
		//Do not do anything
		echo '<br><br>
		<p><b>Correct Answer :</b>&emsp;';
		
		
		//Please put the correct answer here...........
		echo $ca;
		
		
		
		
		echo '</p>
		<p><b>Verdict :&emsp;';
		
		
		
		//If the student  marks the answer correctly then this if statement is satisfied..........
		if($ver == 1){
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