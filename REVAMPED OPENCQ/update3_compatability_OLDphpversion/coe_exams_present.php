<?php

require('sender_header.php');
//This displays the running exams..........
//Proceed to the else part directly.......



session_start();
if ( isset($_SESSION['loggedincoe']) == false ){
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
			<p class="text-center">Please <a href="coe-login.html">Login</a> first</p>
		</div>
	</div>
</body>
</html>
';
}
else {

	
$url=location."exam.php";
$data = array(		"key" => key,
					"username" => 'ALL',
					"examStatus" => '1',
					"examId" => 'ALL',
					"code" => 'ALL',
					"batchPassoutYear" => 'ALL',
					"stream" => 'ALL',
					"visible"=>'0'
				);
$result = send_get_request($url,$data);

//echo $result;

$ans = json_decode($result);

echo '

<html>
	<head>
	<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
		<title>COE Dashboard</title>
		
		
		
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- BOOTSTRAP AND MATERIALIZE LIBRARIES-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
    	<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="css/materialize.min.css">
    	<!-- Compiled and minified JavaScript -->
		<!-- end of bootstrap materialize libraries//  create provision for user css-->       
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script> 
		
		
	
		
		<!--user css-->
        <link rel="stylesheet" type="text/css" href="css/temp.css">
		
		
		
		
		
		<script>
			var myVar = setInterval(myTimer, 1000);

			function myTimer() {
				for(i=1;i<=';
				
				
				//Put the no of running test here............
				echo count($ans->{'result'});
				
				
				echo ';i++){	
					var sec = document.getElementById("secs"+i).innerHTML ;
					sec++;
					sec = sec%60;
					if(sec == 0){
						var min = document.getElementById("mins"+i).innerHTML ;
						min++;
						min = min%60;
						if(min == 0){
							var hr = document.getElementById("hrs"+i).innerHTML ;
							hr++;
							document.getElementById("hrs"+i).innerHTML = hr;
						}
						if(min < 10)
						document.getElementById("mins"+i).innerHTML = "0" + min;
						else document.getElementById("mins"+i).innerHTML =  min;
					}
					if(sec < 10 ){
						document.getElementById("secs"+i).innerHTML = "0" + sec;
					}
					else 
					document.getElementById("secs"+i).innerHTML = sec;
				}
			}
			
		
</script>
<script>
(function ($) {
    $(function () {

        //initialize all modals           
        $(\'.modal\').modal();



        //or by click on trigger
        $(\'.trigger-modal\').modal();

    }); // end of document ready
})(jQuery); // end of jQuery name space
	
	function end_test_all(){
		var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var res = JSON.parse(this.responseText);
					if(res.status == "FAIL"){
						M.toast({html: res.comment,classes: \'rounded\'});
					}
					else{
						location.reload();
					}
				}
			};
			xhttp.open("GET", "coe_exams_end.php?ti=-1", true);
			xhttp.send();
	}
	function end_test(ti){
		if(confirm("Are you sure you want to end the exam?")){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var res = JSON.parse(this.responseText);
					if(res.status == "FAIL"){
						M.toast({html: res.comment,classes: \'rounded\'});
					}
					else{
						location.reload();
					}
				}
			};
			xhttp.open("GET", "coe_exams_end.php?ti="+ti, true);
			xhttp.send();
		}
	}
	
	function view_test_students(ti){
		window.location.href = "display_student_running.php?ti="+ti;
	}
	
</script>
	</head>
	<body>
	<nav>
    <div class="row">
	<div class="nav-wrapper black  z-depth-5 col s12">
	<div class="left-logo">
				<img src="img/logo256.png" class="ing">
			</div>
    <label class="brand-logo center"><a href ="coe_dashboard.php"> PRESENT EXAMS - COE USERSPACE </a><i class="material-icons">portrait</i></label>
    
      <ul id="nav-mobile" class="right ">
		<li><a style="display:none" role="button" class="btn waves-effect waves-light z-depth-3 deep-purple darken-4" href="student-details.php">Account</a></li>
        <li><a role="button" class="btn waves-effect waves-light grey darken-4 z-depth-3 ing2 amber-text" href="logout.php" >LOGOUT<i class="material-icons left">input</i></a></li>
    
        
            </ul>
        </div>
    </div>
  </nav>
	<div class="row">
	<div class="col s10 offset-s1 ">
    <div class="container z-depth-5 grey-blue darken-4" style="background-color: black; width: 90%">
      <h2 class="header center cyan-text accent-2">VIEW RUNNING EXAMS</h2>
    <div class="container inner-card">
      <div class = "row">
         <div class = "col s12">
            <div class = "card ">
               <div class = "card-content" >
                  <span class = "card-title s12"><h3 class="runningexams"> EXAMINATIONS</h3></span>
                  
	<table class="highlight centered highlight" >
        <thead>
          <tr>
              <th>Subject Code</th>
              <th>Stream</th>
              <th>Batch</th>
              <th>Instructor</th>
              <th> Time elapsed </th>
			  <th>View Student</th>
              <th> Close Exam </th>
          </tr> 
        </thead>




        <tbody font="Helvetica">';
		
		
		
		$ct = 1; //Donot delete this variable.........
		
		
		//Put all the running exam's details here.........
		
		$len = count($ans->{'result'});
		for($ct=1;$ct<=$len;$ct++){
		
		echo '
          <tr>
            <td>';
			echo $ans->result[$ct-1]->code;
			echo '</td>
            <td>';	
			for($i=0;$i<count($ans->result[$ct-1]->stream);$i++)
			//Print the subject code here..........
			echo $ans->result[$ct-1]->stream[$i].' ';
			
			
			echo '</td>
            <td>';
			
			
			
			//Put the paper name here...............
			echo $ans->result[$ct-1]->batchPassoutYear-4;
			echo '-';
			echo $ans->result[$ct-1]->batchPassoutYear;
			
			
			
			echo '</td>
            <td>';
			
			echo $ans->result[$ct-1]->{'createdByName'};
			
			
			
			echo '</td>
            <td> <label id="hrs'.$ct.'">';
			
			$now = time();
			$start = $ans->result[$ct-1]->{'started at'};

			$sec = $now - $start;
			$min = floor($sec/60);
			$sec = $sec%60;
			$hour = floor($min/60);
			$min = $min%60;
			//Put the no of hours elapsed for this particular test......
			if($hour<10){
				echo '0'.$hour;
			}
			else{
				echo $hour;
			}
			
			
			echo '</label> : <label id="mins'.$ct.'">';
			
			
			//Put the no of minutes elapsed for this particular test......
			if($min<10){
				echo '0'.$min;
			}
			else{
				echo $min;
			}
			
			
			
			echo '</label> : <label id="secs'.$ct.'" >';
			
			
			//Put the no of seconds elapsed for this particular test......
			if($sec<10){
				echo '0'.$sec;
			}
			else{
				echo $sec;
			}
			
			
			echo '</label></td>
			
			
			<td>
			<a class="btn-floating btn-small waves-effect pulse waves-light green" onclick="view_test_students(\'';
			
			
			//Put the test id here...........
			echo $ans->result[$ct-1]->{'id'};
			
			
			echo '\')">
			<i class="material-icons">people</i></a></td>
            <td><button class="btn-floating btn-small waves-effect pulse waves-light red" onclick="end_test(\'';
			
			
			//Put the test id here......
			echo $ans->result[$ct-1]->{'id'};
			
			
			
			echo '\')"><i class="material-icons">cancel</i></button>
          </tr>';
		  
		  
		  
		  
		
		  
		}
		
		
		
		
		
		
		
		//Rest of the part remains same.....
		
          echo '
        </tbody>
      </table>
	  ';
	  
	  
		$ct=0;	//If there is no test to display then satisfy the if condition.
		if(!$len){
			echo '<br><p style="font-size: 20;">No Exams Running.</p>';
		}
			
			
			
			
			
		//Rest of the part remains same.
		echo '<button class="btn waves-effect waves-light" onclick="window.location.href = \'coe_dashboard.php\'">Back<i class="material-icons left" >navigate_before</i></button>
				<a class="btn waves-effect waves-light btn-cancel modal-trigger" href="#modal1">STOP ALL
				<i class="material-icons right">cancel</i></a>
               </div>
              </div>
             </div>
            </div>
		 </div>
	   </div>
	   


	   </div>
	   </div>
               



<!-- Modal Structure -->
<div id="modal1" class="modal">
  <div class="modal-content">
    <h4>Please Confirm</h4>
	<br>
    Are you sure you want to end all the running exams ?
  </div>
	<div class="modal-button">
		<button class="btn waves-effect waves-light btn-check" onclick="end_test_all()">Yes<i class="material-icons right" >check</i></button>
		<button class="btn waves-effect waves-light btn-cancel modal-close" >No<i class="material-icons right">cancel</i></button>
	</div>
</div>






</body>


';


}

?>