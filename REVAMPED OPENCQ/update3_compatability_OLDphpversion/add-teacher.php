<?php






//This file adds takes username and password from coe to form new account of teacher.



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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add teacher</title>
    <link rel="icon" href="img/brandinglogo.png" type="image/icon type">
    <link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen"/>
    <link rel="stylesheet" href="css/teacher-csses.css" type="text/css">
     <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

	<script>
	
	
	$(document).ready(function(){
				$(\'select\').formSelect();
			});
	
	
	
	
	
		function addData() {
			var username = document.getElementById("username").value;
			var password = document.getElementById("password").value;
			var stream = document.getElementById("stream").value;
			if(username == "" ){
				M.toast({html: \'Please enter the username! :(\',classes:\'rounded\'});
			}
			else if(stream == \'1\'){
				M.toast({html: \'Please select the stream! :(\',classes:\'rounded\'});
			}
			else{
				M.toast({html: \'Updating.... Please Wait!  :)\',classes:\'rounded\'});
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						M.Toast.dismissAll();
						var str = this.responseText;
						
						var obj = JSON.parse(str);
						if(obj.status == "FAIL"){
							M.toast({html: obj.comment,classes:\'rounded\'});
						}
						else{
							M.toast({html: obj.comment,classes:\'rounded\'});
							document.getElementById("username").value = "";
							document.getElementById("password").value = "";
							document.querySelector(\'#stream [value="1"]\').selected = true;
						}
					}
				};
				xhttp.open("POST", "add_teacher_username.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("uname=" + encodeURIComponent(username) + "&psw=" + encodeURIComponent(password)+"&stream="+encodeURIComponent(stream));
				}
			}
			
			
			
	</script>

</head>
<body>
    <nav>
    <div class="row">
    <div class="nav-wrapper light-blue darken-4 col s12">
      <a href="#" class="brand-logo">     Teacher Section</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="coe_view_teachers.php">Back to previous page </a></li>
        
            </ul>
        </div>
    </div>
  </nav>


<div class="wholepagewrapper" >
  <!--navigation bar ends-->
  <div class="row" >
    <div class="col s8" style="margin-left: 18%;">
      <div class="card large white darken-1 z-depth-5">
        <div class="card-content black-text">
          <span class="card-title center "><h1>Add Faculty</h1></span>
          
            <!-- Username fields -->


                        <div class="row">
                            <div class="input-field col s10">
                                <i class="material-icons prefix">account_circle</i>
                                <input placeholder="Enter Username" id="username" type="text" class="validate" oninput="this.value = this.value.toUpperCase()">
                                <label for="first_name" style="color: #000000;">Username</label>
                            </div>
						</div>
						



      <!--password field-->
                        <div class="row">
                             <div class="input-field col s10">
                                <i class="material-icons prefix">keyboard</i>
                                <input placeholder="Enter Password" id="password" type="text" class="validate">
                                <label for="password" style="color: #000000;">Password</label>
                        </div>
						
						<div class="input-field" style="width: 700px;display: inline-block;float: left;margin-left: 15px">
						<i class="material-icons prefix">account_circle</i>
							<select id="stream">
							<option value="1" disabled selected>Please Select the stream</option>
							<option value="CSE">CSE</option>
							<option value="IT">IT</option>
							<option value="CT">CT</option>
							<option value="CT">BSEH</option>
							</select >
							
							<label class="cyan-tex" style="font-size: 16;"><b>Stream:</b></label>
						</div>
						
						
						
						

            <div class="card-action center">
                    <!-- js ta kaj korche na parle dekis <a onclick="M.toast({html: \'Clearing input...... :)\',classes:\'rounded\'})" class="waves-effect waves-light red lighten-1 btn"><i class="material-icons right">cached</i>CLEAR INPUT</a> -->
                    <a onclick="addData()" class="waves-effect waves-light green darken-3 btn">
						<i class="material-icons right">save</i>Add AND CONTINUE</a>
            </div>
        </div>
    </div>
    </div
</div>
</div>       
</body>
</html>


';


}


?> 	