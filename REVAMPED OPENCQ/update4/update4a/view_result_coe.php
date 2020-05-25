<?php


//This displays all the exams ended.......Try to display in descending order of the date of exam
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
exit();
}

if(!isset($_GET['e'])){
	
	echo '
	
	
	<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon"> 
  <title>COE Dashboard</title>
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
<body >

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


<html>
	<head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Result</title>
  <!-- MDB icon -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="css/tdbhome.css">
  <link rel="stylesheet" href="css/teacher_test_dashboard.css">
  <link rel="stylesheet" href="css/view_result.css">

		
		<!--user css-->
        <link rel="stylesheet" type="text/css" href="css/temp.css">
		<link rel="stylesheet" href="css/view_result.css">
		
		
		

<script>
    $(document).ready(function(){
        $(".modal").modal();
    });
	
	
	
</script>
	</head>
	<body style="background: #ffffff">
		<div class="heading display">
			<div class="left-logo">
				<img src="img/logo256.png" class="ing">
			</div>
			<label class="writing">Controller of Examination</label>
			<div class="right-logo">
				<a class="ing2" href="logout.php"><i class="material-icons left">input</i>Logout</a>
			</div>
		</div>
		
		
		
		

<div class="not-display center">
<h4><b>GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY</b></h4>
<h4><b>AN AUTONOMOUS INSTITUTE</b></h4>
<h4><b>AFFLIATED TO MAKAUT (FORMELY KNOWN AS WBUT)</b></h4>
</div>








<!--stuff ends-->
<?php
	require('sender_header.php');
	$api="exam.php";
	$_SESSION['viewExamId'] = $_GET['e'];
	$data = array(	"key" => key,
					"username" => 'ALL',
					"examStatus" => 'ALL',
					"examId" => $_GET['e'],
					"code" => 'ALL',
					"batchPassoutYear" => 'ALL',
					"stream" => 'ALL',
					"visible" => '0'
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
<div class="container row display">

<div class="col s1.9" style="padding-top: 30px">
<b>Stream : </b>
</div>
<div class="input-field col s3" style="width: 300px;display: inline-block;float: left">
    <select id="stream">
      <option value="ALL">All</option>
      <option value="CSE">CSE</option>
      <option value="IT">IT</option>
      <option value="CT">CT</option>
    </select >
  </div>
</div>

<hr class="not-display" style="display: none">



<div class="container present-exam" style="padding-top: 10px"> 
	<div class="heads purple">
		Result
	</div>

     <table class="highlight centered">
        <thead>
          <tr>
              <th>Roll No</th>
              <th>Name</th>
			  <th>Stream</th>
			  <th>Batch</th>
			  <th>Marks</th>
			  <th class="display">View Answer Script</th>
          </tr>
        </thead>

        <tbody id="tableBody">
<?php
	
	$api = "student_marks.php";
	$username = $_SESSION['usernamecoe']; 
	$password = $_SESSION['passwordcoe'];
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"examStatus" => '4',
					"examId" => $_GET['e'],
					"code" => "ALL",
					"batchPassoutYear" => 'ALL',
					"stream" => 'ALL',
					"visible" => '0',
					"category" => '0'
				);
	
	$result = send_post_request(location.$api,$data);
//	echo $result;
	$data = json_decode($result);
	if($data->status == "FAIL"){
		echo '</tbody></table><div style="text-align: center;">'.$data->comment.'</div>';
	}
	else{
		if(count($data->result) == 0){
			echo '</tbody></table><div style="text-align: center;">No Exam to display.</div>';
		}
		else{
			for($i=0;$i<count($data->result);$i++){
				echo "<tr><td>".$data->result[$i]->username."</td>";
				echo "<td>".$data->result[$i]->name."</td>";
				echo "<td>".$data->result[$i]->stream."</td>";
				echo "<td>".($data->result[$i]->joiningYear)." - ".($data->result[$i]->batchPassoutYear)."</td>";
				
				echo '<td>'.($data->result[$i]->marks).'</td>';
	
				echo '<td class="display"><a class="btn-floating btn-small waves-effect pulse waves-light green" target="_blank" href=\'coe_view_result.php?s='.($data->result[$i]->username).'&e='.$_GET['e'].'\'><i class="material-icons">assignment</i></a></td>
				</tr>';
			}
			echo '</tbody></table>';
		}
	}
?>



</div>
<div class="row container">
<div class="col s4"></div>
<div class="col s1" style="text-align: center;margin-top: 60px;">
    <a class="waves-effect waves-light btn btn-large red" href="coe_exams_past.php"><i class="material-icons left"></i>Back</a>
</div>
<div class="col s3" style="text-align: center;margin-top: 60px;">
    <a class="waves-effect waves-light btn btn-large blue" onclick="window.print()"><i class="material-icons left"></i>Print</a>
</div>
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


		
		
		
		
		
		
		
		
		
		
		