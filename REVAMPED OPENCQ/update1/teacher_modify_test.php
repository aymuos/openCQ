<?php

session_start();


if (!isset($_SESSION['loggedinteacher'])){
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
      <title>Question Dashboard</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="css/tdbhome.css">
    </head>

    <body>

    <!-- navbar code-->
    
  <nav>
    <div class="nav-wrapper gradient1">
        <a class="navbar-brand gibpadding " href="#">
            <img class="gibpadding2" src="img/logo256.png" height="60" alt="GCECT">
        </a>
      <a class="brand-logo" href="#"><h5>   Teacher Userspace - Test Dashboard </h5></a>
      <ul class="right hide-on-med-and-down">
        
        <li><a class="waves-effect waves-light btn gradient2">LOGOUT<i class="material-icons right">arrow_forward_ios</i></a></li>
      </ul>
    </div>
  </nav>

    
  <nav class="heightadjustnav2 z-depth-5">
    <div class="nav-wrapper gradient3">
      <div class="col s12 leftpad">
        <a href="#!" class="breadcrumb">Login</a>
        <a href="#!" class="breadcrumb">Select Subject</a>
        <a href="#!" class="breadcrumb">Teacher Dashboard</a>
      </div>
    </div>
  </nav>
            


            <div class="row">
    <div class="col s10 offset-s1">
      <div class="card leeftpad white z-depth-4">
        <span class="black-text">
        <div class="row">
        <div class="col s5">
        <p class= "leftpad" ><b> Teacher Name: </b><?php echo $_SESSION['name']; ?></p> <!--JS bring username from api-->
        </div>
        
        <div class="col s4">
         <p class= "leftpad"><b> Selected Subject: </b><?php echo $_SESSION['code']; ?></p>
        </div>
		
		<div class="col s3">
         <p class= "leftpad"><b> Exam Id: </b><?php echo $_GET['e']; ?></p>
        </div>
        </div>
        
       
        </span>
      </div>
    </div>
  </div>


<!--stuff ends-->


    
	
	
	
<?php

	require('sender_header.php');
	$username=$_SESSION['usernameteacher']; 
	$password=$_SESSION['passwordteacher']; 
	$_SESSION['examId'] = $_GET['e'];
	$api="exam_questions.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"category" => '1',
					"examId" => $_GET['e']
				);
	
	$result = send_post_request(location.$api,$data);

	$ans = json_decode($result);
	if($ans->{'status'} == "FAIL"){
		echo '<div class="white" style="font-size: 32px;text-align: center">Error Occurred! :(</div>';
	}
	else{
		
		echo '
<div class="row">
    <div class="col s10 offset-s1">
    <div>
    <div class="black-text">
    <div class="col s8">
        
        <h5><p class="thick"> Total Number of added Questions : '.count($ans->{'result'}).'</p></h5> </div>
        <div class="col s4">
            <a class="waves-effect waves-light btn btn-large green darken-3" href="teacher_modify_test_add_ques.php"><i class="material-icons left">add_box</i>ADD NEW QUESTIONS</a>
        </div>
        
    </div>
    </div>
</div>





  <div class="row">
    <div class="col s10 offset-s1">
      <div class="card blue darken-1 z-depth-3">
        <div class="card-content black-text">
          <span class="card-title">Saved Questions (Click to expand)</span>
          <ul class="collapsible">';
		
		
		
		
		for($i=0;$i<count($ans->{'result'});$i++){
			echo '
	<li>
		<div class="collapsible-header">
			<div class="row" style="width: 100%;padding-top: 20px;">
				<div class="col s0">
					<i class="material-icons">adjust</i>
				</div>
				<div class="col s7">
					Question : '.($i+1).'
				</div>
				<div class="col s3">
					Chapter : '.($ans->result[$i]->chapterName).'
				</div>
			</div>
		</div>
		<div class="collapsible-body white">
			<!--Question body whole -->
			<div><blockquote>'.htmlspecialchars_decode($ans->result[$i]->problemStatement).'</blockquote></div>
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
    </li>';
		
		
		}
	}

?>


      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/tdb2.js"></script>
    </body>
  </html>






