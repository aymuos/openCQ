<?php


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
		echo 'Rashed Mehdi';
		
		
		
		 echo '</font></b></p>
		<p style="float:right">Roll No :&emsp;<b><font size="4">'.$roll.'</font></b></p><br><br>
		<p style="float:left">Department : &emsp; <b><font size="4">';
		
		
		//Please put the department of the student.........
		echo 'CSE';
		
		
		
		echo '</font></b></p>
		<p style="float:right"> Marks :&emsp;<b><font size="4">';
		
		
		//Please put the marks achieved by the student here..........
		echo '10';
		
		
		
		echo '</font></b></p>
	</div>
<h1> ANSWER SCRIPT </h1>
';



echo '<div id="form_wrapper">';


	$ct=1;	//Do not delete this variable....
	
	
	//This loop prints 10 question along with its answer
	for($ch=1;$ch<=10;$ch+=1){
		//Do not do anything
		echo '<div class="w3-panel w3-border w3-round-xlarge option_cont"> <p><b>Question... :</b></p><br><input type="text" value="';
		
		
		
		//Please put the question id of the i th question in this echo statement..............
		echo 'hello';
		
		
		//Do not do anything
		echo '" disabled hidden><textarea class="box" type="text" placeholder=" Problem Statement......" readonly>';
		
		
		
		
		//Put the question ststement in this echo statement.
		echo 'This is a question statement ';
		
		
		
		
		
		//Do not do anything
		echo '</textarea><br><br><form><input type="radio"'; 
				
				
		//If option 1 has to be marked then please put a condition in the if statement that is true.
		if( $ct == $ch){
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}

		
				
		//please put option 1 here......
		echo ' First option';

				

				
				
		//Do not do anything
		echo '<br><input type="radio"';
				
				
				
				
		//If option 2 has to be marked then please put a condition in the if statement that is true.
		if( $ct == 0){
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}
				

		//please put option 2 here.......
		echo ' Second option';
		
		
		
				
				
		//Do not do anything
		echo '<br><input type="radio" ';
				
				
				
				
		//If option 3 has to be marked then please put a condition in the if statement that is true.
		if( $ct == 0){
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}
				
				
				
				
				
			
		//please put option 3 here.......
		echo ' Third option';
		
				
		

		//Do not do anything
		echo '<br><input type="radio" ';
		
		

				
		//If option 4 has to be marked then please put a condition in the if statement that is true.
		if( $ct == 0){
			echo ' checked disabled>';
		}
		else{
			echo ' disabled>';
		}
				
				
		
		
		
		//please put option 4 here .......
		echo ' Fourth option';
		
				
				
				
				
		//Do not do anything
		echo '<br><br>
		<p><b>Correct Answer :</b>&emsp;';
		
		
		//Please put the correct answer here...........
		echo 'Please put the correct answer here.';
		
		
		
		
		echo '</p>
		<p><b>Verdict :&emsp;';
		
		
		
		//If the student  marks the answer correctly then this if statement is satisfied..........
		if($ct == 2){
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