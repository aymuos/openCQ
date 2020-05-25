<?php
require('sender_header.php');
require('library.php');
session_start();
if ( isset($_SESSION['loggedincoe']) == false ){
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
<p class="text-center">Please <a href="smain.html">Login</a> first</p>
</div>
</div>
</body>
</html>
';
exit();
}
try{
$data['username'] = $_GET['u'];
$data['key']=key; 
$url = location."student_info.php";
$result = json_decode(send_get_request($url,$data));

    if(isset($result->{'status'})){
        
        echo '
          <script>
          sessionStorage.setItem(\'error\',\'';
          
          echo $result->{'comment'};
          echo
          '
          \');
    
          window.location = \'tdberrormessage.htm\';
          </script>
    
        ';
      }

}
catch(Exception $e){
    report($e);
    echo '
    <script>
    sessionStorage.setItem(\'error\',\'';
    
    echo "server error";
    echo
    '
    \');

    window.location = \'tdberrormessage.htm\';
    </script>

  ';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    
    <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
    <!-- <script >
       (function($){
 
  $(function(){
 
    // Plugin initialization
 
    $('select').not('.disabled').formSelect();
 
  });
 
})(jQuery); // end of jQuery name space -->
 
    
    
    </script>
        <!-- <link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen"/> -->
    <link rel="stylesheet" href="css/teacher-csses.css" type="text/css">
     <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="css/materialize.min.css">


   
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
 <script type = "text/javascript"
         src = "js/jquery.min.js"></script>
<script type = "text/javascript"
         src = "js/materialize.min.js"></script>

		

  <!-- <script type = "text/javascript"
         src = "js/script2.js"></script> -->
 
	<script>
		function calc(){
			$("#passout_yr").val(+$("#start_yr").val() + 4 );
		}
		function reset_pass(){
			M.toast({html: 'Updating.... Please Wait!  :)',classes:'rounded'});
			let username = document.getElementById("honortitle").value;
			let password = document.getElementById("npsw").value;
			$.post("coe_reset_password_student.php", {"username" : username,"password" : password,"cat" : 2},function(data, status){
				res = JSON.parse(data);
				if(res.status == "OK"){
					$('#modal2').modal('close');
					M.toast({html: 'Password changed Successfully!  :)',classes:'rounded'});
				}
				else{
					$('#modal2').modal('close');
					M.toast({html: res.comment+'!  :(',classes:'rounded'});
				}
				$("$npsw").val("");
			});
		}
	
	</script>
	<script>
			(function ($) {
				$(function () {
					//initialize all modals           
					$('.modal').modal();
					//or by click on trigger
					$('.trigger-modal').modal();
				}); // end of document ready
			})(jQuery); // end of jQuery name space
		</script>
 

</head>
<body>

     
    <nav>
    <div class="row">
    <div class="nav-wrapper orange darken-3 col s12">
      <a href="#" class="brand-logo">  Configure Student Details </a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li>
            <a class="waves-effect waves-light black white-text btn" href="coe_dashboard.php"><i class="material-icons left">dashboard</i>GO TO DASHBOARD</a></li>
             <a class="waves-effect waves-light black white-text btn modal-trigger" href="#modal2"><i class="material-icons left">cached</i>RESET PASSWORD</a></li>
        
            </ul>
        </div>
    </div>
  </nav>



  <!--navigation bar ends-->
  <div id="centering">
  <div class="row">
    <div class="col s10 offset-s1">
      <div class="card wide white z-depth-5">
        <div class="card-content  black-text">
          <span class="card-title center"><h4>Student Details</h4></span>
          
<!--bhetorer maal-->
<div class="row">
    <form class="col s10 offset-s1">
      <div class="row">
      <div class="input-field col s4">
      <i class="material-icons prefix">label</i>
          <input value="<?php echo $result->{'username'}?>" id="honortitle" type="text" readonly>
          <label for="last_name">username</label>
        </div>
        <div class="input-field col s8">
                  <i class="material-icons prefix">face</i>
                  <input id="name" value="<?php echo $result->{'name'} ?>" type="text" class="validate">
            <label for="first_name">Name</label>
        </div>
      
    

   <!--year of joining-->
<div class="row">
        <div class="col s8">
        <i class="material-icons prefix">watch_later</i>
          Input Your Batch:
          <div class="input-field inline">
          <div class="row">
            <div class="col s1">
            <br/>
            
            </div>
            <div class="col s5">
            <input id="start_yr" value=<?php echo $result->{'pass out year'}-4 ?> type="number" class="validate" min="2016" onchange="calc()" max="2040" >
            <label for="start_yr">Starting Year</label>
            
            
            </div>


            <div class="col s6">
            
            <input id="passout_yr" value="<?php echo $result->{'pass out year'}?>" type="number"  min="2020" max="2044" readonly>
            <label for="passout_yr">Passout Year</label>
            
            </div>
          </div>
          
            

            
          </div>
        </div>
        <div class=" inline col s4" >
    Department:
      <label>
        <input  name="group1" type="radio" value="IT"
        <?php echo ($result->{'department'}=="IT")?"checked":""  ?>/>
        <span>IT     </span>
      </label>
      <label>
        <input   name="group1" type="radio" value="CSE"
        <?php echo ($result->{'department'}=="CSE")?"checked":""  ?>/>
        <span>CSE   </span>
      </label>
   
      <label>
        <input   name="group1" type="radio"  value="CT"
        <?php echo ($result->{'department'}=="CT")?"checked":""  ?>/>
        <span>CT   </span>
      </label>
      
</div>
</div>
 </div>


      <div class="row">
        <div class="input-field col s6 ">
        <i class="material-icons prefix">house</i>
          <input placeholder="EXAMPLE: 171130110000" id="reg_no" value=<?php echo intval($result->{'registration no'})  ?> type="number" class="validate">
          <label for="reg_no">Registration Number</label>
        </div>
      </div>
       <div class="row">
        <div class="input-field col s6">
        <i class="material-icons prefix">alternate_email</i>
          <input id="email" value=<?php echo $result->{'email'}?> type="email" class="validate">
          <label for="email">Email</label>
          <span class="helper-text" data-error="wrong format" data-success="Success"></span>
        </div>

        <div class="input-field col s6">
        <i class="material-icons prefix">local_phone</i>
        <input placeholder="Contact Number" id="phoneno" value="<?php echo $result->{'contact no'}?>" type="tel" class="validate" pattern="[0-9]{10}"        >
        <label for="phoneno">Contact Number</label>
        <span class="helper-text" data-error="wrong format" data-success="Success"></span>
      </div>
    </form>
  </div>

        </div>
        <div class="card-action center">
         <a class="waves-effect waves-light red accent-3 center z-depth-4 btn" href="coe_view_students.php"><i class="material-icons right">refresh</i>Back</a> 

         <a onclick="updateStudent()" class="waves-effect waves-light teal darken-4 center z-depth-4 btn "><i class="material-icons right">save</i>Save & Continue</a>
        </div>
      </div>
    </div>
  </div>
</div> 








<div id="modal2" class="modal">
	<div class="modal-content">
		<h4 style="font-family: comic sans;">Reset Password</h4>
		<br>
		<div style="text-align: center">
			<label>New Password : </label>&emsp;
			<input type="text" id="npsw" style="width: 350px;" >
			<br>
			<br>
			<br>
		<div class="modal-button">
			<button class="btn waves-effect waves-light btn-check" onclick="reset_pass()">Change<i class="material-icons right" >check</i></button>
			<button class="btn waves-effect waves-light btn-cancel modal-close" >Cancel<i class="material-icons right">cancel</i></button>
		</div>
	</div>
	</div>
</div>














			<script>
				function updateStudent(){
					M.toast({html: 'Updating.... Please Wait!  :)',classes:'rounded'});
					
					let username = document.getElementById("honortitle").value;
					let name = document.getElementById("name").value;
					let stream = document.querySelector('input[name="group1"]:checked').value;
					let registration_no = document.getElementById("reg_no").value;
					let joining_year = document.getElementById("start_yr").value;
					let email = document.getElementById("email").value;
					let contact_no = document.getElementById("phoneno").value;
					//alert(stream);
					fetch(
						'coe_update_student_details.php'
						,
						{
							method: "POST",
							body: JSON.stringify({username,name,stream,registration_no,joining_year,email,contact_no}),
							headers:
							{
								"Content-Type": "application/json"
							} 
						}
					)
				.then(
					(response)=>{
						if(response.status!=200){
							throw new Error("cannot fetch data");
						}
					return response.json();
				}
			)
		.then(
			(data)=>{
				if(data.status=="OK"){
					M.toast({html: 'Record Updated Successfully!  :)',classes:'rounded'});
				}
				else{
					throw new Error(`${data.comment}`);
				}
			}
		)
		.catch(
			(e)=>{
				sessionStorage.setItem('error',`${e.message}`);
				location.href = 'tdberrormessage.htm';
			}
		);
	}

            </script> 
</body>
</html>
