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
	$conn = OpenCon();
	$ch = $_GET["ch"];		//This is the chapter's name whose questions has to be displayed
	$test_id = $_GET["ti"]; //This is the test id.......

echo '
<html>
<head>
<title>Test Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="question_paper_css.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script>
			function saveFunc(){
				
				var x = "'.$ch.'";
				x = encodeURIComponent(x);
				var str = "question_paper_update.php?ti='.$test_id.'&ch=" + x + "&";
				var radios = document.getElementsByName(\'opt\');		
				var x = "q";
				for (var i = 0, length = radios.length; i < length; i++) {
					if (radios[i].checked) {
						temp = radios[i].value ;
					}
					else{
						temp = -1;
					}
					str = str + x + (i+1) + "=" + temp + "&";
				}
				window.location.href = str;
			}
	
		</script>

		
		
</head>
<body>

<div class="some">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
				<img class="logo" border="50" src="avatar.png" alt="Avatar"></img>  <!--This is the image for top left icon -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<!--This is the heading which is on the left side-->
					<font face="verdana" color="white" size="6.5px" > Dashboard</font> 
					<!-- Here you can add any more heading which is to be included on the left side-->
						
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
					
						<!--These are the heading which is on the right side -->
						<!--Span tag is used for including the icon which is beside "Account"/"logout" string  -->
						<li><a href="#"><p class="link"><span class="glyphicon glyphicon-user"></span> Account</p></a></li>
						<li><a href="logout-student.php"><p class="link"><span class="glyphicon glyphicon-log-in"></span> Logout</p></a></li>
						<!-- Here you can add any more heading which is to be included on the right side-->
						
					</ul>
				</div>
			</div>
		</nav>
	</div>
    
    <div class="code">
	<div class="well">
        <p class="name"><b>Subject Code</b> '.$_SESSION["sub_code"].'</p>
    </div>
    <div class="well name2">
        <p class="name"><b>Paper Name</b><br>'.$_SESSION["paper_name"].'</p>
    </div>
		<!-- <div class="well counter">
            <p class="name"><b>Questions Selected</b><br></p>
            <input class="box" type="text" value="8" readonly>
	</div> -->
    <div class="div-button">
		<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="func()">Preview</button> -->
    </div>
    </div>








<div class="card">
	<h1 class="header"><b>Please Select the Questions to Add</b></h1><hr>


    <table class="table table-condensed">
		<col width="75%">
		<col width="25%">
		<thead>
			<tr>
				<th>Questions</th>
				<th>Check to Include</th>
			</tr>
		</thead>
		<tbody>';
		
		$query = "SELECT * FROM question WHERE chapter_id = ?";
		execute($conn,$query,"i",[$ch],$stmt);
		$res = get_data($stmt);
		close($stmt);
		
		foreach($res as $value){
		
			$st = $value['name'];
		
			echo '<tr>
				<td>';
				
				
				//Put the question here.............
				echo $value['name'];
				
				
				
				echo '</td>
				<td style="text-align: center"><input class="check-box" name="opt" type="checkbox" value="'.$value['id'].'"></td>
			</tr>';
			
			
		}
			echo '
		</tbody>
	</table>



	<div class="div-preview next">
		<button class="btn btn-danger" onclick="window.location.href = \'question_paper.php?test_id='.$test_id.'\'">Back</button>
		<button class="btn btn-success" onclick="saveFunc()">Add</button>
	</div>




</div>







	
	
</body>
';


}



?>