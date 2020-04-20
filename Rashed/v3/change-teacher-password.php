<?php


//This is the dashboard of COE. 
//No need to modify this file.
//Security has been provided



session_start();
if ( isset($_SESSION['loggedinmaster']) == false ){
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <link rel="icon" href="brandinglogo.png" type="image/icon type">
        <link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen"/>
    <link rel="stylesheet" href="teacher-csses.css" type="text/css">
     <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	
	<script>
		function updatePassword(){
			var old_password = document.getElementById("old_password").value;
			var new_password = document.getElementById("new_password").value;
			var re_password = document.getElementById("re_password").value;
			if(new_password != re_password ){
				M.toast({html: \'New Password re-entered did not matched! :(\',classes:\'rounded\'});
				document.getElementById("re_password").style.borderColor = "red";
				document.getElementById("re_password").style.boxShadow = "0 1px 0 0 red";
				document.getElementById("new_password").style.borderColor = "red";
				document.getElementById("new_password").style.boxShadow = "0 1px 0 0 red";
			}
			else{
				M.toast({html: \'Updating.... Please Wait!  :)\',classes:\'rounded\'});
				document.getElementById("re_password").style.borderColor = "#9e9e9e";
				document.getElementById("re_password").style.boxShadow = "none";
				document.getElementById("new_password").style.borderColor = "#9e9e9e";
				document.getElementById("new_password").style.boxShadow = "none";
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						M.Toast.dismissAll();
						var str = this.responseText;
						M.toast({html: str,classes:\'rounded\'});
						document.getElementById("old_password").value = "";
						document.getElementById("new_password").value = "";
						document.getElementById("re_password").value = "";
					}
				};
				xhttp.open("POST", "update_teacher_password.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("old_password=" + encodeURIComponent(old_password) + "&new_password=" + encodeURIComponent(new_password));
			}
			
			
		}
	
	</script>
	
	
	
</head>
<body>
    <nav>
    <div class="row">
    <div class="nav-wrapper light-blue darken-4 col s12">
      <a href="#" class="brand-logo">     Change Faculty Password</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
		<li><a href="teacher-details.php">Account</a></li>
        <li><a href="master-dashboard.php">Dashboard</a></li>
        
            </ul>
        </div>
    </div>
  </nav>



  <!--navigation bar ends-->
  <div id="wholepagewrapper">
  <div class="row">
    <div class="col s12 centered">
      <div class="card large grey lighten-4">
        <div class="card-content black-text">
          <span class="card-title" style="text-align: center;"><h4>Change your password</h4></span>
          

          <p> <h6> Enter old Password </h6>

           <div class="row">
        <div class="input-field col s12">
          <input id="old_password" type="password" class="validate">
          <label for="passwordold" style="width: 90px;">Old Password</label>
        </div>
      </div>
    <p><h6> Enter and Validate New Password </h6> </p>
       <div class="row">
        <div class="input-field col s12">
          <input id="new_password" type="password" class="validate" >
          <label for="password" style="width: 100px;">New Password</label>
        </div>
      </div>
       <div class="row">
        <div class="input-field col s12">
          <input id="re_password" type="password" class="validate" style="">
          <label for="password" style="width: 112px;">Retype Password</label>
        </div>
      </div>
        </div>
        <div class="card-action center">
          <a onclick="updatePassword()" class="waves-effect waves-light red accent-3 center z-depth-4 btn"><i class="material-icons right">send</i>Save & Continue</a>
        </div>
      </div>
    </div>
  </div>
</div>       
</body>
</html>




';


}


?>