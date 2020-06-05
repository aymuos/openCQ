<?php
session_start();
require('sender_header.php');
//This is the main test page........Please proceed as commented


if ( isset($_SESSION['loggedinstudent']) == false ){
echo ' 

<html>
<head>
<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
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
	
	$_SESSION['ti'] = $_GET["e"];
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
	
	$len = 0;
	if($questions->status == "OK")
	$len = count($questions->result);
	
	// echo $data;
	
//	echo htmlspecialchars_decode("&lt;span style=&quot;font-family: &amp;quot;Comic Sans MS&amp;quot;;&quot;&gt;Please enter the incorrect option 2 here.&lt;/span&gt;");
	
	

	echo '
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
		<title>Test Page</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="js/scrimba.js"></script>
		<link rel="stylesheet" type="text/css" href="css/scrimbacss1.css">

	  <script>
		var len = '.$len.';
	  </script>
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
	</div>';
	
	
	
	
	if($questions->status == "OK"){
	
	














	
		echo '<div id="initial_message" class="initial">
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
				<label class="class-label class1">Name : </label><label class="class-label time">'.$_SESSION['name'].'</label>
				<label class="class-label class2">Roll No : </label><label class="class-label time">'.$_SESSION['username'];
		
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
    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width">';
	  
		
		for($i=1;$i<=$len;$i++){
			echo '<li class="tab" id="tab'.$i.'"';
			if($questions->result[$i-1]->{'marked option'} != "option0")echo 'style="background-color: hsla(162, 75%, 52%, 0.575)"';
			else if($i==1)
				echo 'style="background-color: #ffd699;"';
			
			
			echo '><a id="htab'.$i.'" href="#test'.$i.'" class="active" onclick="color_tab(\''.$i.'\')"';

			if($questions->result[$i-1]->{'marked option'} != "option0")echo 'style="color: #666666;"';
			else echo 'style="color: #cc5200;"';
			
			echo '><b>Question '.$i.'</b></a></li>';
		}
	  
      echo '</ul>
    </div>
    <div class="card-content">';
      
	  
	  
	  
	  for($i=1;$i<=$len;$i++){
		echo '<div id="test'.$i.'">
			<div class="row">
				<div class="col s8">
					<b>Question '.$i.' :</b>
				</div>
				<div class="col s4">
					<b>[Correct : </b>'.($questions->result[$i-1]->{'marks when correct'}).' marks , <b>Incorrect : </b>'.($questions->result[$i-1]->{'marks when wrong'}).' marks<b>]</b>
				</div>
			</div>
			
			
			
			
			
			
			
			<blockquote>
			<div>'.htmlspecialchars_decode($questions->result[$i-1]->question).'</div></blockquote>
			
			<br>
			
			<div class="total" id="q'.$i.'o1">
				<div class="custom-left">
					<label>
						<input id="iq'.$i.'o1" class="with-gap" name="group'.$i.'" type="radio"';

					if($questions->result[$i-1]->{'marked option'} == 'option1')echo 'checked="true"';

					echo ' >
						<span></span>
					</label>	
				</div>
				<div class="custom-right" >'.htmlspecialchars_decode($questions->result[$i-1]->option1).'</div>
			</div>
			
			
			
			
			
			
			<div class="total" id="q'.$i.'o2">
				<div class="custom-left">
					<label>
						<input id="iq'.$i.'o2" class="with-gap" name="group'.$i.'" type="radio"  ';

					if($questions->result[$i-1]->{'marked option'} == 'option2')echo 'checked="true"';

					echo '>
						<span></span>
					</label>
				</div>
				<div class="custom-right" >'.htmlspecialchars_decode($questions->result[$i-1]->option2).'</div>
			</div>
			
			
			
			<div class="total" id="q'.$i.'o3">
				<div class="custom-left">
					<label>
						<input id="iq'.$i.'o3" class="with-gap" name="group'.$i.'" type="radio" ';

					if($questions->result[$i-1]->{'marked option'} == 'option3')echo 'checked="true"';

					echo ' >
						<span></span>
					</label>
				</div>
				<div class="custom-right" >'.htmlspecialchars_decode($questions->result[$i-1]->option3).'</div>
			</div>
			
			
			
			<div class="total" id="q'.$i.'o4">
				<div class="custom-left">
					<label>
						<input id="iq'.$i.'o4" class="with-gap" name="group'.$i.'" type="radio" ';

					if($questions->result[$i-1]->{'marked option'} == 'option4')echo 'checked="true"';

					echo '  >
						<span></span>
					</label>
				</div>
				<div class="custom-right" >'.htmlspecialchars_decode($questions->result[$i-1]->option4).'</div>
			</div>
			
			
			
			<div class="container" style="margin-top: 70px;">
				<div class="button-properties">
					<button class="btn waves-effect waves-light" type="button" onclick="save_opt(\''.$i.'\')">Save
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
			
			
			
			
		
			
		</div>';
		
		
		
	  }
      
	  echo '
    </div>
  </div>
  </div>

		
		<div id="warning_message" class="initial" style="display: none;">
			<label class="class-label time" style="font-size: 30;">Please return to the Full Screen mode within </label><label class="class-label time" id="time" style="color: red;font-size: 30;">6</label><label class="class-label time" style="font-size: 30;"> secs.</label><br>
			<br>
			<button type="button" class="btn orange free" onclick="openFullscreen()">Go Full Screen</button>
		</div>
		

		<div id="final_message" class="initial" style="display: none;margin-bottom: 318px;">
			<label class="class-label time" style="font-size: 30;">Thank you! Your response has been submitted.</label><br>
		</div>
		

		
		<footer class="page-footer deep-purple darken-4" style="height: 20px;padding-top: 0px">
            <div class="container">
            © 2020 OpencQ by  Soumya Mukherjee , Rishav Banerjee , Saranya Naha Roy and Rashed Mehdi (CSE 2017-2021)
            </div>
		</footer> ';
		
		
	}
	else{
		
		if($questions->comment == "further submission is not allowed")$str = "Thank you! Your response has been submitted.";
		else $str = $questions->comment;
		
		echo '<div id="final_message" class="initial" style="margin-bottom: 318px;">
			<label class="class-label time" style="font-size: 30;">'.$str.'</label><br>
		</div>
		

		
		<footer class="page-footer deep-purple darken-4" style="height: 20px;padding-top: 0px">
            <div class="container">
            © 2020 OpencQ by  Soumya Mukherjee , Rishav Banerjee , Saranya Naha Roy and Rashed Mehdi (CSE 2017-2021)
            </div>
		</footer> ';
		
	}
		

		
	echo '</body>
</html>	
		
		
		
		
';



}

?>	
		
		
		
		
		
		
