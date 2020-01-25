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
	echo '

<html>
<head>
<title>Welcome</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="destroy.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body id="page4">

<div class="some">
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
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Account</a></li>
						<li><a href="smain.html"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		</div>


<div class="header1">
    <div class="container">
        <div class="mbr-row align-center">
            <div class="title-block mbr-col-sm-12 mbr-col-md-12 mbr-col-lg-12">
                <h1 style="text-align: center; font-face: verdana; color: red;">Instructions</h1>
				<font size="4">
                <ol>
					<li>There will be 10 mcq type question each carrying 1 marks.</li>
					<li>Correct answer will fetch you 1 marks.</li>
					<li>No negative marking for wrong answer.</li>
					<li>The person sitting next to you has a different question set, so no point of disturbing him.</li>
				</ol>
                </font>
                <div class="id1">
 <button type="button" class="btn btn-success btn-lg" onclick="location.href=\'student-test-begin.php\'"';
				
				
				$conn = OpenCon();
				
				
				//****please modify this portion*****\\
				try{
					$query = "SELECT exam_marks.user_id AS user_id FROM exam_marks INNER JOIN exam ON exam.exam_id = exam_marks.exam_id WHERE exam.is_active = '1' AND exam_marks.user_id = ?";
					execute($conn,$query,"s",[get_user()],$stmt);
					//print(get_user());
					$result1= get_data($stmt);
					close($stmt);
					$query = "SELECT exam_id FROM exam where is_active = '1'";
					execute($conn,$query,"",[],$stmt);
					$result2= get_data($stmt);
					close($stmt);
				}
				catch(Exception $e){
					report($e);
					exit("Error");
				}
				if( $result1 or !$result2 ){		//If the condition is satisfied then the student won't be allowed to take the test.
					echo 'disabled';
				}
				
				CloseCon($conn);
				
				
				echo '>Start test</button></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>



';
}
?>