<?php
session_start();
if(isset($_SESSION['loggedincoe'])){
	
	echo '
	<script>
	location.href="coe_dashboard.php";
	</script>
	'; 
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
		<title>COE login</title>
		<link rel="stylesheet" type="text/css" href="css/COA.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="js/COA.js"></script>
	</head>
	<body bgcolor="black">

	<nav>
		<div class="nav-wrapper black">
			<label class="brand-logo center amber-text">Examination Administrator Login<i class="material-icons">face</i></label>
			<ul class="right hide-on-med-and-down">
				<li><a class="waves-effect waves-light amber-text" href="smain.html">Student's Login</a></li> 
				<li><a class="waves-effect waves-light amber-text" href="teacher-login.html">Teacher's Login</a></li> 
			</ul>
		</div>
	</nav>

	<div id="wholepagewrapper"> <!-- centre align for whole page-->
	<!-- start of card -->
		<div class="row" style="padding-top:60px">
			<div class="col s12 ">
				<div class="card blue lighten-5 darken-1 z-depth-5 ">
					<div class="card-content grey darken-3 white-text">
							<span class="COA-LOGIN">Exam Administrator</span>
							<div class="container">
								<div class="row">
									<div class="col m6">
										<h2>Sign-in</h2>
											<div class="row">
												<form id="myForm" class="col s12 padtop80" method="post" action="coe-login2.php">
													<div class="row">
														<div class="input-field col s12">
															<input id="id" type="text" class="validate white-text" name="uname">
															
															<p id="iun">Invalid Username !</p>
															<label for="email" style="width:56px">Login ID</label>
														</div>
													</div>
													<div class="row">
														<div class="input-field col s12">
															<input id="pass" type="password" class="validate" name="psw">
															<p id="pwd">Incorrect Password !</p>
															<label for="pass" >Password</label>
														</div>
													</div>
													<input type=submit style="display:none">
												</form>
											</div>
											<div class="row">
												<div class="col s12" style="width: 600px">
													<p class="center-align">
														<button type="button" class="btn btn-large waves-effect waves-light lime black-text" onclick="func()">login<i class="material-icons right">people</i></button>
														
													</p>
												</div>
											</div>
									</div>
								</div>
							</div>
					</div>
				</div>
        <div class="card-action">
          <a href="change-coe-password.php">Reset Password </a>
        </div>
      </div>
    </div>
  </div>


	<footer>
		<div class="footer-copyright">
            <div class="container center-align" style="color: #595959;">
				© (2017-21) OpenCQ test platform by Soumya Mukherjee, Rashed Mehdi, Saranya Naha Roy, Rishav Banerjee
            </div>
        </div>
    </footer>
	<script>
		const form = document.querySelector('#myForm');
		form.addEventListener('submit',
		  (e)=>{
			  e.preventDefault();
			  func();
		  }
		);
	  
	</script>  


  </body>