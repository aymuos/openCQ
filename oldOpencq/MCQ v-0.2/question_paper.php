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
			function display(ques_id,prob_st,opt1,opt2,opt3,opt4,img_url){
				document.getElementById("p1").value = prob_st;
				document.getElementById("img_disp").src = img_url;
				document.getElementById("opt1").innerHTML = "a) "+ opt1;
				document.getElementById("opt2").innerHTML = "b) "+ opt2;
				document.getElementById("opt3").innerHTML = "c) "+ opt3;
				document.getElementById("opt4").innerHTML = "d) "+ opt4;
			}
			function delete_func(ques_id){
				if (confirm("Are you sure you want to delete this question?")) {
					window.location.href = "question_paper3.php?ti='.$test_id.'&q=" + encodeURIComponent(ques_id);
				}
			}
			function submit(){
				x = document.getElementById("cntr").value;
				if (confirm("You have selected " + x + " number of questions. Are you sure you want to Submit ?\nNote : Once submitted you cannot change the questions." )) {
					window.location.href = "question_paper_submit.php?ti='.$test_id.'";
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
		$conn = OpenCon();
		//exit("hamba");
		try{
			$subid = $_SESSION['sub_code'];
			//exit("$subid");
			$query = "SELECT * FROM subject WHERE id = ?";
			execute($conn,$query,"s",[$subid],$stmt);
			$res = get_data($stmt);
			close($stmt);
			
			//exit("hamba");
			$query = "SELECT * FROM exam_question WHERE exam_id = ?";
			execute($conn,$query,"i",[$test_id],$stmt);
			$res2 = get_data($stmt);
			close($stmt);

			$query = "SELECT * FROM exam WHERE id = ?";
			execute($conn,$query,"i",[$test_id],$stmt);
			$res4 = get_data($stmt);
			//exit($res4[0]['id']);
			close($stmt);
			//echo $res4[0]['id'];


		}
		catch(Exception $e){
			report($e);
		}
		
		//exit("hamba");
		//Please put paper code here........
		echo $subid;
		//echo $res4[0]['id'];
		
		echo '</p>
    </div>
    <div class="well name2">
        <p class="name"><b>Paper Name</b><br>';
		
		
		//Please put paper's name here.........
		echo $res[0]['name'];
		
		$ct = $res4[0]['is_active'];
		
		
		echo '</p>
    </div>
		<div class="well counter">
            <p class="name"><b>Questions Selected</b><br></p>
            <input id="cntr" class="box" type="text" value="';
			
			
			//Please put the total no of selected question here...............
			echo count($res2);
			
			
			//$res[0]['is_active'];
			echo '" readonly>
	</div>
    <div class="div-button">
        <button type ="button" class="btn btn-success button" data-toggle="modal" data-target="#myModal" onclick="func()">Add</button>
    </div>
    </div>








<div class="card">
	<h1 class="header"><b>Questions</b></h1><hr>';
	
	
	//$res[0]['is_active'];
	
	foreach($res2 as $value){
		
		
		echo '

    <div class="question_area">
         <div class="well chapter">
              <p class="name">';
			  
			  
			  
			  //Please put the chapter's name here.....
			  echo $value['chapter_name'];
			  
			  
			  
			  
			  echo '</p>
        </div>
			<div class="well qa_question">
				<textarea class="question_name" type="text" readonly>';
				
				
				
				
				//Please put the problem statement here.........
				echo $value['name'];
				
				
				
				
				echo '</textarea>
			<div class="delete">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2" onclick="display(';
				
				
				//Please put question id here........
				echo $value['id'];
				
				echo ',\'';
				
				
				
				//please put problem statement here again........
				echo $value['name'];
				
				
				echo '\',\'';
				try{
					$query = "SELECT * FROM exam_choice WHERE exam_question_id = ? ORDER BY is_right DESC";
					execute($conn,$query,"i",[$value['id']],$stmt);
					$res3 = get_data($stmt);
					close($stmt);

				}
				catch(Exception $e){
					report($e);
				}
				
				//Please put option 1 here..........
				echo $res3[0]['name'];
				
				
				echo '\',\'';
				
				
				//Please put option 2 here..........
				echo $res3[1]['name'];
				
				
				echo '\',\'';
				
				
				//Please put option 3 here..........
				echo $res3[2]['name'];
				
				
				echo '\',\'';
				
				
				//Please put option 4 here..........
				echo $res3[3]['name'];
				
				
				echo '\',\'';
				
				
				//Put the image url here............
				echo $value['url'];
				
				
				echo '\')">Preview</button>
				<button class="btn btn-danger" onclick="delete_func(\'';
				
				//$res[0]['is_active'];
				
				//Please put the question id here again.............
				echo $value['id'];
				
				
				
				echo '\')">Delete</button>
			</div>
            
        </div>
    </div>
	';
	
	
	}
    
	
	
	echo '
	<div class="div-preview">
		<button class="btn btn-danger btn-down" onclick="window.location.href = \'master-dashboard.php\'">Back</button>
		<button class="btn btn-primary btn-down" onclick=" window.open(\'preview_question_paper.php?ti='.$test_id.'\',\'_blank\')">Preview Question Paper</button>
		<button class="btn btn-success btn-down" onclick="submit()"';
		
		
		//$ct= $res[0]['is_active'];
		if($ct=='0'){
			echo '';		//This if statement satisfies if teacher has not yet submitted the question paper.
			
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
		
		//exit("hamba");
		$query = "SELECT id,name FROM chapter WHERE subject_id = ? AND teacher_id = ?";
		execute($conn,$query,"ss",[$_SESSION['sub_code'],$_SESSION['usernamemaster']],$stmt);
		$chappy = get_data($stmt);
		close($stmt);
		
		
		
		
		foreach($chappy as $value){
		
		echo '
			<option value="';
			
			
			//Echo chapter id here.........
			echo $value['id'];
			
			
			
			echo '">';
			
			
			//Echo chapter;s name here........
			echo $value['name'];
			
			
			
			echo '</option>';
			
			
			
		}
		
		
		
			echo '</select>
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
		<img id="img_disp" class="image_class" src="">
		
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