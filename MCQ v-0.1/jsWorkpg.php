<?php
session_start();

//This is the main test page........Please proceed as commented
include 'db_connection.php';

if ( isset($_SESSION['loggedin']) == false ){
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
	
	
	
	$exam_id = $_POST["examId"];		//This is exam id
	$code = $_POST["pCode"];			//This is paper code
	$pname = $_POST["pName"];			//This is paper name..
	
	//exit($exam_id);
	
	
	
	
	

	$conn = OpenCon();

	//$exam_id = $exam_id;
	$student_id = $_SESSION['username'];
	try{
		$conn->autocommit(FALSE);
		$query = "SELECT * FROM student_allocation WHERE student_id = ? AND exam_id = ?";
		execute($conn,$query,"si",[$student_id,$exam_id],$stmt);
		$allocation = get_data($stmt);
		close($stmt);

		$query = "SELECT * FROM student WHERE id = ?";
		execute($conn,$query,"s",[$_SESSION['username']],$stmt);
		$student = get_data($stmt);
		close($stmt);
		if(!$allocation){
			
			$query = "SELECT * FROM exam_question WHERE exam_id = ?";
			execute($conn,$query,"i",[$exam_id],$stmt);
			$quest = get_data($stmt);
			close($stmt);

			$n = count($quest);

			$arr = [];
			for($i = 0 ; $i<$n;$i = $i + 1 ){
				$arr[]=$i;
			}
			shuffle($arr);

			$shuffle = implode(".",$arr);
			$query = "INSERT INTO student_allocation(student_id,exam_id,is_active,shuffle) VALUES (?,?,'1',?)";
			execute($conn,$query,"sis",[$_SESSION['username'],$exam_id,$shuffle],$stmt);
			close($stmt);
			foreach($quest as $value){
				$arr = [];
				for($i = 0 ; $i<4;$i = $i + 1 ){
					$arr[]=$i;
				}
				shuffle($arr);
	
				$shuffle = implode(".",$arr);
				$query = "INSERT INTO exam_mark(student_id,exam_question_id,shuffle) VALUES (?,?,?)";
				execute($conn,$query,"sis",[$_SESSION['username'],$value['id'],$shuffle],$stmt);
				close($stmt);

				$query = "SELECT id FROM exam_choice WHERE exam_question_id = ?";
				execute($conn,$query,"i",[$value['id']],$stmt);
				$cho = get_data($stmt);
				close($stmt);

				$query = "INSERT INTO attempt_choice(student_id,exam_choice_id) VALUES (?,?),(?,?),(?,?),(?,?)";
				execute($conn,$query,"sisisisi",[$_SESSION['username'],$cho[0]['id'],$_SESSION['username'],$cho[1]['id'],$_SESSION['username'],$cho[2]['id'],$_SESSION['username'],$cho[3]['id']],$stmt);
				close($stmt);
			}
			$query = "SELECT * FROM student_allocation WHERE student_id = ? AND exam_id = ?";
			execute($conn,$query,"si",[$student_id,$exam_id],$stmt);
			$allocation = get_data($stmt);
			close($stmt);
		}

		if($allocation[0]['is_active']=='1'){
			$query = "SELECT * FROM exam_question WHERE exam_id = ? ORDER BY id";
			execute($conn,$query,"i",[$exam_id],$stmt);
			$question = get_data($stmt);
			close($stmt);

			$arr = $question;

			$permut = explode(".",$allocation[0]['shuffle']);

			for($i=0;$i<count($permut);$i = $i + 1){
				$arr[$i] = $question[$permut[$i]];
			}


			$query = "SELECT * FROM exam WHERE id = ?";
			execute($conn,$query,"i",[$exam_id],$stmt);
			$exam = get_data($stmt);
			close($stmt);

		}
		else{
			exit("already taken");
		}
		$conn->autocommit(TRUE);
	}
	catch(Exception $e){
		$conn->rollback();
		report($e);
	}

	

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
		<script src="scrimba.js"></script>
		<link rel="stylesheet" type="text/css" href="scrimbacss1.css">

	</head>
	<body onload="setInterval(onTimerElapsed, 1000);">
	
	
	<input id="no_ques" type="text" value="';
	
	
	//Put the total no of questions here.............
	echo count($permut);
	
	
	
	echo '" readonly hidden>
	
	
	<input id="xmid" type="text" value="'.$exam_id.'" readonly hidden>
	

	<div id="initial-head">
	<nav>
		<div class="nav-wrapper orange accent-3 z-depth-4">
			<a class="brand-logo center ">OpenCQ test Platform</a>
			<div class="tlogo" style=" ">
				<img class="logo" src="logo256.png" width="100%" alt="Avatar"></img>  
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
					SUBMIT <i class="material-icons right">navigate_next</i></a></li>
					</ul>
					<div class="tlogo" style=" ">
						<img class="logo" src="logo256.png" width="100%" alt="Avatar"></img>  
					</div>		
				</div>
			</nav>
			<div class="div-timer">
        <label class="class-label class1">Name : </label><label class="class-label time">';
		
		
		//Put the students name here............
		echo $student[0]['name'];
		
		
		
		echo '</label>
        <label class="class-label class2">Roll No : </label><label class="class-label time">';
		
		
		
		//Put the Students Roll no here.............
		echo $student[0]['id'];
		
		
		$now = time();
		$start = $exam[0]['start_time'];
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
		
<div class="col s12 m6 l4">
	<div class="card" >
		<div class="card-tabs">
			<ul class="tabs tabs-fixed-width">';
			
			
			
			$len = count($permut);		//Put the total no of question here........
			
			
			//Please donot do anything within this for loop.
			for($i=1;$i<=$len;$i++){
				echo '<li class="tab" id="tab'.$i.'"';
				if($i==1)
				echo 'style="background-color: #ffd699;"';
				echo '>
					<a id="htab'.$i.'" href="#test'.$i.'" class="active" onclick="color_tab(\''.$i.'\')" style="color: #cc5200;"><b>Question '.$i.'</b></a></li>
					';			
			}
			echo '
			</ul>
		</div>';
		
		
		
		
		$ct = 1;	//Donot delete this variable..............
	
	
		foreach($arr as $value){
			
			
			echo '
	
	<div id="test'.$ct.'">
		<div class="card-content">
			<div><b>Question '.$ct.' :</b></div>
			<input id="ques_id1" type="text" value="';
			
			
			
			//put the question id here...........
			echo $value['id'];
			
			
			
			
			echo '" readonly hidden>
			<blockquote><p>';
			
			
			
			//Put the question statement here............
			echo $value['name'];
			
			
			
			
			echo '
			</p></blockquote>
			<img  src="';
			
			
			//Put the image location/url here............if there is no image or url then print nothing.....
			echo $value['url'];
			
			
			echo '">
     
			
			
			<br><br>
			
			<p><label><input class="with-gap" type="radio" value="';
			
			$query = "SELECT * FROM exam_choice WHERE exam_question_id = ? ORDER BY is_right DESC";
			execute($conn,$query,"i",[$value['id']],$stmt);
			$choice = get_data($stmt);
			close($stmt);

			$query = "SELECT shuffle FROM exam_mark WHERE exam_question_id = ?";
			execute($conn,$query,"i",[$value['id']],$stmt);
			$shuffle = get_data($stmt);
			close($stmt);

			$p = $choice;

			$per = explode(".",$shuffle[0]['shuffle']);

			for($i=0;$i<count($per);$i = $i+1){
				$p[$i]=$choice[$per[$i]];
			}
			
			//Put the option1 id here........
			echo $p[0]['id'];
			
			
			
			echo '" name="option'.$ct.'"/><span>';
			
			
			
			//Put the option1 name here............
			echo $p[0]['name'];
			
			
			
			echo '</span></label></p>
            <p><label><input class="with-gap" type="radio" value="';
			
			
			//Put the option2 id here........
			echo $p[1]['id'];
			
			
			echo '" name="option'.$ct.'"/><span>';
			
			
			
			//Put the option2 name here............
			echo $p[1]['name'];
			
			
			
			echo '</span></label></p>
            <p><label><input class="with-gap" type="radio" value="';
			
			
			
			//Put the option 3 id here............
			echo $p[2]['id'];
			
			
			
			echo '" name="option'.$ct.'"/><span>';
			
			
			
			//Put the option3 name here............
			echo $p[2]['name'];
			
			
			
			echo '</span></label></p>
            <p><label><input class="with-gap" type="radio" value="';
			
			
			
			
			//Put  the option 4 id here............
			echo $p[3]['id'];
			
			
			
			echo '" name="option'.$ct.'"/><span>';
			
			
			
			//Put  the option 3 name here............
			echo $p[3]['name'];
			
			
			
			echo '</span></label></p>
				
			<br>
			
			
			<div id="trt'.$ct.'" class="ack green" style=""></div>
			
			<br>
			
			<div class="container">
				<div class="button-properties">
					<button class="btn waves-effect waves-light" type="button" onclick="save_opt(\''.$ct.'\',\'';
					
					
					
					//Put the question id here again............
					echo $value['id'];
					
					
					
					
					echo '\')">Save
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
				
				
		</div>  

	</div>';
	
	
	
			$ct+=1;
	
		}
	
	
	
	
	
			echo '</div>
			</div>
		</div>

		
		<div id="warning_message" class="initial" style="display: none;">
			<label class="class-label time" style="font-size: 30;">Please return to the Full Screen mode within </label><label class="class-label time" id="time" style="color: red;font-size: 30;">6</label><label class="class-label time" style="font-size: 30;"> secs.</label><br>
			<br>
			<button type="button" class="btn orange free" onclick="openFullscreen()">Go Full Screen</button>
		</div>
		
		<div id="final_message" class="initial" style="display: none;margin-bottom: 240px;">
			<label class="class-label time" style="font-size: 30;">Thankyou! Your response has been submitted.</label><br>
		</div>
		

		
		<footer class="page-footer  deep-purple darken-4" style="height: 45px;margin-top:auto;">
            <div class="container" style="margin-top: 0px;">
            © 2020 OpencQ by  aymuos , asarynal , rishUV and rash42
            </div>
		</footer>
		

		
	</body>
</html>	
		
		
		
		
';



}

?>	
		
		
		
		
		
		
