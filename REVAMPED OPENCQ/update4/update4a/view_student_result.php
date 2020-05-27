<?php

session_start();



// $_SESSION['loggedinteacher']=TRUE;
// $_SESSION['usernameteacher']="Ben Tennyson";
// $_SESSION['passwordteacher']="AlienX";
// $_GET['s']="lucifer morningstone";
// $_GET['e']="16";
// $_SESSION['viewExamId']=16;

if (!isset($_SESSION['loggedinteacher']) && !isset($_SESSION['loggedincoe'])){
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
    <p class="text-center">Please <a href="teacher-login.html">Login</a> first</p>
    </div>
    </div>
    </body>
    </html>
    ';
    exit();
}

if(!isset($_GET['s']) || !isset($_GET['e'])){
	
	echo '
	
	
	<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon"> 
  <title>Teacher Dashboard</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Icons repo-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="css/tdbhome.css">
</head>
<body>

  <!-- Start project here-->  
  <nav class="navbar navbar-expand-lg navbar-dark aqua-gradient primary-color">
    <a class="navbar-brand" href="#">
      <img src="img/logo256.png" height="30" alt="GCECT">
    </a>
  <a class="navbar-brand" href="#">Teacher Userspace </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <form class="form-inline my-2 my-lg-0 ml-auto">
    <button class="btn btn-sm align-right elegant-color-dark lime-text btn-rounded " type="button"><i class="fas fa-lg mr-3 fa-sign-out-alt"></i>LOGOUT</button>
  </form>
  
</nav>

<div class="bc-icons-2">
  <nav aria-label="breadcrumb">
   <ol class="breadcrumb purple lighten-4">
      <li class="breadcrumb-item"><a class="black-text" href="#">Home</a><i class="fas fa-angle-right mx-2"
        aria-hidden="true"></i></li>
      <li class="breadcrumb-item"><a class="black-text" href="#">Error</a><i class="fas mx-2"
        aria-hidden="true"></i></li>
    </ol>
  </nav>
</div>
<footer class="fixed-bottom font-small blue-grey lighten-5 ">
  <div class="footer-copyright text-center py-3">© 2020 OpenCQ:
    <a href="#"></a>
  </div>
</footer>


<!-- MAIN BODY OF THE ERROR MESSAGE-->


<div class="card text-center mx-auto w-50 p-3 mt-4 mb-4">
    <div class="card-header danger-color-dark white-text">
     ERROR!
    </div>
    <div class="card-body">
      <h1 class="card-title display-2">OOPS!</h1>
      <p class="card-text"></p>
      <p class="card-text error">Error message : This page is not present!</p>
      <button class="btn btn-primary" onclick="goBack()">Go back to last page </button>
    </div>
  </div>


  
  <!-- Endproject here-->

  <!-- jQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript"></script>
  <script>
    function goBack() {
      window.history.back();
    }

    </script>

</body>
</html>

';
	exit();
}

?>










<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Answer Script</title>
  <!-- MDB icon -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="css/tdbhome.css">
  <link rel="stylesheet" href="css/teacher_test_dashboard.css">
	<link rel="stylesheet" href="css/printing.css">
	<style>
		img{
			max-width: 850px;
		}
	</style>
    </head>

    <body>

    <!-- navbar code-->
  
  
<div class="container center" style="margin-top: 60px;margin-bottom: 30px">
<h6><b>GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY</b></h6>
					<h6><b>AN AUTONOMOUS INSTITUTE</b></h6>
					<h6><b>AFFLIATED TO MAKAUT (FORMELY KNOWN AS WBUT)</b></h6>
					<hr>
</div>





<!--stuff ends-->
<?php
	require('sender_header.php');
	$api="exam.php";
	$data = array(	"key" => key,
					"username" => 'ALL',
					"examStatus" => 'ALL',
					"examId" => $_SESSION['viewExamId'],
					"code" => 'ALL',
					"batchPassoutYear" => 'ALL',
					"stream" => 'ALL',
					"visible" => 'ALL'
				);
	
	$exam = send_get_request(location.$api,$data);
