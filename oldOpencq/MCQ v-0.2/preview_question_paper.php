<?php


//This file takes the question statement and options from the user.
//Please proceed to the else part directly.
include 'db_connection.php';


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
	
	$conn = OpenCon();
	try{

		$query = "SELECT * FROM exam WHERE id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		$exam = get_data($stmt);
		close($stmt);
		$query = "SELECT * FROM subject WHERE id =?";
		execute($conn,$query,"s",[$exam[0]['subject_id']],$stmt);
		$subject = get_data($stmt);
		close($stmt);

		$query = "SELECT id,name,url FROM exam_question WHERE exam_id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		$question = get_data($stmt);
		close($stmt);

	}
	catch(Exception $e){
		report($e);
	}
	
	echo '
	<html>
		<head>
			<title>Preview</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
			<link rel="stylesheet" type="text/css" href="preview_question_paper_css.css">
			<script>
				function printf(){
					
					document.getElementById("print-btn").hidden=true;
					window.print();
					document.getElementById("print-btn").hidden=false;
					
				}
			</script>
		</head>
		<body>
			<div class="paper">
				<div class="head">
					<h4><b>GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY</b></h4>
					<h4><b>AN AUTONOMOUS INSTITUTE</b></h4>
					<h4><b>AFFLIATED TO MAKAUT (FORMELY KNOWN AS WBUT)</b></h4>
					<p class="text">Theory / ';
					
					
					//Echo b.tech or m.tech...
					if($subject[0]['UG']=='1'){
						echo 'B.Tech';
					}
					else{
						echo 'M.Tech';
					}
					

					echo ' / <b>Stream - </b>';
					
					//Echo the stream.....
					echo $subject[0]['department'];
					
					
					
					echo ' / <b>Code </b>- ';
					
					
					//Echo the paper code here.........
					echo $subject[0]['id'];

					echo ' / <b>Year - </b>';
					
					
					//Echo the year here.............
					$time = $exam[0]['create_time'];

					$year = date('Y');
					$nextYear = (int)($year) + 1;
					$nextYearTwo = $nextYear%100;
					echo "$year";
					
					
					echo '</p>
					<p class="text"><b>Paper Name : </b>';
					
					
					//Echo paper name here.........
					echo $subject[0]['name'];
					
					
					
					
					echo '</p>
					<hr>
				</div>
				<div class="body">';
				
				
				
				$ct = 1;	//Please donot delete this variable.....
				
				foreach($question as $value){	//loops till the no of question
					echo $ct.') ';
					
					
					//Put the problem statement here...........
					echo $value['name'];
					
					
					
				
					
					
					$img = 1;
					if($img==1){
						echo '<br><img src="';
						
						
						//Put the image url here.............
						echo $value['url'];
						
						
						echo '" style="max-width: 600px;padding-top: 15px;padding-bottom: 20px;">';
						
					}
					
					
					echo '
					<br>
					
					&emsp;a) ';
					
					try{
						$query = "SELECT * FROM exam_choice WHERE exam_question_id = ? ORDER BY is_right DESC";
						execute($conn,$query,"i",[$value['id']],$stmt);
						$choice = get_data($stmt);
						close($stmt);
					}
					catch(Exception $e){
						report($e);
					}


					//Put option 1 here.........
					echo $choice[0]['name'];
					
					
					echo '<br>
					&emsp;b) ';
					
					
					//Put option 2 here.........
					echo $choice[1]['name'];
					
					
					echo '<br>
					&emsp;c) ';
					
					
					//Put option 3 here.........
					echo $choice[2]['name'];
					
					
					echo '<br>
					&emsp;d) ';
					
					
					//Put option 4 here.........
					echo $choice[3]['name'];
					
					echo '<br><br>';
					
					$ct+=1;
				}
				echo '</div>
				<div style="text-align: center;">
					<button id="print-btn" onclick="printf()">Print</button>
				</div>
			</div>
		</body>
	</html>
	
	
';
}

?>