<?php

include 'db_connection.php';

session_start();




//This page displays the data of the test and wants the confirmation
//that the result of the selected test has to be displayed.
//Please proceed to the else part.



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
	
	$test_id = $_POST["testoption"]; //This contains the test id whose details has to be displayed.

	$conn = OpenCon();

	try{
		$query = "SELECT * FROM exam WHERE exam_id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		$exam = get_data($stmt);
		close($stmt);
	}
	catch(Exception $e){
		report($e);
		exit("error");
	}
	
	echo '<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="testdescrip.css" >
		<title>TEST DESCRIPTION</title>
		<meta charset="utf-8">
		<link rel="icon" href="logo1024.png" type="image/gif" sizes="26x26">
	</head>
	<body>
		<p>
			<h2> GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY , KOLKATA</h2>
		</p>
		<div class="normal">
		<form action="test-dashboard-view3.php" method="post"> <!--add action="php filename-->
			<fieldset>
			<legend> TEST DETAILS</legend>
			<p>Test ID :&emsp;<input type="text" name="test_id" placeholder="Test ID" value="'.$test_id.'" readonly><br></p>
			<p>Date :&emsp;<input type="text" name="date" placeholder="Date" value="';
			
			
			
			//Please Enter the date of the corresponding test..........
			echo $exam[0]['user_date'];
			
			
			
			
			echo '" readonly><br></p>
			<p>No of questions :&emsp;<input type="text" name="no_of_ques" placeholder="Total no of question" value="';
			
			
			
			
			//Please enter the no of question of that test...............
			echo $exam[0]['num'];
			
			
			
			
			
			echo '" readonly><br></p>
			<p class="just">Description :&emsp;</p>
			<textarea class="box" type="text" name="desc" placeholder="Description" readonly>';
			
			
			
			
			//Please put the description of the test here........
			echo $exam[0]['description'];
			
			
			
			
			
			
			
			echo '</textarea>
			<br><br>
			<div class="disv" >
				<button type="button" class="btn btn-danger" onclick="location.href=\'test-dashboard-view.php\'">Change Test</button> 
				<button type="submit" class="btn btn-success">View</button>
			</div>
	  </form>
	  </div>
     </body>
';
	
	
	
	
}


?>
