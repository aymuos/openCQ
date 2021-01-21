<?php
require ('sender_header.php');
session_start();
if (!isset($_SESSION['loggedinteacher'])){
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
  // $_POST['username']="BB";
  // $username = $_POST['username'];
  // // $password = $_POST['password'];
  // $data['key']=key;
  // $data['username']=$username;
  // $url = "http://localhost:8080/projects/dashboard_connect/api/teacher_codes.php";
  // $result = send_get_request($url,$data);
  // $result = json_decode($result);
  // var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script type = "text/javascript">
         <!--
            function Redirect() {
               window.location = 'tdberrormessage.htm';
            }
         //-->
</script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Teacher Dashboard</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  
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
  <nav class="navbar navbar-expand-lg navbar-dark aqua-gradient scrolling-navbar primary-color">
    <a class="navbar-brand" href="#">
      <img src="img/logo256.png" height="30" alt="GCECT">
    </a>
  <a class="navbar-brand text-wrap font-weight-bold" href="tdbselectsubjectv1.php"><h2>Subject Choice </h2></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <form class="form-inline my-2 my-lg-0 ml-auto">
    <button class="btn btn-lg align-right elegant-color-dark white-text font-weight-bolder " type="button" onclick="location.href='logout.php'"><i class="fas fa-lg mr-3 fa-sign-out-alt"></i>LOGOUT</button>
  </form>

</nav>

<div class="bc-icons-2">
  <nav aria-label="breadcrumb">
   <ol class="breadcrumb purple lighten-4">
      <li class="breadcrumb-item"><a class="black-text" href="teacher-login.html">Login</a><i class="fas fa-angle-right mx-2"
        aria-hidden="true"></i></li>
     <!-- <li class="breadcrumb-item"><a class="black-text" href="#">Library</a><i class="fas fa-angle-right mx-2"
        aria-hidden="true"></i></li>-->
     <li class="breadcrumb-item active">Select Subject</li> 
    </ol>
  </nav>
</div>

<!-- navigation bar stuff ends here-->

<footer class="fixed-bottom font-small blue-grey lighten-5 sticky-bottom mt-5 ">
  <div class="footer-copyright text-center py-3">© 2020 OpenCQ:
    <a href="#"></a>
  </div>
</footer>
<!-- page contents-->

<div class="container" >
  <div class="row mt-5 pt-5">
      <div class="col text-center">
          <h2 class="tname" id="tname">Welcome, Faculty X</h2>
          <!-- Need to do some js magic to get name from api json-->
          <h5>Choose subject from the following options to continue</h5>
      </div>
  </div>
</div>
<!--Text Portion ends-->
<main>
<!-- 1st card-->
<!-- <div class="card w-50 p-3 mt-4 mx-auto">
  <div class="card-header">
    Subject Details
  </div>
  <div class="card-body ">
    <h3 class="card-title ">Subject Code</h5>
    <p class="card-text">Subject Name</p>
    <a href="#" class="btn btn-primary">Continue</a>
    <div class="text-right">
    <button class="btn btn-danger btn-rounded ">DELETE SUBJECT <i class="far fa-trash-alt"></i></button>
      </div>
  </div>
</div> -->
<!-- 1st card ends-->
</main>
<!--need to implement html templating-->


<!-- <div class="card w-50 p-3 mt-4 mb-4 mx-auto">
  <div class="card-header">
    Subject Details
  </div>
  <div class="card-body">
    <h3 class="card-title ">Subject Code</h5>
    <p class="card-text">Subject Name</p>
    <a href="#" class="btn btn-primary">Continue</a>
    <div class="text-right">
    <button class="btn btn-danger btn-rounded "> DELETE SUBJECT <i class="fas fa-trash-alt"></i></button>
      </div>
  </div>
</div> -->

  <!--
  <div class="card">
    
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
      <p><a href="#">This is a link</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
      <p>Here is some more information about this product that is only revealed once clicked on.</p>
    </div>
  </div>
  -->
<!--

<div class="card mx-auto w-75">
  <div class="card-body">
  <h5 class="card-title">Select Subjects</h5>

 <select class="mdb-select" multiple searchable="Search here..">
  <optgroup label="team 1">
    <option value="1">Option 1</option>
    <option value="2">Option 2</option>
  </optgroup>
  <optgroup label="team 2">
    <option value="3">Option 3</option>
    <option value="4">Option 4</option>
  </optgroup>
</select>

  </div>
</div>


-->
 <!-- Material unchecked -->

<!-- 
<div class=" mt-5 mb-5 ml-4 mr-4  ">
    <button type="button" class="btn btn-rounded btn-blue">EDIT SUBJECTS <i class="far fa-edit"></i></button>
 </div> -->

 <div class="card w-75 p-3 mt-5 mb-4 mx-auto">
  <div class="card-body">
    <blockquote class="blockquote bq-success">
      <p class="bq-title">Subject not found ?</p>
      <p class="mb-0 text-center">Add subjects below Instead</p>
    </blockquote>
 
  </div>

<!-- DONOT CHANGE ANYTHING HERE -->
<!-- DONOT CHANGE ANYTHING HERE -->
<div class="select-box">
	<div  id="selector" class="top-box" style="margin-bottom: 300px">
		<div class="md-form input-group mb-3 tokyo">
			<input id="inp" type="text" class="form-control" placeholder="Click here to add a subject" readonly>
			<button class="btn btn-info btn-elegant ml-3">ADD</button>
		</div>
		
	</div>
	<div id="lister" class="boxes">
		<div class="input-group md-form">
			<input id="search-box" type="text" class="form-control w-75" placeholder="Search Here " onkeyup="reload_list()">
			<div class="input-group-append">
				<button class="input-group-text btn-deep-orange btn-sm" onclick="func()">Close</button>
			</div>
		</div>
		<div id="long-list">
		</div>
	</div>
</div>





 
<script>
	//put all the subject code and paper name here.
	var obj = {
		// 'CS502' : ['Datastructure and Algorithmn design',0],
		// 'IT201' : ['Builging Economics', 0],
		// 'CT504' : ['Refractory', 0],
		// 'HS105' : ['English' , 0]
	}
</script>

 
<script type="text/javascript" src="js/tdh.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>




