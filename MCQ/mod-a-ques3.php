<?php
include 'db_connection.php';
session_start();


//This file displays the question that has been selected in mod-a-ques2.php
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



	$id = $_GET['ques_id']; 			//id has the question id which will be displayed 
	$chname = $_GET["chapter_del"];		//This contains the chapter name of the question.
	$chid = get_id($chname);
	$correct = "1";
	$incorrect = "0";
	err("id = ".$id."\n");
	err("chname = ".$chname."\n");

echo '

<html>
<head>
<title>Modify a Question</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="destroy.css">
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
	<h1><b>Modify a Question</b></h1>
<div class="container">
  <form class="form-inline" method="post"  action="mod-a-ques4.php">
	<div>
<input type="text" size="24" name="old_chap" value="';
 echo $chname;
 echo '" readonly hidden>
 <input type="text" size="24" name="ques_id" value="';
 

 
 
 //Please put the question id here.
 echo $id;
 
 
 
 echo '" readonly hidden>
	<label for="email">Chapter <span style="color:red;">*</span></label>
	<select class="del-form-control" name="chapter-del">';
	
	
	
	$conn = OpenCon();
	try{
		$query = "SELECT chapter FROM chapters";
		execute($conn,$query,"",[],$stmt);
		$chapters = get_data($stmt);
		close($stmt);
		#CloseCon($conn);
		$query = "SELECT question FROM questions WHERE question_id = ?";
		execute($conn,$query,"s",[$id],$stmt);
		$questions = get_data($stmt);
		close($stmt);
		$query = "SELECT choice FROM choices WHERE question_id = ? AND is_right = ?";
		execute($conn,$query,"ss",[$id,$correct],$stmt);
		$choices = get_data($stmt);
		close($stmt);
		execute($conn,$query,"ss",[$id,$incorrect],$stmt);
		$choices = array_merge($choices,get_data($stmt));
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
		
		
		
		//"$current_chapter" contains name of the chapter in the ith iteration.
		$current_chapter = $row['chapter'];
		if($current_chapter == $chname){
			echo '<option selected>';
		}
		else{
			echo '<option>';
		}
		
		
		
		
		//Please put the i th chapter's name in this echo statement.
		echo $row['chapter'];
		
		
		echo '</option>';
	}
			
			

	
	
	
	echo '</select><label class="ques">Question:</label>
	<textarea class="box" type="text" placeholder="Problem Statement......" name="mod_stat" >';








	//********Put the problem statement in this echo statement.*********\\
	echo $questions[0]['question'];







	echo '
	</textarea>
	</div>
	<div class="ans">
		<label class="opt">Correct Option<span style="color:red;"> *</span> :</label>
		<input type="text" size="24" placeholder="Correct option" name="cropt" value="';
		
		
		
		
		
		
		//********Put the correct option in this echo statement.*********\\
		echo $choices[0]['choice'];









		echo '" required>
	</div>
	<div class="tans">
		<label class="opt">Incorrect Options :</label>
			<input type="text" size="24" placeholder="Incorrect option 1" name="incropt1" value="';
			
			
			
			
			
			
			
			
			//********Put the Incorrect option 1 in this echo statement.*********\\
			echo $choices[1]['choice'];
			
			
			
			
			
			
			
			
			echo '"></textarea>
			<input type="text" size="24" placeholder= "Incorrect option 2" name="incropt2" value="';
			
			
			
			
			
			//********Put the Incorrect option 2 in this echo statement.*********\\
			echo $choices[2]['choice'];
			
			
			
			
			
			
			
			
			echo '"></textarea>
			<input type="text" size="24" placeholder="Incorrect option 3" name="incropt3" value="';
			
			
			
			
			
			//********Put the Incorrect option 3 in this echo statement.*********\\
			echo $choices[3]['choice'];
			
			
			
			
			
			
			
			
			
			
			
			
			//Rest of the code remains unchanged.
			
			
			echo '"></textarea>
	</div>
	
	
	<div class="button-container">
		<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button>
		<button type="submit" class="btn btn-success">Modify</button>
	</div>
  </form>
</div>	

</body>
</html>

';
}

?>

