<?php
session_start();
if(isset($_SESSION['loggedinteacher'])){
	
	echo '
	<script>
	location.href="tdbselectsubjectv1.php";
	</script>
	'; 
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<link rel="icon" href="img/brandinglogo.png" type="image/icon type">
		<title>Teacher's login</title>
		<link rel="stylesheet" type="text/css" href="css/teacher-login.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="js/teacher-login.js"></script>
	</head>
	<body>

	<nav>
		<div class="nav-wrapper blue">
			<label class="brand-logo center">Teacher Login<i class="material-icons">face</i></label>
			<ul class="right hide-on-med-and-down">
				<li><a class="waves-effect waves-light" href="smain.html">Student's Login</a></li> 
				<li><a class="waves-effect waves-light" href="coe-login.html">COE's Login</a></li> 
			</ul>
		</div>
	</nav>

	<div id="wholepagewrapper"> <!-- centre align for whole page-->
	<!-- start of card -->
		<div class="row">
			<div class="col s12 ">
				<div class="card z-depth-5 ">
					<div class="card-content white-text">
							<div class="container">
								<div class="row">
									<div class="col m6">
										<h2 style="color: #4d94ff">Sign-in</h2>
											<div class="row">
												<form id="teacherlogin">
													<div class="row">
														<div class="input-field col s12">
															<input id="id" type="text" class="validate" name="uname">
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
												<div class="col m12" style="width: 600px">
													<p class="center-align">
														<button type="button" class="btn btn-large waves-effect waves-light blue" onclick="func()">login<i class="material-icons right">people</i></button>
														
													</p>
												</div>
											</div>
											
												
									</div>
								</div>
							</div>
					</div>
				</div>
        <div class="card-action">
          <a href="#">Forgot Password </a>
        </div>
      </div>
    </div>
  </div>


	<footer>
		<div class="footer-copyright">
            <div class="container" style="color: #595959;">
				© (2017-21) Soumya Mukherjee, Rashed Mehdi, Saranya Naha Roy, Rishav Banerjee
            </div>
        </div>
    </footer>
      <script>
		  const form = document.querySelector('#teacherlogin');
		  form.addEventListener('submit',
			(e)=>{
				e.preventDefault();
				func();
			}
		  );
		
	  </script>
  </body>