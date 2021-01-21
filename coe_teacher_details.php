<?php


//This takes up details from teacher

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
<p class="text-center">Please <a href="teacher-login.html">Login</a> first</p>
</div>
</div>
</body>
</html>
';
}
else {

  try{
    $data['username'] = $_GET['u'];
    $data['key']=key; 
    $url = location."teacher_info.php";
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

  




	echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/brandinglogo.png" type="image/x-icon"> 
    <title>Add teacher</title>
    


    <link rel="stylesheet" href="css/teacher-csses.css" type="text/css">
	<script type = "text/javascript"
         src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
     <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
 

    <script>
    cat = {};
			function saveDetails(){
				M.toast({html: \'Updating.... Please Wait!  :)\',classes:\'rounded\'});
				var first_name = document.getElementById("first_name").value;
				var username = document.getElementById("username").value;
				var designation = document.getElementById("designation").value;
				var group1 = document.getElementById("group1").value;
				var address = document.getElementById("address").value;
				var email = document.getElementById("email").value;
        var phoneno = document.getElementById("phoneno").value;
        fetch(\'coe_update_teacher_details.php\',
        {
          method: "POST",
          body: JSON.stringify({
			username : username,
            name: first_name,
            department: group1,
            designation: designation,
            address: address,
            email: email,
            contact_no: phoneno 
          }),
          headers:{
            "Content-Type": "application/json"
          } 
        }
      ).then(
        (response)=>{
		//alert(response);
        // cat = response;
        if(response.status!=200){
          throw new Error(\'can not fetch data\');
        }
        return response.json();  
      }
    ).then(
      (data)=>{
      if(data.status=="OK"){
        M.toast({html: \'Record Updated successfully  :)\',classes:\'rounded\'});
      } 
      else{
        throw new Error(`${data.comment}`);
      }
    }
    ).catch(
      (e)=>{
        sessionStorage.setItem(\'error\',`${e.message}`);
        location.href = \'tdberrormessage.htm\';
      }
    );
    };
			// 	var xhttp = new XMLHttpRequest();
			// 	xhttp.onreadystatechange = function() {
			// 		if (this.readyState == 4 && this.status == 200) {
			// 			M.Toast.dismissAll();
			// 			var str = this.responseText;
			// 			M.toast({html: str,classes:\'rounded\'});
			// 			document.getElementById("honortitle").readOnly = true;
			// 			document.getElementById("first_name").readOnly = true;
			// 			document.getElementById("last_name").readOnly = true;
			// 			document.getElementById("designation").readOnly = true;
			// 			document.getElementById("group1").disabled = true;
			// 			document.getElementById("address").readOnly = true;
			// 			document.getElementById("email").readOnly = true;
			// 			document.getElementById("phoneno").readOnly = true;
			// 		}
			// 	};
			// 	xhttp.open("POST", "update_teacher_details.php", true);
			// 	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			// 	xhttp.send("honortitle=" + encodeURIComponent(honortitle) 
			// 							+ "&first_name=" + encodeURIComponent(first_name)
			// 							+ "&last_name=" + encodeURIComponent(last_name)
			// 							+ "&designation=" + encodeURIComponent(designation)
			// 							+ "&group1=" + encodeURIComponent(group1)
			// 							+ "&address=" + encodeURIComponent(address)
			// 							+ "&email=" + encodeURIComponent(email)
			// 							+ "&phoneno=" + encodeURIComponent(phoneno));
			// }
			
			
			
			
			// function editDetails(){
			// 	M.toast({html: \'You can edit the details now! :)\',classes:\'rounded\'});
			// 	document.getElementById("honortitle").readOnly = false;
			// 	document.getElementById("first_name").readOnly = false;
			// 	document.getElementById("last_name").readOnly = false;
			// 	document.getElementById("designation").readOnly = false;
			// 	document.getElementById("group1").disabled = false;
			// 	document.getElementById("address").readOnly = false;
			// 	document.getElementById("email").readOnly = false;
			// 	document.getElementById("phoneno").readOnly = false;
			// }
			
			
			
			
			
		</script>
		<script>
			(function ($) {
				$(function () {
					//initialize all modals           
					$(\'.modal\').modal();
					//or by click on trigger
					$(\'.trigger-modal\').modal();
				}); // end of document ready
			})(jQuery); // end of jQuery name space
			
			
			
			
			
		function reset_pass(){
			M.toast({html: \'Updating.... Please Wait!  :)\',classes:\'rounded\'});
			let username = document.getElementById("username").value;
			let password = document.getElementById("npsw").value;
			$.post("coe_reset_password_student.php", {"username" : username,"password" : password,"cat" : 1},function(data, status){
				res = JSON.parse(data);
				if(res.status == "OK"){
					$(\'#modal2\').modal(\'close\');
					M.toast({html: \'Password changed Successfully!  :)\',classes:\'rounded\'});
				}
				else{
					$(\'#modal2\').modal(\'close\');
					M.toast({html: res.comment+\'!  :(\',classes:\'rounded\'});
				}
				$("$npsw").val("");
			});
		}
			
			
			
			
			
			
			
			
		</script>
</head>
<body>

     
    <nav>
    <div class="row">
    <div class="nav-wrapper light-blue darken-4 col s12">
      <a href="" class="brand-logo">     Teacher Section</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
		<li><a class="modal-trigger" href="#modal2">Reset Password</a></li>
        <li><a href="coe_dashboard.php">Dashboard </a></li>
        
            </ul>
        </div>
    </div>
  </nav>



  <!--navigation bar ends-->
  <div id="centering">
  <div class="row">
    <div class="col s12 m12">
      <div class="card wide white z-depth-5">
        <div class="card-content  indigo-text">
          <span class="card-title center"><h4>Enter Faculty Details</h4></span>
          
<!--bhetorer maal-->
<div class="row">
    <form class="col s12">
      <div class="row">

        <div class="input-field col s5">
        <i class="material-icons prefix">account_circle</i>
        <input id="username" type="text" value="';
    
    
    //print the last name here...
    echo $result->{'username'};
    
    
    echo '" readonly>
        <label for="username">Username</label>
      </div>
        <div class="input-field col s5">
        <i class="material-icons prefix">face</i>
          <input id="first_name" type="text" class="validate" value="';
		  
		  
      //Put the first name here.......
      //$name = $details['name'];
      

		  echo $result->{'name'};
		  
		  echo '">
          <label for="first_name">Name</label>
        </div>

      </div>
    

    <!--following code horizontal space take 6 r6 e brak koreche first 6 ta kaaj korche but drop down ta kaaj korche na-->
		<div class="row" >
        <div class="input-field col s6">
                <i class="material-icons prefix">business_center</i>
            <input placeholder="Professor/Assistant Professor/Head of the Department/Teaching Asssistant/ Visiting Faculty " id="designation" type="text" class="validate" value="';
			
			
			//Print the designation here....
			echo $result->{'designation'};
			
			
			echo '">
            <label for="designation">Designation</label>
        </div>
    
        <div class="input-field col s6">
        <!-- <label style="color: #000000;">Select Stream : </label> -->
               <select id="group1" class="browser-default" style="margin-left: 100px;width: 450px">
                  <option value = ""'; 
				  
          $ct = 1;
          $dept = $result->{'department'};
				  if($dept===NULL || $dept==''){		//If no department is present then this condition is satisfied
					  echo 'selected';
				  }
				  
				  
				  
				  echo ' disabled>--------------------Please Select the Stream--------------------</option>
                  <option value = "CSE"';
				  
				  
				  $ct = 1;
				  if($dept=='CSE'){		//If department is CSE then this condition is satisfied
					  echo 'selected';
				  }
				  
				  echo '>CSE</option>
                  <option value = "CT"';
				  
				  
				  $ct = 1;
				  if($dept=='CT'){		//If department is CT then this condition is satisfied
					  echo 'selected';
				  }
				  
				  echo '>CT</option>
                  <option value = "IT"';
				  
				  
				  $ct = 1;
				  if($dept=='IT'){		//If department is IT then this condition is satisfied
					  echo 'selected';
				  }
				  
				  echo '>IT</option>
                  <option value = "BSEH"';
				  
				  
				  $ct = 1;
				  if($dept=='BSEH'){		//If department is General Science then this condition is satisfied
					  echo 'selected';
				  }
				  
				  echo '>BSEH</option>
               </select>
    
        </div>
		
		
		
		
<!--eta kaaj korche na// probably kono jquery initialization korte heb-->
 <!--eta cholbe <div class="input-field col s6">
                <i class="material-icons prefix"></i>
            <input placeholder="CSE/IT/CT/GS" id="stream" type="text" class="validate">
            <label for="stream">Stream</label>
        </div> -->



   <!--     <div class=" inline col s6" style="height: 85px;padding-top: 30px">
			Choose Stream:
			<label>
				<input name="group1" type="radio" value="IT" />
				<span style="padding-right: 40px;">IT     </span>
			</label>
			<label>
				<input name="group1" type="radio" value="CSE" />
				<span style="padding-right: 40px;">CSE   </span>
			</label>
   
			<label>
				<input name="group1" type="radio"  value="CT" />
				<span style="padding-right: 40px;">CT   </span>
			</label>
			<label>
				<input name="group1" type="radio" value="General Science"/>
				<span style="padding-right: 40px;">General Science    </span>
			</label>
		</div>

-->


</div>

      <div class="row">
        <div class="input-field col s10">
        <i class="material-icons prefix">house</i>
          <input placeholder="Enter full address " id="address" type="text" class="validate" value="';


			//Print the address here.......
			echo $result->{'address'};
			
		
			

		  echo'">
          <label for="address">Address</label>
        </div>
      </div>
       <div class="row">
        <div class="input-field col s6">
        <i class="material-icons prefix">alternate_email</i>
          <input id="email" type="email" class="validate" value="'; 
		  
		  
		  //Print the email here...
		  echo $result->{'email'};
		  
		  
		  
		  echo '">
          <label for="email">Email</label>
          <span class="helper-text" data-error="wrong format" data-success="Success"></span>
        </div>

        <div class="input-field col s6">
        <i class="material-icons prefix">local_phone</i>
        <input placeholder="Contact Number" id="phoneno" type="tel" class="validate"pattern="[0-9]{10}" value="'; 
		
		
		//Phone number here..............
		echo $result->{'contact no'};
		
		
		echo '">
        <label for="phoneno">Contact Number</label>
        <span class="helper-text" data-error="wrong format" data-success="Success"></span>
      </div>
    </form>
  </div>

        </div>
        <div class="card-action center">
          <a class="waves-effect waves-light red accent-3 center z-depth-4 btn" href="coe_view_teachers.php"><i class="material-icons right">refresh</i>Back</a>  
		 <!--<a onclick="editDetails()" class="waves-effect waves-light blue darken-4 center z-depth-4 btn "><i class="material-icons right">edit</i>Edit Details</a>-->
         <a onclick="saveDetails()" class="waves-effect waves-light teal darken-4 center z-depth-4 btn "><i class="material-icons right">save</i>Save & Continue</a>
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














 
</body>
</html>


';


}

?>