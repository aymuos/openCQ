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



echo '

<html>
<head>
<title>Add a Question</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="destroy.css">
		<script>
		function func(){
			var x = document.getElementById("prob-stm").value;
			//alert(x);
			document.getElementById("p1").value = x;
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
	
	<h1><b>Add a Question</b></h1>
	

<div class="container">
  <form class="form-inline" method="post"  action="add-a-ques2.php">
    <div class="form-group">
      <label for="email">Select the chapter <span style="color:red;">*</span></label>
        <select class="del-form-control" name="chapter-name">
		
		
		
		
		';
		
		
		
		
	$conn = OpenCon();
 	$conn->set_charset("utf8mb4");
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	try{
		$stmt = $conn->prepare("SELECT * FROM chapters");
		$stmt->bind_param("");
		$stmt->execute();
		$result = $stmt->get_result();
		$len = $result->num_rows;
		while($row = $result->fetch_assoc()){
			$id[] = $row['chapter_id'];
			$chapter[] = $row['chapter'];
		}

		foreach($chapter as $value){		
			echo '<option>';
			
			
			//Please put the chapter's name in this echo statement.
			echo $value;
			
			
			echo '</option>';
		}

	} 
	#$len = 5;	//"len" contains the total no of chapters to be displayed.
	catch(Exception $e){
		#echo $e->get_message();
	}
			
			
	$stmt->close();
	CloseCon($conn);
	//Rest of the part need not be modified.


	echo '	
	</select>
    </div>
	<div>
	<label class="ques">Question:</label>
	<textarea id="prob-stm" class="box" type="text" placeholder="Problem Statement......" name="problem-statement"></textarea>
	</div>
	<div class="ans">
		<label class="opt">Correct Option <span style="color:red;">* </span>:</label>
		<input type="text" size="24" placeholder="Correct option" name="correct" required>
	</div>
	
	<div class="tans">
		<label class="opt">Incorrect Options :</label>
			<input type="text" size="24" placeholder="Incorrect option 1" name="incorrect1">
			<input type="text" size="24" placeholder="Incorrect option 2" name="incorrect2">
			<input type="text" size="24" placeholder="Incorrect option 3" name="incorrect3">
	</div>
	
	
	<div class="button-container">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="func()">Preview</button>
		<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button>
		<button type="submit" class="btn btn-success">Add</button>
	</div>
  </form>
</div>






<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Preview</h4>
      </div>
      <div class="modal-body">
        <textarea id="p1" class="box" type="text" placeholder="Problem Statement......" name="problem-statement" disabled></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>














	

</body>
</html>



';


}

?>