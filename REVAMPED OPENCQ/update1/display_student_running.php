<?php

require('sender_header.php');
//This displays the running exams..........
//Proceed to the else part directly.......



session_start();
if ( isset($_SESSION['loggedincoe']) == false ){
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
			<p class="text-center">Please <a href="coe-login.html">Login</a> first</p>
		</div>
	</div>
</body>
</html>
';
}
else {

	
$test_id = $_GET['ti'];
$url="localhost/update1/api/exam_students.php";
$data = array(		"key" => key,
					"username" => $_SESSION['usernamecoe'],
					"password" => $_SESSION['passwordcoe'],
					"examId" => $test_id,
				);
$result = send_post_request($url,$data);

echo $result;

$ans = json_decode($result);

echo '

<html>
	<head>
		<title>COE Dashboard</title>
		
		
		
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- BOOTSTRAP AND MATERIALIZE LIBRARIES-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
    	<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    	<!-- Compiled and minified JavaScript -->
		<!-- end of bootstrap materialize libraries//  create provision for user css-->       
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
		
		
	
		
		<!--user css-->
        <link rel="stylesheet" type="text/css" href="css/temp.css">
		
		
		
		
		
		
<script>
(function ($) {
    $(function () {

        //initialize all modals           
        $(\'.modal\').modal();



        //or by click on trigger
        $(\'.trigger-modal\').modal();

    }); // end of document ready
})(jQuery); // end of jQuery name space
	

	function restart_test(ti,uname){
		if(confirm("Are you sure you want to restart the exam?")){
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
			xhttp.open("GET", "restart_student_exam.php?ti="+ti+"&un="+uname, true);
			xhttp.send();
		}
	}
	

	
</script>
	</head>
	<body>
		<div class="heading">
			<div class="left-logo">
				<img src="img/logo256.png" class="ing">
			</div>
			<label class="writing">Controller of Examination</label>
			<div class="right-logo">
				<a class="ing2" href="coe_logout.php"><i class="material-icons left">input</i>Logout</a>
			</div>
		</div>
	
	
    <div class="container z-depth-5 grey-blue darken-4" style="background-color: #e6e6e6;">
      <h2 class="header center cyan-text">Students</h2>
    <div class="container inner-card">
      <div class = "row">
         <div class = "col s12">
            <div class = "card-panel ">
               <div class = "card-content" >
              <!--    <span class = "card-title card-large s12"><h3 class="runningexams"> EXAMINATIONS</h3></span> -->
                  
	<table class="highlight centered highlight" >
        <thead>
          <tr>
              <th>Roll No</th>
              <th>Name</th>
              <th>Stream</th>
              <th>Batch</th>
              <th>Status</th>
			  <th>Restart Exam</th>
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
			echo $ans->result[$ct-1]->username;
			echo '</td>
            <td>';
			
			
			
			//Put the paper name here...............
			echo $ans->result[$ct-1]->name;
			
			
			
			echo '</td>
            <td>';
			
			echo $ans->result[$ct-1]->{'stream'};
			
			
			echo '</td><td>';
			
			
			
			
			echo $ans->result[$ct-1]->{'batchPassoutYear'}-4;
			echo '-';
			echo $ans->result[$ct-1]->{'batchPassoutYear'};
			
			
			
			
			echo '</td><td>';
			
			
			if($ans->result[$ct-1]->{'submitted'} == 0){
				echo 'Running';
			}
			else{
				echo 'Submitted';
			}
			
			
			echo '</td>
            <td><button class="btn-floating btn-small waves-effect pulse waves-light green" onclick="restart_test(\'';
			
			
			//Put the test id here......
			echo $ans->result[$ct-1]->{'examId'};
			
			
			
			echo '\',\'';
			
			echo $ans->result[$ct-1]->{'username'};
			
			
			echo '\')"';
			
			
			if(!$ans->result[$ct-1]->{'submitted'}){
				echo 'disabled';
			}
			
			
			echo '><i class="material-icons">assignment_return</i></button>
          </tr>';
		  
		  
		  
		  
		
		  
		}
		
		
		
		
		
		
		
		//Rest of the part remains same.....
		
          echo '
        </tbody>
      </table>
	  ';
	  
	  
		$ct=0;	//If there is no test to display then satisfy the if condition.
		if(!$len){
			echo '<br><p style="font-size: 20;">No Student to Display</p>';
		}
			
			
			
			
			
		//Rest of the part remains same.
		echo '<button class="btn waves-effect waves-light red" onclick="window.location.href = \'coe_exams_present.php\'">Back<i class="material-icons left" >navigate_before</i></button>
				
               </div>
              </div>
             </div>
            </div>
		 </div>
       </div>
               






</body>


';


}

?>