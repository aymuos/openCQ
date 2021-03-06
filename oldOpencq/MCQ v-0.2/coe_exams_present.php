<?php


//This displays the running exams..........
//Proceed to the else part directly.......

include 'db_connection.php';

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

$conn = OpenCon();

try{
	$query = "SELECT * FROM exam WHERE is_active='1'";
	execute($conn,$query,"",[],$stmt);
	$exam = get_data($stmt);
	close($stmt);
}
catch(Exception $e){
	report($e);
}



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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
		
		
	
		
		<!--user css-->
        <link rel="stylesheet" type="text/css" href="temp.css">
		
		
		
		
		
		<script>
			var myVar = setInterval(myTimer, 1000);

			function myTimer() {
				for(i=1;i<=';
				
				
				//Put the no of running test here............
				echo count($exam);
				
				
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
    $(document).ready(function(){
        $(".modal").modal();
    });
	
	function end_test_all(){
		window.location.href = "coe_exams_end.php?ti=-1";
	}
	function end_test(ti){
		if(confirm("Are you sure you want to end the exam?")){
			window.location.href = "coe_exams_end.php?ti=" + ti;
		}
	}
</script>
	</head>
	<body>
		<div class="heading">
			<div class="left-logo">
				<img src="logo256.png" class="ing">
			</div>
			<label class="writing">Controller of Examination</label>
			<div class="right-logo">
				<a class="ing2" href="coe_logout.php"><i class="material-icons left">input</i>Logout</a>
			</div>
		</div>
	
	
    <div class="container z-depth-5 grey-blue darken-4" style="background-color: #e6e6e6;">
      <h2 class="header center cyan-text">VIEW RUNNING EXAMS</h2>
    <div class="container inner-card">
      <div class = "row">
         <div class = "col s12">
            <div class = "card-panel ">
               <div class = "card-content" >
                  <span class = "card-title card-large s12"><h3 class="runningexams"> EXAMINATIONS</h3></span>
                  
	<table class="highlight centered highlight" >
        <thead>
          <tr>
              <th>UG/PG</th>
              <th>Sub Code</th>
              <th>Exam Name</th>
              <th>Year</th>
              <th> Time elapsed </th>
              <th> Close Exam </th>
          </tr> 
        </thead>




        <tbody font="Helvetica">';
		
		
		
		$ct = 1; //Donot delete this variable.........
		
		
		//Put all the running exam's details here.........
		foreach($exam as $value){

			try{
				$query = "SELECT * FROM subject WHERE id = ?";
				execute($conn,$query,"s",[$value['subject_id']],$stmt);
				$subject = get_data($stmt);
				close($stmt);


				$query = "SELECT * FROM teacher WHERE id = ?";
				execute($conn,$query,"s",[$value['teacher_id']],$stmt);
				$teacher = get_data($stmt);
				close($stmt);
			}
			catch(Exception $e){
				report($e);
			}
		
		echo '
          <tr>
            <td>';
			
			
			//Print UG or PG here.........
			if($subject[0]['UG']==1){
				echo 'UG';
			}
			else{
				echo 'PG';
			}
			//echo 'UG';
			
			
			
			echo '</td>
            <td>';
			
			
			//Print the subject code here..........
			echo $subject[0]['id'];
			
			
			echo '</td>
            <td>';
			
			
			
			//Put the paper name here...............
			echo $subject[0]['name'];
			
			
			
			echo '</td>
            <td>';
			
			$year = date('Y',$value['start_time']);
			//Put the year here.......
			echo $year;
			
			
			
			echo '</td>
            <td> <label id="hrs'.$ct.'">';
			
			$now = time();
			$start = $value['start_time'];

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
            <td><button class="btn-floating btn-small waves-effect pulse waves-light red" onclick="end_test(\'';
			
			
			//Put the test id here......
			echo $value['id'];
			
			
			
			echo '\')"><i class="material-icons">cancel</i></button>
          </tr>';
		  
		  
		  
		  
		  $ct++;
		  
		}
		
		
		
		
		
		
		
		//Rest of the part remains same.....
		
          echo '
        </tbody>
      </table>
	  ';
	  
	  
		$ct=0;	//If there is no test to display then satisfy the if condition.
		if($ct == 1){
			echo '<br><p style="font-size: 20;">No Exams Running.</p>';
		}
			
			
			
			
			
		//Rest of the part remains same.
		echo '<button class="btn waves-effect waves-light" onclick="window.location.href = \'coe_dashboard.php\'">Back<i class="material-icons left" >navigate_before</i></button>
				<a class="btn waves-effect waves-light btn-cancel" href="#modal1">STOP ALL
				<i class="material-icons right">cancel</i></a>
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