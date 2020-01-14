<?php
session_start();





//This file displays the question that has been selected in del-a-ques2.php
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



	$id = $_GET['ques_id']; 			//$id has the question id which will be displayed 
	$chname = $_GET["chapter_del"];		//$chname contains the chapter name of the question.
	

echo '

<html>
<head>
<title>Delete a Question</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="destroy.css">
		<script>
				function myFunc(){
				    var x;
					if (confirm("Are you sure you want to delete this question?") == true)
					{
						document.getElementById("my-form").submit();
					}
				}
			</script>
</head>
<body id="page9">
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
	<h1><b>Delete a Question</b></h1>
<div class="container">
  <form id="my-form" class="form-inline" method="post"  action="del-a-ques4.php">
	<div>
	<input type="text" size="24" placeholder="Correct option" name="ques_id" value="hello" disabled hidden>
	<label for="email">Chapter :</label>
	<input type="text" value="'.$chname.'" disabled><label class="ques">Question:</label>
	<textarea class="box" type="text" placeholder="Problem Statement......" name="mod_stat" disabled>';








	//********Put the problem statement in this echo statement.*********\\
	echo 'This is the question';







	echo '
	</textarea>
	</div>
	<div class="ans">
		<label class="opt">Correct Option :</label>
		<input type="text" size="24" placeholder="Correct option" name="cropt" value="';
		
		
		
		
		
		
		//********Put the correct option in this echo statement.*********\\
		echo 'This is correct option"';









		echo '" disabled>
	</div>
	<div class="tans">
		<label class="opt">Incorrect Options :</label>
			<input type="text" size="24" placeholder="Incorrect option 1" name="incropt1" value="';
			
			
			
			
			
			
			
			
			//********Put the Incorrect option 1 in this echo statement.*********\\
			echo 'This is incorrect option1';
			
			
			
			
			
			
			
			
			echo '" disabled>
			<input type="text" size="24" placeholder= "Incorrect option 2" name="incropt2" value="';
			
			
			
			
			
			//********Put the Incorrect option 2 in this echo statement.*********\\
			echo 'This is incorrect option2';
			
			
			
			
			
			
			
			
			echo '" disabled>
			<input type="text" size="24" placeholder="Incorrect option 3" name="incropt3" value="';
			
			
			
			
			
			//********Put the Incorrect option 3 in this echo statement.*********\\
			echo 'This is incorrect option3';
			
			
			
			
			
			
			
			
			
			
			
			
			//Rest of the code remains unchanged.
			
			
			echo '" disabled>
	</div>
	
	
	<div class="button-container">
		<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button>
		<button type="button" class="btn btn-success" onclick="myFunc()">Delete</button>
	</div>
  </form>
</div>	

</body>
</html>

';
}

?>

