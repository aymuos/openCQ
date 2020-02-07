<?php


include 'db_connection.php';


//This page helps user to select the test whose result he wants to view.
//Please proceed to the else part............

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
	echo '
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="selectlist.css" >
		<title>View Result</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="logo1024.png" type="image/gif" sizes="26x26">
	</head>
	<body>
		<p>
			<h2> GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY , KOLKATA</h2>
		</p>
		<br>
		<h1 class="DQ">
			Select option from list
		</h1>
		<br>
		<form method="post" action="test-dashboard-view2.php"><!--define php page here --> 
			<fieldset>
				<legend> Choice of Tests</legend>
					<h1 style="text-align:center;"> Select the Test</h1>
					<p class="ZX">
						<select name ="testoption" class="selection-list" >';
						
						
							$conn = OpenCon();

							try{
								$query = "SELECT * FROM exam WHERE is_active = '1'";
								execute($conn,$query,"",[],$stmt);
								$exams = get_data($stmt);
								close($stmt);
							}
							catch(Exception $e){
								report($e);
								exit("Error");
							}

							CloseCon($conn);	
							
							
							foreach($exams as $value){
								echo '<option value="';
								
								
								
								//Put test id of the test that has been ended.........
								echo $value['exam_id'];
								
								
								
								echo '">';
								
								
								
								//Put test id of the test that has been ended AGAIN............
								echo $value['exam_id'];
								
								
								echo '</option>';
							}
						
						
						echo '</select>
					</p>
				</legend>
				<p class="ZX">
					<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button> 
					<button type="submit" class="btn btn-success">Go</button> 
				<!--should add javascript function like onClick()-->
				</p>
		</form>
       </body>
       ';
	   
}




?>
