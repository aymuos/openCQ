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
	
	$test_id = $_GET["test_id"];	//This is the test id whose questions has to be displayed.....
	
	
echo '
<html>
<head>
<title>Welcome</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="question_paper_css.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		
		<script>
			function go(){
				var x = document.getElementById("select_ch").value;
				window.location.href = "question_paper2.php?ti='.$test_id.'&ch=" + encodeURIComponent(x); 
			}
			function display(ques_id,prob_st,opt1,opt2,opt3,opt4){
				document.getElementById("p1").value = prob_st;
				document.getElementById("opt1").innerHTML = "a) "+ opt1;
				document.getElementById("opt2").innerHTML = "b) "+ opt2;
				document.getElementById("opt3").innerHTML = "c) "+ opt3;
				document.getElementById("opt4").innerHTML = "d) "+ opt4;
			}
			function delete_func(ques_id){
				if (confirm("Are you sure you want to delete this question?")) {
					window.location.href = "question_paper3.php?q=" + encodeURIComponent(ques_id);
				}
			}
			function submit(){
				x = document.getElementById("cntr").value;
				if (confirm("You have selected " + x + " number of questions. Are you sure you want to Submit ?\nNote : Once submitted you cannot change the questions." )) {
					window.location.href = "question_paper_submit.php";
				}
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
        <p class="name"><b>Subject Code<br></b>';
		
		
		//Please put paper code here........
		echo 'CS205';
		
		
		echo '</p>
    </div>
    <div class="well name2">
        <p class="name"><b>Paper Name</b><br>';
		
		
		//Please put paper's name here.........
		echo 'Data Sructure and Algorithm Design';
		
		
		
		echo '</p>
    </div>
		<div class="well counter">
            <p class="name"><b>Questions Selected</b><br></p>
            <input id="cntr" class="box" type="text" value="';
			
			
			//Please put the total no of selected question here...............
			echo '8';
			
			
			
			echo '" readonly>
	</div>
    <div class="div-button">
        <button type ="button" class="btn btn-success button" data-toggle="modal" data-target="#myModal" onclick="func()">Add</button>
    </div>
    </div>








<div class="card">
	<h1 class="header"><b>Questions</b></h1><hr>';
	
	
	
	
	for($ct=1;$ct<=10;$ct++){
		
		
		echo '

    <div class="question_area">
         <div class="well chapter">
              <p class="name">';
			  
			  
			  
			  //Please put the chapter's name here.....
			  echo 'This is chapter 1';
			  
			  
			  
			  
			  echo '</p>
        </div>
			<div class="well qa_question">
				<textarea class="question_name" type="text" readonly>';
				
				
				
				
				//Please put the problem statement here.........
				echo 'This is question 1';
				
				
				
				
				echo '</textarea>
			<div class="delete">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2" onclick="display(';
				
				
				//Please put question id here........
				echo '5';
				
				echo ',\'';
				
				
				
				//please put problem statement here again........
				echo 'This is question';
				
				
				echo '\',\'';
				
				
				//Please put option 1 here..........
				echo 'option 1';
				
				
				echo '\',\'';
				
				
				//Please put option 2 here..........
				echo 'option 2';
				
				
				echo '\',\'';
				
				
				//Please put option 3 here..........
				echo 'option 3';
				
				
				echo '\',\'';
				
				
				//Please put option 4 here..........
				echo 'option 4';
				
				
				echo '\')">Preview</button>
				<button class="btn btn-danger" onclick="delete_func(\'';
				
				
				
				//Please put the question id here again.............
				echo 'question id';
				
				
				
				echo '\')">Delete</button>
			</div>
            
        </div>
    </div>
	';
	
	
	}
    
	
	
	echo '
	<div class="div-preview">
		<button class="btn btn-danger btn-down" onclick="window.location.href = \'master-dashboard.php\'">Back</button>
		<button class="btn btn-primary btn-down" onclick=" window.open(\'preview_question_paper.php?ti=1\',\'_blank\')">Preview Question Paper</button>
		<button class="btn btn-success btn-down" onclick="submit()"';
		
		
		$ct=0;
		if($ct==0){		//This if statement satisfies if teacher has not yet submitted the question paper.
			echo '';
		}
		else{
			echo 'disabled';
		}
		
		
		
		
		//Rest of the code remains same...........
		echo '>Submit</button>
		
	</div>
</div>










<!-- Modal for adding new question asking for chapters-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Please select a chapter</b></h4>
      </div>
      <div class="modal-body">
        <select class="del-form-control" id="select_ch">';
		
		
		for($i = 0; $i<=10 ;$i++){
		
		echo '
			<option value="';
			
			
			//Echo chapter id here.........
			echo '999';
			
			
			
			echo '">';
			
			
			//Echo chapter;s name here........
			echo 'This is chapter 1';
			
			
			
			echo '</option>';
			
			
			
		}
			echo '
		</select>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" onclick="go()">Go</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>






<!-- Modal for questions -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Preview</h4>
      </div>
      <div class="modal-body-question">
        <textarea id="p1" class="boxer" type="text" placeholder="Problem Statement......" name="problem-statement" disabled></textarea><br><br>
		<img id="img_disp" class="image_class" src="';
		
		$ct=1;
		if($ct==1){
			//Put the image url in this echo statement if the question has an image.....else echo nothing.
			echo 'https://i.imgur.com/9OQ7z99.jpg';
		}
		
		
		echo '">
		
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

<!--
<div class="foot">
	<p>openCq by aymuos , rishUV , rash42 , saranya</p>
</div>
-->





</body>

';

}


?>