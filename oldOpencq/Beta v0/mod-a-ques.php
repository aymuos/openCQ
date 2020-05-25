<?php
include 'db_connection.php';
session_start();




//This file takes the chapter name from a database and then redirects 
//it to mod-a-ques2.php. Please jump directly to else part .





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
						<li><a href="logout-master.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	
	<h1><b>Modify a Question</b></h1>
	

<div class="container">
  <form class="form-inline" method="post"  action="mod-a-ques2.php">
    <div class="form-group">
      <label for="email">Select the chapter <span style="color:red;">*</span></label>
        <select class="del-form-control" name="chapter-del">
	
						
			
';




	$conn = OpenCon();

	try{
		$query = "SELECT chapter FROM chapters";
		execute($conn,$query,"",[],$stmt);
		$chapters = get_data($stmt);
		close($stmt);
		CloseCon($conn);
	}
	catch(Exception $e){
		exit($e->getMessage());
	}



			
	//***Please modify this portion to display all the chapters in the dropdown list.***\\\
	//Simply take all the chapter's name from the database and display it.
	
	#$len = 5;	//"len" contains the total no of chapters to be displayed.
	foreach($chapters as $row){		
		echo '<option>';
		
		
		//Please put the chapter's name in this echo statement.
		echo $row['chapter'];
		
		
		echo '</option>';
	}
			
			
			
	//Rest of the part remains same.






	echo '
			
		</select>
    </div>
	
	<div class="button-container">
		<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button>
		<button type="submit" class="btn btn-success">Go</button>
	</div>
  </form>
</div>

	
	
	

</body>
</html>




';

}

#echo "End";
?>
