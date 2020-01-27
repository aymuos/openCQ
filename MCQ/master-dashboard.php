<?php
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
<html>
<head>
<title>Welcome</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="destroy.css">
</head>
<body id="page6">
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
	
	<h1><b>Welcome.....Please choose an action.</b></h1>
	
	<div class="button-container">
	<div class="btn-group-vertical">
		<button type="button" class="btn btn-primary " onclick="location.href=\'add-a-chap.php\'">Add a chapter</button>
		<button type="button" class="btn btn-primary" onclick="location.href=\'del-a-chap.php\'">Delete a chapter</button>
		<button type="button" class="btn btn-primary" onclick="location.href=\'add-a-ques.php\'">Add a question</button>
		<button type="button" class="btn btn-primary" onclick="location.href=\'mod-a-ques.php\'">Modify a question</button>
		<button type="button" class="btn btn-primary" onclick="location.href=\'del-a-ques.php\'">Delete a question</button>
		<button type="button" class="btn btn-primary" onclick="location.href=\'view-result.php\'">View Result</button>
		<button type="button" class="btn btn-primary" onclick="location.href=\'test-dashboard.php\'">Test dashboard</button>
		<button type="button" class="btn btn-primary" onclick="location.href=\'resetpsswd.php\'">Password Reset</button>
	</div>
	</div>
</body>
</html>
';
}

?>