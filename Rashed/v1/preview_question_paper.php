<?php


//This file takes the question statement and options from the user.
//Please proceed to the else part directly.



session_start();
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
	
	
	$test_id = $_GET["ti"];		//This is the test id......
	
	
	
	echo '
	<html>
		<head>
			<title>Preview</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
			<link rel="stylesheet" type="text/css" href="preview_question_paper_css.css">
		</head>
		<body>
			<div class="paper">
				<div class="head">
					<h4><b>GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY</b></h4>
					<h4><b>AN AUTONOMOUS INSTITUTE</b></h4>
					<h4><b>AFFLIATED TO MAKAUT (FORMELY KNOWN AS WBUT)</b></h4>
					<p class="text">Theory / ';
					
					
					//Echo b.tech or m.tech...
					echo 'B.Tech';

					echo ' / ';
					
					//Echo the stream.....
					echo 'CSE';
					echo ' / SEM - ';
					
					
					//Echo the Sem number............
					echo '5';
					
					
					echo ' / Code - ';
					
					
					//Echo the paper code here.........
					echo 'CS 502';

					echo ' / ';
					
					
					//Echo the year here.............
					echo '2019-20';
					
					
					echo '</p>
					<p class="text"><b>Paper Name : ';
					
					
					//Echo paper name here.........
					echo 'Object Oriented Methodologies';
					
					
					
					
					echo '</b></p>
					<hr>
				</div>
				<div class="body">';
				
				
				
				$ct = 1;	//Please donot delete this variable.....
				
				for($i=1;$i<=10;$i++){	//loops till the no of question
					echo $ct.') ';
					
					
					//Put the problem statement here...........
					echo 'Which of the following operator is used for pointing to the member of a class in c++ ?';
					
					
					
				
					
					
					$img = 1;
					if($img==1){
						echo '<img src="';
						
						
						//Put the image url here.............
						echo 'https://i.imgur.com/9OQ7z99.jpg';
						
						
						echo '" style="max-width: 600px;padding-top: 15px;padding-bottom: 20px;">';
						
					}
					
					
					echo '
					<br>
					
					&emsp;a) ';
					
					
					//Put option 1 here.........
					echo 'new';
					
					
					echo '<br>
					&emsp;b) ';
					
					
					//Put option 2 here.........
					echo '::*';
					
					
					echo '<br>
					&emsp;c) ';
					
					
					//Put option 3 here.........
					echo 'sizeof()';
					
					
					echo '<br>
					&emsp;d) ';
					
					
					//Put option 4 here.........
					echo '>>';
					
					echo '<br><br>';
					
					$ct+=1;
				}
				echo '</div>
			</div>
		</body>
	</html>
	
	
';
}

?>