//	echo $exam;
	$examDetails = json_decode($exam);
	
	echo '<div class="container row">
		<div class="col s2 display">
			<b>Test Id : </b>'.($examDetails->result[0]->id).'
		</div>
		<div class="col s4">
			<b>Test Description : </b>'.($examDetails->result[0]->description).'
		</div>
		<div class="col s3 display">
			<b>Creation Date : </b>'.date('d/m/Y',($examDetails->result[0]->{'created at'})).'
		</div>
		<div class="col s3">
			<b>Exam Date : </b>'.date('d/m/Y',($examDetails->result[0]->{'started at'})).'
		</div>
		</div>
		<div class="container row">
			<div class="col s4">
				<b>Batch : </b>'.($examDetails->result[0]->batchPassoutYear-4)." - ".($examDetails->result[0]->batchPassoutYear).'
			</div>
			<div class="col s3">
				<b>Code : </b>'.($examDetails->result[0]->code).'
			</div>
			<div class="col s3">
				<b>Paper Name : </b>'.($examDetails->result[0]->paperName).'
			</div>
		</div>';
	
	
	


?>





<div class="container present-exam" style="padding-top: 10px"> 
	<div class="heads orange">
		Answer Script
	</div>


<?php








$api_name="marksheet.php";
	$data = array(	"key" => key,
					"username" => $_SESSION['usernameteacher'],
					"password" => $_SESSION["passwordteacher"],
					"examId" => $_SESSION["viewExamId"],
					"studentUsername" => $_GET['s'],
					"category" => '1'
				);
//	echo $_SESSION["viewExamId"].'dfgdgf';
	$data = send_post_request(location.$api_name,$data);
	$questions = json_decode($data);
	echo $data;
	$len = 0;
	if($questions->status == "OK")
	$len = count($questions->result);
	// var_dump($questions);


echo '
	<div class="row">
		<div class="col s5 lberlin"><h6><b>Roll No : </b>'.$_GET['s'].'</h6></div>
		<div class="col s5 display"></div>
		<div class="col s2 rberlin"><h6><b>Marks : </b>'.$questions->marks.'</h6></div>
	</div>

<hr class="not-display">


';










echo ' <div class="card">
    
    <div class="card-content">';
      
	  
	  
	  
	  for($i=1;$i<=$len;$i++){
		echo '<div id="test'.$i.'" style="margin-bottom: 100px;">
			<div class="row">
				<div class="col s7">
					<b>Question '.$i.' :</b>
				</div>
				<div class="col s5">
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

					if($questions->result[$i-1]->{'markedOption'} == 'option1')echo 'checked="true"';

					echo ' disabled>
						<span></span>
					</label>	
				</div>
				<div class="custom-right" >'.htmlspecialchars_decode($questions->result[$i-1]->option1).'</div>
			</div>
			
			
			
			
			
			
			<div class="total" id="q'.$i.'o2">
				<div class="custom-left">
					<label>
						<input id="iq'.$i.'o2" class="with-gap" name="group'.$i.'" type="radio"  ';

					if($questions->result[$i-1]->{'markedOption'} == 'option2')echo 'checked="true"';

					echo ' disabled>
						<span></span>
					</label>
				</div>
				<div class="custom-right" >'.htmlspecialchars_decode($questions->result[$i-1]->option2).'</div>
			</div>
			
			
			
			<div class="total" id="q'.$i.'o3">
				<div class="custom-left">
					<label>
						<input id="iq'.$i.'o3" class="with-gap" name="group'.$i.'" type="radio" ';

					if($questions->result[$i-1]->{'markedOption'} == 'option3')echo 'checked="true"';

					echo ' disabled>
						<span></span>
					</label>
				</div>
				<div class="custom-right" >'.htmlspecialchars_decode($questions->result[$i-1]->option3).'</div>
			</div>
			
			
			
			<div class="total" id="q'.$i.'o4">
				<div class="custom-left">
					<label>
						<input id="iq'.$i.'o4" class="with-gap" name="group'.$i.'" type="radio" ';

					if($questions->result[$i-1]->{'markedOption'} == 'option4')echo 'checked="true"';

					echo '  disabled>
						<span></span>
					</label>
				</div>
				<div class="custom-right" >'.htmlspecialchars_decode($questions->result[$i-1]->option4).'</div>
			</div>
			
			
			<div style="margin-top: 20px;margin-left: 40px">';
			if($questions->result[$i-1]->status == "AC"){
				echo '<b>Verdict : </b> <label style="color: green;font-size: 16px">Correct Answer</label>';
			}
			else{
				echo '<b>Verdict : </b> <label style="color: red;font-size: 16px">Wrong Answer</label>';
			}
			$str = $questions->result[$i-1]->{'correctOption'};
			// echo $str;
			// exit();
			echo '
			</div>
			<div class="total" id="q'.$i.'o4">
				<div class="custom-left">
				</div>
				<div class="custom-right" ><b>Correct option : </b>'.htmlspecialchars_decode($questions->result[$i-1]->{$str}).'</div>
			</div>
			
			
			<div style="margin-left: 40px">';
			if($questions->result[$i-1]->status == "AC"){
				echo '<b>Marks : </b>'.($questions->result[$i-1]->{'marks when correct'});
			}
			else{
				echo '<b>Marks : </b>'.($questions->result[$i-1]->{'marks when wrong'});
			}

			echo '
			</div>
			
			
			
		
			
		</div>';
		
		
		
	  }
      
	  echo '
    </div>
  </div>
  </div>';



