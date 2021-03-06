<?php
require('sender_header.php');

//This displays all the exams ended.......Try to display in descending order of the date of exam
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
else 
{
$url=location."exam.php";
$data = array(		"key" => key,
					"username" => 'ALL',
					"examStatus" => '3',
					"examId" => 'ALL',
					"code" => 'ALL',
					"batchPassoutYear" => 'ALL',
					"stream" => 'ALL',
					"visible" => '0'
				);
$result = send_get_request($url,$data);

// echo $result;

$ans = json_decode($result);
// var_dump($ans);
// exit();

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
    $(document).ready(function(){
        $(".modal").modal();
    });
	
	function delete_exam(cid){
		if(confirm("Are you sure you want to delete the exam?") == true){
			$.get("delete_exam.php?id="+cid, function(data, status){
				var obj = jQuery.parseJSON(data);
				if(obj.status == "FAIL"){
					M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
				}
				else{
					location.reload();
				}
			});
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
	
	
    <div class="container z-depth-5 grey-blue darken-4" style="background-color: #e6e6e6;width: 90%">
      <h2 class="header center cyan-text">PAST EXAMINATIONS</h2>
    <div class="container inner-card">
      <div class = "row">
         <div class = "col s12" >
            <div class = "card-panel ">
               <div class = "card-content" >
                  <!-- <span class = "card-title card-large s12"><h3 class="runningexams"> EXAMINATIONS</h3></span> -->
    <form id="myForm" action="coe_view_result3.php" method="post">
		<input id="never_mind" name="test_id" type="text" value="" readonly hidden>
	<table class="highlight centered highlight" >
        <thead>
          <tr>
              
              <th>Sub Code</th>
			  <th>Paper Name</th>
              <th>Stream</th>
			  <th>Batch</th>
              <th>Instructor</th>
			  <th>Date</th>
              <th> Question Paper </th>
			  <th> View Students </th>
			  <th>Delete</th>
              
          </tr> 
        </thead>




        <tbody font="Helvetica">';
		
		$len = count($ans->{'result'});
//		echo $len;
		for($ct=1;$ct<=$len;$ct++){
		
		echo '
          <tr>
            <td>';
			echo $ans->result[$ct-1]->code;
			echo '</td>
            <td>';	
			
			
			echo $ans->result[$ct-1]->paperName;
			
			echo '</td><td>';
			
			
			
			
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
		
		
			
			$date = date('d/m/Y',$start);
			//put the date of exxamination here..........
			echo $date;
			
			
			echo '
			</td>
            <td><a class="btn-floating btn-small waves-effect pulse waves-light blue" onclick="view_test(\'';
			
			
			//Put the test id here...........
			echo $ans->result[$ct-1]->id;
			
			
			echo '\')"><i class="material-icons">assignment</i></a></td>
          
		  
		  
			<td>
			<a class="btn-floating btn-small waves-effect pulse waves-light green" onclick="view_test_students(\'';
			
			
			//Put the test id here...........
			echo $ans->result[$ct-1]->id;
			
			
			echo '\')">
			<i class="material-icons">people</i></a></td>
			
			
			
			<td>
			<a class="btn-floating btn-small waves-effect pulse waves-light red" onclick="delete_exam(\'';
			
			
			//Put the test id here...........
			echo $ans->result[$ct-1]->id;
			
			
			echo '\')">
			<i class="material-icons">delete</i></a></td>

			</tr>
		  
		  
		  
		  ';
		  
		  
		}
          echo '
        </tbody>
      </table>
	  ';
	  
	  
		$ct=0;	//If there is no test to display then satisfy the if condition.
		if(!$len){
			echo '<br><p style="font-size: 20;">No Exams to display.</p>';
		}
			
			
			
			
			
		//Rest of the part remains same.
		echo '		
		
					</form>
					<button class="btn waves-effect waves-light red" onclick="window.location.href = \'coe_dashboard.php\'">Back<i class="material-icons left" >navigate_before</i></button>
				
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
    Are you sure you want to start all the available exam ?
  </div>
	<div class="modal-button">
		<button class="btn waves-effect waves-light btn-check" onclick="start_test_all()">Yes<i class="material-icons right" >check</i></button>
		<button class="btn waves-effect waves-light btn-cancel modal-close" >No<i class="material-icons right">cancel</i></button>
	</div>
</div>




</body>



';



}


?>