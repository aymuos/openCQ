<?php


//This is the dashboard of COE. 
//No need to modify this file.
//Security has been provided

session_start();
if ( isset($_SESSION['loggedincoe']) == false ){
echo ' 
<html>
<head>
<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <title>Oops!!!</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
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



echo '
<html>
	<head>
	<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
		<title>COE dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    	<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="css/materialize.min.css">
       
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script> 
		<link rel="stylesheet" type="text/css" href="css/te.css">
		<script>
			$(document).ready(function(){
				$(".modal").modal();
			});
		
			function generate(){
				M.toast({html: "Please Wait! :)",classes: \'rounded\'});
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						// alert(this.responseText);
						var res = JSON.parse(this.responseText);
						if(res.status == "FAIL"){
							M.toast({html: res.comment+"! :(",classes: \'rounded\'});
						}
						else{
							M.toast({html: res.comment,classes: \'rounded\'});
						}
					}
				};
				xhttp.open("GET", "coe_gen_res.php", true);
				xhttp.send();
			}
		</script>
	</head>
	<body>


		<nav>
    <div class="row">
	<div class="nav-wrapper black  col s12">
	<div class="left-logo">
				<img src="img/logo256.png" class="ing">
			</div>
    <label class="brand-logo center"><a href ="#!"> COE Dashboard Home </a><i class="material-icons">portrait</i></label>
    
      <ul id="nav-mobile" class="right ">
		<li><a style="display:none" role="button" class="btn waves-effect waves-light z-depth-3 deep-purple darken-4" href="student-details.php">Account</a></li>
        <li><a role="button" class="btn waves-effect waves-light grey darken-4 z-depth-3 ing2 amber-text" href="logout.php" >LOGOUT<i class="material-icons left">input</i></a></li>
    
        
            </ul>
        </div>
    </div>
  </nav>
	
	
		<div class="container" style="width: 80%">
			<div class="row valign-wrapper">
				<div class="col s12">
					<div class="card black z-depth-5" >
						<div class="card-content red-text darken-4">
							<span class="card-title"><b>COE CONTROL CENTER<b></span>
						
    
			<!-- COe Cards Ends here-->

			<div class="row">
				<div class="col s12">
					<div class="card deep-purple darken-4 z-depth-5" >
						<div class="card-content lime-text darken-4">
							<span class="card-title"><p class="cj">Examination Control</p></span>
							<!-- inside the Card-->
							<a class="waves-effect brown z-depth-4 darken-1 waves-light btn" href="coe_exams_present.php" style="margin-right:20px"><i class="material-icons left">assessment</i>RUNNING EXAMS</a>
								<!-- <a class="col s1"> </a> -->
							<a class="waves-effect green darken-1  z-depth-4 waves-light btn" href="coe_exams_past.php" style="margin-right: 20px"><i class="material-icons left">history</i>Past Exams</a>
								<!-- <a class="col s1"> </a> -->
							<a class="btn waves-effect blue darken-2 z-depth-4 waves-light " href="coe_exams_future.php" style="margin-right: 20px">
								<i class="material-icons left">timeline</i>AVAILABLE EXAMS</a>
							
								 <!-- <a class="col s3"> </a> --> 
							<a class="btn waves-effect orange darken-4 waves-light z-depth-4 " onclick="generate()">
								<i class="material-icons left">description</i>Generate Results</a>
							<!--<a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">content_copy</i></a> -->
							<!-- @rashed include the following line when no exams are running  -->
							<!--<a class="btn disabled">Button</a> -->
						</div>
					</div>
				</div>
			</div>
	

			<!-- second part of the page-->

			<div class="row">
				<div class="col s12 ">
					<div class="card deep-purple darken-4 z-depth-5">
						<div class="card-content amber-text darken-4">
							<span class="card-title"><p class="cj">Academic Section</p></span> 
							<!-- inside the Card-->
							<div class="row">
							<a class="col s0"> </a>
							<a class="waves-effect red col s3 darken-4  waves-light btn z-depth-4" href="coe_view_students.php">
								<i class="material-icons left">people</i>Students</a>
								
							<a class="col s1"> </a>
							<a class="waves-effect blue-grey col s3 z-depth-4 z-depth-4 waves-light btn" href="coe_availablesubcodes.php">
								<i class="material-icons left" >explore</i>Subject codes</a>
							<a class="col s1"> </a>
							<a class="waves-effect blue darken-4 z-depth-4 col s3 waves-light btn" href="coe_view_teachers.php" ><i class="material-icons left">person</i>Faculty</a>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>




		<div class="container">
			<div class="row valign-wrapper">
				<div class="col s12">
					<div class="card purple darken-4 z-depth-5">
						<div class="card-content amber-text darken-4">
							<span class="card-title"><p class="cj">Change Password</p></span>
							<div class="card-content"><a class="waves-effect greeen darken-4 z-depth-4 waves-light btn center-align" href="change-coe-password.php"> <i class="material-icons left">refresh</i>Reset</a></div>
							
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
				<button class="btn waves-effect waves-light btn-check z-depth-4" onclick="end_test_all()">Yes<i class="material-icons right" >check</i></button>
				<button class="btn waves-effect waves-light btn-cancel modal-close z-depth-4" >No<i class="material-icons right">cancel</i></button>
			</div>
		</div>	
	
	</body>


';



}



?>