<?php


//This file takes the question statement and options from the user.
//Please proceed to the else part directly.



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
			var img = document.getElementById("text_box").value;
			var a = document.getElementById("1").value;
			var b = document.getElementById("2").value;
			var c = document.getElementById("3").value;
			var d = document.getElementById("4").value;
			document.getElementById("p1").value = x;
			if(document.getElementById("text_box").disabled == false)
			document.getElementById("img_disp").src = img;
			document.getElementById("opt1").innerHTML = "a) "+ a;
			document.getElementById("opt2").innerHTML = "b) "+b;
			document.getElementById("opt3").innerHTML = "c) "+c;
			document.getElementById("opt4").innerHTML = "d) "+d;
		}
		
		
		
		function check(){
			var checkBox = document.getElementById("chk");
			if(checkBox.checked == true){
				document.getElementById("text_box").disabled = false;
			}
			else{
				document.getElementById("text_box").value = "";
				document.getElementById("text_box").disabled = true;
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
	
	<h1><b>Add a Question</b></h1>
	

<div class="container">
  <form class="form-inline" method="post"  action="add-a-ques2.php">
    <div class="form-group">
      <label for="email">Select the chapter <span style="color:red;">*</span></label>
        <select class="del-form-control" name="chapter-name">
		
		
		
		
		';
		
		
		
		
	//***Please modify this portion to display all the chapters in the dropdown list.***\\\
	
	//Simply take all the chapter's name from the database and display it.
	
	$len = 5;	//"len" contains the total no of chapters to be displayed.
	for($i = 1; $i <= $len ; $i+=1){		
		echo '<option>';
		
		
		//Please put the chapter's name in this echo statement.
		echo $i;
		
		
		echo '</option>';
	}		


	//Rest of the part need not be modified.


	echo '	
	</select>
    </div>
	<div>
	<label class="ques">Question:</label>
	<textarea id="prob-stm" class="box" type="text" placeholder="Problem Statement......" name="problem-statement"></textarea>
	</div>
	
	<div class="check">
		<input type="checkbox" id="chk" onclick="check()">
		<label>Image URL : </label>
		<input id="text_box" name="img_url" type="text" disabled>
	</div>
	
	
	<div class="ans">
		<label class="opt">Correct Option <span style="color:red;">* </span>:</label>
		<input id="1" type="text" size="24" placeholder="Correct option" name="correct" required>
	</div>
	
	<div class="tans">
		<label class="opt">Incorrect Options :</label>
			<input id="2" type="text" size="24" placeholder="Incorrect option 1" name="incorrect1">
			<input id="3" type="text" size="24" placeholder="Incorrect option 2" name="incorrect2">
			<input id="4" type="text" size="24" placeholder="Incorrect option 3" name="incorrect3">
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
        <textarea id="p1" class="box" type="text" placeholder="Problem Statement......" name="problem-statement" disabled></textarea><br><br>
		<img id="img_disp" class="image_class">
			<p id="opt1"></p>
			<p id="opt2"></p>
			<p id="opt3"></p>
			<p id="opt4"></p>
      </div>
      <div class="modal-footer">
		<p class="disc">The final order of the option will change during the test.</p>
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