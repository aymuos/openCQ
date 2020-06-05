<?php

session_start();





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

if(!isset($_GET['e'])){
	
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
    <button class="btn btn-sm align-right elegant-color-dark lime-text btn-rounded " type="button" onclick=\"location.href=\'logout.php\'\"><i class="fas fa-lg mr-3 fa-sign-out-alt"></i>LOGOUT</button>
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
      <title>Question Paper</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="css/preview_question_paper.css">
    </head>

    <body>

    <!-- navbar code-->
    

    





<!--stuff ends-->


    
	
	
	
<?php

	require('sender_header.php');
	$username=$_SESSION['usernamecoe']; 
	$password=$_SESSION['passwordcoe']; 
	$_SESSION['examId'] = $_GET['e'];
	
	
	
	$api="exam.php";
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
	//echo $exam;
	$examDetails = json_decode($exam);
	
	
	
	
	
	
	
	
	
	
	
	
	
	$api="exam_questions.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"category" => '0',
					"examId" => $_GET['e']
				);
	
	$result = send_post_request(location.$api,$data);
	//echo $result;
	$ans = json_decode($result);
	if($ans->{'status'} == "FAIL"){
		echo '<div class="white" style="font-size: 32px;text-align: center">Error Occurred! :(</div>';
	}
	else{
		
	
		echo '<div class="paper">
				<div class="head">
					<h6><b>GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY</b></h6>
					<h6><b>AN AUTONOMOUS INSTITUTE</b></h6>
					<h6><b>AFFLIATED TO MAKAUT (FORMELY KNOWN AS WBUT)</b></h6>
					<p class="text"><b>Stream - </b>';
					
					for($j=0;$j<count($examDetails->result[0]->stream);$j++){
						echo ($examDetails->result[0]->stream[$j]);
						if($j+1 != count($examDetails->result[0]->stream))echo '&emsp;';
					}
					
					
					
					echo ' / <b>Code </b>- ';
					
					
					//Echo the paper code here.........
					echo $examDetails->result[0]->code;

					echo ' / <b>Year - </b>';
					
					


					$year = date('Y',$examDetails->result[0]->{'created at'});
					echo "$year";
					
					
					echo '</p>
					<p class="text"><b>Paper Name : </b>';
					
					
					//Echo paper name here.........
					echo $examDetails->result[0]->paperName;
					
					
					
					
					echo '</p>
					<hr>
				</div>';
		
		
		
		for($i=0;$i<count($ans->{'result'});$i++){
			echo '
	<div class="start">
		
		<div>
			
			<!--Question body whole -->
			<div style="margin-bottom: 20px">'.($i+1).')&emsp;'.htmlspecialchars_decode($ans->result[$i]->problemStatement).'</div>
			<div class="total">
				<div class="custom-left">a) </div>
				<div class="custom-right">'.htmlspecialchars_decode($ans->result[$i]->correctOption).'</div>
			</div> 
			<div class="total">
				<div class="custom-left">b) </div>
				<div class="custom-right">'.htmlspecialchars_decode($ans->result[$i]->incorrectOption1).'</div>
			</div>
			<div class="total">
				<div class="custom-left">c) </div>
				<div class="custom-right">'.htmlspecialchars_decode($ans->result[$i]->incorrectOption2).'</div>
			</div>
			<div class="total">
				<div class="custom-left">d) </div>
				<div class="custom-right">'.htmlspecialchars_decode($ans->result[$i]->incorrectOption3).'</div>
			</div>
        </div>
		<div class="row">
			<div class="col s8">
			</div>
			<div class="col s4">
				[<b>Correct: </b> '.($ans->result[$i]->{'marks when correct'}).' marks , <b>Incorrect: </b>'.($ans->result[$i]->{'marks when wrong'}).' marks ]
			</div>
		</div>
    </div>';
		
		
		}
	}

?>
</div>
</div>

<div class="container" style="text-align: center;margin-top: 0px;margin-bottom: 100px;">
	<button class="btn green col s2" onclick="window.print()">Print</button>
</div>





		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/tdb2.js"></script>
    </body>
  </html>






