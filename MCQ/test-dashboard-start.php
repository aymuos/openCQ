<?php

include 'db_connection.php';

session_start();





//This file can start a test. User needs to select one of the created test 
//to start it. If a test is already running then the button will be disabled.
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
	echo '
<html>
<head>
<title>Modify a question</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="destroy.css">
</head>
<body id="page10">
	<div class="some" >
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
				<img class="logo" border="50" src="data/avatar.png" alt="Avatar"></img>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<font face="verdana" color="white" size="6.5px" > Dashboard</font>
					<a href="master-dashboard.php" style="text-decoration: none;opacity: 0.8"><font face="verdana" color="white" size="3px"  > &emsp;Home</font></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Account</a></li>
						<li><a href="master.html"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	
	<h1><b>Start a Test</b></h1>
	

<div class="container">
  <form class="form-inline" method="post"  action="test-dashboard-start2.php">
    <div class="form-group">
      <label>Select the test id <span style="color:red;">*</span></label>
        <select class="del-form-control" name="ti">
	
						
			
';





	$conn = OpenCon();
	try{
		$query = "SELECT * FROM exam WHERE is_active = '2'";
		execute($conn,$query,"",[],$stmt);
		$exams = get_data($stmt);
		close($stmt);
		$query = "SELECT * FROM exam WHERE is_active = '1'";
		execute($conn,$query,"",[],$stmt);
		$live = get_data($stmt);
		close($stmt);
	}
	catch(Exception $e){
		report($e);
		exit("Error");
	}

		


	//***Please modify this portion to display all the test available in the dropdown list.***\\\
	//Simply take all the test id  from the database which has not ended and display it.
	
	$len = 5;	//"len" contains the total no of test id to be displayed.
	foreach($exams as $value){		
		echo '<option>';
		
		
		//Please put the test id in this echo statement.
		echo $value['exam_id'];
		
		
		echo '</option>';
	}
			
			
			


	echo '
			
		</select>
    </div>
	
	<div class="button-container">
		<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button>
		<button type="submit" class="btn btn-success"';


	
	$ct = 0;
	if($live or !$exams){		//If this condition is satisfied then user cannot start a test as button will be disabled.
		echo 'disabled';
	}



		//Rest of the code remains same.
		CloseCon($conn);

		echo '>Start</button>
	</div>
  </form>
</div>

	
	
	

</body>
</html>




';

}

?>