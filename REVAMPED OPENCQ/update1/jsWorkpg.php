<?php
session_start();
require('sender_header.php');
//This is the main test page........Please proceed as commented


if ( isset($_SESSION['loggedinstudent']) == false ){
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
	$username=$_SESSION['usernamestudent'];  
	$api_name="student_participate.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $_SESSION["passwordstudent"],
					"examId" => $_GET["e"]
				);
	
	$result = send_post_request($url.$api_name,$data);
	$sinfo = json_decode($result);
//	echo $result;
	

	$api_name="question_paper.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $_SESSION["passwordstudent"],
					"examId" => $_GET["e"]
				);
	
	$data = send_post_request($url.$api_name,$data);
	$questions = json_decode($data);
	
	
//	echo $data;
	
//	echo htmlspecialchars_decode("&lt;span style=&quot;font-family: &amp;quot;Comic Sans MS&amp;quot;;&quot;&gt;Please enter the incorrect option 2 here.&lt;/span&gt;");
	
	

	echo '
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<title>Test Page</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="js/scrimba.js"></script>
		<link rel="stylesheet" type="text/css" href="css/scrimbacss1.css">

	</head>
	<body onload="setInterval(onTimerElapsed, 1000);">
	

	

	

	<div id="initial-head">
	<nav>
		<div class="nav-wrapper orange accent-3 z-depth-4">
			<a class="brand-logo center ">OpenCQ test Platform</a>
			<div class="tlogo" style=" ">
				<img class="logo" src="img/logo256.png" width="100%" alt="Avatar"></img>  
			</div>		
		</div>
	</nav>
	</div>
	
	

	
		<div id="initial_message" class="initial">
			<label class="class-label time" style="font-size: 30;">You have to go Full Screen mode Immediately.</label><br><br>
			<button type="button" class="btn orange free" onclick="openFullscreen()">Go Full Screen</button>
		</div>
		
		
		
		
		
		
		
		<div id="exam_page" style="display: none;">
			<nav>
				<div class="nav-wrapper orange accent-3 z-depth-4">
					<a href="#" class="brand-logo center ">OpenCQ test Platform</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li> <a class="waves-effect waves-light btn grey darken-4" onclick="submit_paper()">
					END <i class="material-icons right">navigate_next</i></a></li>
					</ul>
					<div class="tlogo" style=" ">
						<img class="logo" src="img/logo256.png" width="100%" alt="Avatar"></img>  
					</div>		
				</div>
			</nav>
			<div class="div-timer">
        <label class="class-label class1">Name : </label><label class="class-label time">';
		
		
		//Put the students name here............
		echo $_SESSION['name'];
		
		
		
		echo '</label>
        <label class="class-label class2">Roll No : </label><label class="class-label time">';
		
		
		
		//Put the Students Roll no here.............
		echo $_SESSION['username'];
		
		
		$now = time();
		$start = $_GET["t"];
		$sec = $now - $start;
		$min = floor($sec/60);
		$sec = $sec%60;
		$hour = floor($min/60);
		$min = $min%60;


		
		echo '</label>
        <label class="class-label class3">Time Elapsed : </label><label class="class-label time">
				<label id="hrs" class="class-label time">';
				
				
				//Put the number of hours elasped here............
				if($hour<10){
					echo '0'.$hour;
				}
				else{
					echo $hour;
				}
				
				
				
				echo '</label> : 
				<label id="mins" class="class-label time">';
				
				
				
				//Put the no of minutes elasped here...........
				if($min<10){
					echo '0'.$min;
				}
				else{
					echo $min;
				}
				
				
				
				echo '</label> : 
				<label id="secs" class="class-label time">';
				
				
				//Put the no of secs elasped here..........
				if($sec<10){
					echo '0'.$sec;
				}
				else{
					echo $sec;
				}
				
				
				echo '</label>
			</label>
    </div>
		
 <div class="card">
    <div class="card-content">
      <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
    </div>
    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width">
        <li class="tab"><a href="#test4">Test 1</a></li>
        <li class="tab"><a class="active" href="#test5">Test 2</a></li>
        <li class="tab"><a href="#test6">Test 3</a></li>
      </ul>
    </div>
    <div class="card-content grey lighten-4">
      <div id="test4">
		<div>'.htmlspecialchars_decode($questions->result[0]->question).'</div>
		<div>'.htmlspecialchars_decode($questions->result[0]->option1).'</div>
		<div>'.htmlspecialchars_decode($questions->result[0]->option2).'</div>
		<div>'.htmlspecialchars_decode($questions->result[0]->option3).'</div>
		<div>'.htmlspecialchars_decode($questions->result[0]->option4).'</div>
	
	</div>
      <div id="test5">Test 2</div>
      <div id="test6">Test 3</div>
    </div>
  </div>';
	
	
	
	
	

	
	
	
	
	
			echo '

		
		<div id="warning_message" class="initial" style="display: none;">
			<label class="class-label time" style="font-size: 30;">Please return to the Full Screen mode within </label><label class="class-label time" id="time" style="color: red;font-size: 30;">6</label><label class="class-label time" style="font-size: 30;"> secs.</label><br>
			<br>
			<button type="button" class="btn orange free" onclick="openFullscreen()">Go Full Screen</button>
		</div>
		
		<div id="final_message" class="initial" style="display: none;margin-bottom: 240px;">
			<label class="class-label time" style="font-size: 30;">Thank you! Your response has been submitted.</label><br>
		</div>
		

		
		<footer class="page-footer deep-purple darken-4" style="height: 20px;padding-top: 0px">
            <div class="container">
            © 2020 OpencQ by  Soumya Mukherjee , Rishav Banerjee , Saranya Naha Roy and Rashed Mehdi (CSE 2017-2021)
            </div>
		</footer>  
		

		
	</body>
</html>	
		
		
		
		
';



}

?>	
		
		
		
		
		
		
