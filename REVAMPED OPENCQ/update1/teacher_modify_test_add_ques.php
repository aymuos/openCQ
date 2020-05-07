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
      <title>Select Chapters</title>
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
      <a class="brand-logo" href="#"><h5>   Teacher Userspace -Select Subjects </h5></a>
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
        <a href="#!" class="breadcrumb">Test Dashboard</a>
        <a href="#!" class="breadcrumb">Select Chapter</a>
      </div>
    </div>
  </nav>
            

<!--MAIN CARD CONTENTS OPENS-->

 <div class="row">
    <div class="col s10 offset-s1">
      <div class="card leftpad white z-depth-4">
        <span class="black-text">
        <div class="row">
        <div class="col s6">
        <p class= "leftpad" > <b>Teacher Name : </b><?php echo $_SESSION['name']; ?> </p> <!--JS bring username from api-->
        </div>
        
        <div class="col s6">
         <p class= "leftpad"> <b>Selected Subject : </b><?php echo $_SESSION['code']; ?></p>
        </div>
        </div>
        
       
        </span>
      </div>
    </div>
  </div>

  <div ><h4 class= "center-align"> Choose a chapter from the following list </h4></div>
  
<?php

require('sender_header.php');
	$username=$_SESSION['usernameteacher']; 
	$password=$_SESSION['passwordteacher']; 
	$api="all_chapters.php";
	$data = array(	"key" => key,
					"username" => $username,
					"code" => $_SESSION['code']
				);
	
	$result = send_get_request(location.$api,$data);

	$ans = json_decode($result);
	if($ans->{'status'} == "FAIL"){
		echo $ans->comment;
		echo '<div class="white" style="font-size: 32px;text-align: center;margin-top: 100px">Error Occurred! :(</div>';
	}
	else{
		//echo $result;
		
		for($i=0;$i<count($ans->result);$i++){
			echo '
		<div class="row">
    <div class="col s8 offset-s2 ">
      <div class="card subcardsize blue accent-4">
        <div class="card-content white-text">
        <div class="col s10">
			<span class="card-title thick">Chapter '.($i+1).' : '.($ans->result[$i]->name).'</span>
			
        </div>
         
          <div class="col s1" style="margin-top: 10px"> <span class="badge"><a class="waves-effect waves-light btn-small black white-text">'.($ans->result[$i]->numberOfQuestions).'</a></span></div>

           <div class="col s1"><button class="btn-floating  btn-large waves-effect waves-light teal lighten-4 black-text" onclick="select_ques('.($ans->result[$i]->id).')">GO
    <i class="material-icons right">arrow_forward</i>
  </button></div>

          
        </div>
      </div>
    </div>
  </div>';
		}
	
	}





?>
            
  
   <div class="container center" style="margin-top: 80px">
	<a class="btn red" onclick="window.history.back()">Back</a>
   </div>


      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script>
		function select_ques(id){
			window.location.href = 'teacher_modify_test_add_ques2.php?c='+id;
		}
	  </script>
    </body>
  </html>