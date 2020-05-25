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
  <link rel="stylesheet" href="css/COA.css">
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <link rel="icon" href="img/brandinglogo.png" type="image/icon type">
        <!--<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen"/>-->
    <link rel="stylesheet" href="css/teacher-csses.css" type="text/css">
     <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="js/materialize.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	
  <script>
    cat={};
		function updatePassword(){
			var old_password = document.getElementById("old_password").value;
			var new_password = document.getElementById("new_password").value;
			var re_password = document.getElementById("re_password").value;
			if(new_password != re_password ){
				M.toast({html: \'New Password re-entered did not match! :(\',classes:\'rounded\'});
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
        fetch(
          \'coeChangePassword.php\',
          {
            method: "POST",
            body: JSON.stringify({
              category: "0",
              old_password: old_password,
              new_password: new_password
            }),
            headers:{
              "Content-Type": "application/json"
            } 
          }



        ).then(
          (response)=>{
            if(response.status!=200){
              throw new Error("cannot fetch data");
            }
            return response.json();
          } 
          
        ).then(

          (data)=>{
            if(data.status!="OK"){
              throw new Error(`${data.comment}`);
            }
            else{
              ';
              echo 'location.href = "logout.php";
            }
          } 

        ).catch(

          (e)=>{
            //redirect
            sessionStorage.setItem(\'error\',`${e.message}`);
            location.href = \'tdberrormessage.htm\';;
          } 

        ); 
				// var xhttp = new XMLHttpRequest();
				// xhttp.onreadystatechange = function() {
				// 	if (this.readyState == 4 && this.status == 200) {
				// 		M.Toast.dismissAll();
				// 		var str = this.responseText;
				// 		M.toast({html: str,classes:\'rounded\'});
				// 		document.getElementById("old_password").value = "";
				// 		document.getElementById("new_password").value = "";
				// 		document.getElementById("re_password").value = "";
				// 	}
				// };
				// xhttp.open("POST", "update_teacher_password.php", true);
				// xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				// xhttp.send("old_password=" + encodeURIComponent(old_password) + "&new_password=" + encodeURIComponent(new_password));
			}
			
			
		}
	
	</script>
	
	
	
</head>
<body style = "font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif;)" class="bodybg">
    <nav>
    <div class="row">
    <div class="nav-wrapper black  col s12">
    <label class="brand-logo center"><a href ="#!">Change Password - COE Userspace</a><i class="material-icons">portrait</i></label>
    
      <ul id="nav-mobile" class="right ">
		<li><a style="display:none" role="button" class="btn waves-effect waves-light z-depth-3 deep-purple darken-4" href="student-details.php">Account</a></li>
        <li><a role="button" class="btn waves-effect waves-light grey darken-4 z-depth-3" href="coe_dashboard.php">BACK TO DASHBOARD</a></li>
    
        
            </ul>
        </div>
    </div>
  </nav>


  <!--navigation bar ends-->
  <div id="wholepagewrapper z-depth-3" style="padding-top:50px">
  <div class="row">
    <div class="col s6 offset-s3  centered">
      <div class="card white">
        <div class="card-content black-text centered">
          <span class="card-title" style="text-align: center;"><h4>Change your password</h4></span>
          <br/>
          <br/>
          

          <p > <h6 class="center-align"> Enter old Password </h6>

           <div class="row">
        <div class="input-field col s8 offset-s2">
          <input id="old_password" type="password" class="validate">
          <label for="passwordold" style="width: 90px;">Old Password</label>
        </div>
      </div>
    <p><h6  class="center-align"> Enter and Validate New Password </h6> </p>
       <div class="row">
        <div class="input-field col s8 offset-s2">
          <input id="new_password" type="password" class="validate" >
          <label for="password" style="width: 100px;">New Password</label>
        </div>
      </div>
       <div class="row">
        <div class="input-field col s8 offset-s2">
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