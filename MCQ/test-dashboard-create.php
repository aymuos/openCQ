<?php
session_start();




//user can create a new test using this file.
//Proceed to the else part directly.


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
<title>Test Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="destroy.css">
		<style>
			table, th, td {
				background-color: white;
			}
		</style>

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
	
	<h1><b>Test Dashboard</b></h1>
	

<div class="container">
	<form class="form-inline" method="post"  action="test-dashboard-create2.php">
	<label style="float: left;">Test Id : &emsp;</label><input name="ti" style="float: left;" value="';
	
	
	
	
	
	//Put newly generated test id in this echo statement
	echo "Test_id";



	
	
	echo '" readonly>
	<input class="inpdate" name="date" type="date">
	<label class="inpdate">Date : &emsp;</label><br><br><br>
	<label style="float: left;">Test Description :</label><br>
	<textarea name="desc"></textarea><br><br><br>
	
	
	
	<label style="float: left;">No of Questions <span style="color:red;">*</span> :&emsp;</label>
	<input style="float: left;" name="lent" type="number" min="1" required><br><br><br>
	
	
	<label style="float: left;">Select the Chapters :</label>     
  <table class="table table-condensed">
  <col width="75%">
  <col width="25%">
    <thead>
      <tr>
        <th>Chapter\'s Name</th>
        <th>Check to Include</th>
      </tr>
    </thead>
    <tbody>';
	
	
	
	
	//please do not delete this variable.
	$ct = 1;
	
	
	//Loops till the total no of chapter.
	for ($i = 1; $i <= 10 ; $i++){
	echo '
      <tr>
        <td>';
		
		
		
		//Please put the chapter's name in this echo statement.
		echo 'chapter\'s name';
		
		
		
		
		echo '</td>
        <td style="text-align: center"><input name="chappie';
		echo $ct;
		echo '" type="checkbox" value="';
		
	

	
		//Please put the chapter's names AGAIN in this echo statement
		echo 'please put the chapter\'s name here'.$i;
		
		
		
		
		
		
		echo '"></td>
      </tr>
      <tr>';	  
	  $ct += 1;
	  
	}
       	  
	  //Rest of the code remains same
	  
	  
	  
	echo '
    </tbody>
  </table>
	<div class="button-container">
		<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button>
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
	</form>
</div>

</body>
</html>

';

}

?>