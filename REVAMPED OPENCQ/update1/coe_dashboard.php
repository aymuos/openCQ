<?php


//This is the dashboard of COE. 
//No need to modify this file.
//Security has been provided

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



echo '
<html>
	<head>
		<title>Welcome</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    	<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
       
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
		<link rel="stylesheet" type="text/css" href="css/te.css">
		<script>
			$(document).ready(function(){
				$(".modal").modal();
			});
		
			function generate(){
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
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
		<div class="heading">
			<div class="left-logo">
				<img src="img/logo256.png" class="ing">
			</div>
			<label class="writing">Controller of Examinations</label>
			<div class="right-logo">
				<a class="ing2" href="coe_logout.php"><i class="material-icons left">input</i>Logout</a>
			</div>
		</div>
	
	
		<div class="container">
			<div class="row valign-wrapper">
				<div class="col s12">
					<div class="card white darken-3 z-depth-5">
						<div class="card-content red-text darken-4">
							<span class="card-title"><b>COE CONTROL CENTER<b></span>
						</div>
					</div>
				</div>
			</div>  
    
			<!-- COe Cards Ends here-->

			<div class="row">
				<div class="col s12 ">
					<div class="card teal darken-3 z-depth-5">
						<div class="card-content lime-text darken-4">
							<span class="card-title"><p class="cj">Examination Control</p></span>
							<!-- inside the Card-->
							<a class="waves-effect brown darken-1 col  waves-light btn" href="coe_exams_present.php" style="margin-right: 40px"><i class="material-icons left">assessment</i>RUNNING EXAMS</a>
								<!-- <a class="col s1"> </a> -->
							<a class="waves-effect green darken-1 col  waves-light btn" href="coe_exams_past.php" style="margin-right: 40px"><i class="material-icons left">content_copy</i>Past Exams</a>
								<!-- <a class="col s1"> </a> -->
							<a class="btn waves-effect deep-purple darken-4 col  waves-light " href="coe_exams_future.php" style="margin-right: 40px">
								<i class="material-icons left">description</i>AVAILABLE EXAMS</a>
							
								<!-- <a class="col s1"> </a> -->
							<a class="btn waves-effect yellow darken-4 col  waves-light " onclick="generate()" >
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
					<div class="card teal darken-3 z-depth-5">
						<div class="card-content lime-text darken-4">
							<span class="card-title"><p class="cj">Academic Section</p></span> 
							<!-- inside the Card-->
							<a class="waves-effect red darken-4 col s3 waves-light btn" href="coe_view_students.php">
								<i class="material-icons left">people</i>Students</a>
								
							<a class="col s1"> </a>
							<a class="waves-effect pink col s3 z-depth-4 waves-light btn" href="coe_availablesubcodes.php">
								<i class="material-icons left" >explore</i>Subject codes</a>
							<a class="col s1"> </a>
							<a class="waves-effect blue darken-4 col s3 waves-light btn" href="coe_view_teachers.php"><i class="material-icons left">person</i>Teacher</a>
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