?>

</div>
<div class="row container">
<div class="col s4"></div>
<div class="col s1" style="text-align: center;margin-top: 60px;">
    <a class="waves-effect waves-light btn btn-large red" onclick="location.href='view_result.php?e=<?php echo $_SESSION['viewExamId'] ?>'"><i class="material-icons left"></i>Back</a>
</div>
<div class="col s1"></div>
<div class="col s1" style="text-align: center;margin-top: 60px;">
    <a class="waves-effect waves-light btn btn-large green" onclick="window.print()"><i class="material-icons left"></i>print</a>
</div>


      <!--JavaScript at end of body for optimized loading-->
      
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
		(function ($) {
			$(function () {
				//initialize all modals           
				$('.modal').modal();
				//or by click on trigger
				$('.trigger-modal').modal();
			}); // end of document ready
		})(jQuery); // end of jQuery name space
		$(document).ready(function(){
			$('select').formSelect();
		});
		

</script>

	  <script type="text/javascript" src="js/tdb2.js"></script>
	  <script type="text/javascript" src="js/teacher_test_dashboard.js"></script>
		<script>
			function prepare(data){
				var str = "<tr><td>";
				str+=data.username + "</td><td>";
				str+=data.name + "</td><td>";
				str+=data.stream + "</td><td>";
				str += data.joiningYear + " - ";
				str+= data.batchPassoutYear+"</td>";
				str+= "<td>"+data.marks+"</td>";
				str+= "<td><a class=\"btn-floating btn-small waves-effect pulse waves-light green\" onclick=\"window.location.href='view_student_result.php?s=";
				str += data.username + "'\"><i class=\"material-icons\">assignment</i></a></td></tr>";
				return str;
			}
			$(document).ready(function(){
				$("select").change(function(){
					//alert("df");
					var stream = $("#stream").children("option:selected").val();
					$.get("get_group_marks_info.php?stream="+stream, function(data, status){
						console.log(data);
						var obj = jQuery.parseJSON(data);
						if(obj.status == "FAIL"){
							M.toast({html: obj.comment+"! :(",classes: 'rounded'});
						}
						else{
							var str = "";
							for(i=0;i<obj.result.length;i++){
								str += prepare(obj.result[i]);
							}
							$("#tableBody").html(str);
						}
					});
				});
			});
		
		</script>
    </body>
  </html>


