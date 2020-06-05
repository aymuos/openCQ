<?php
require('sender_header.php');
require('library.php');
session_start();
if ( isset($_SESSION['loggedinstudent']) == false ){
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
$data['username'] = $_SESSION['usernamestudent'];
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

    <!-- Compiled and minified JavaScript -->
    <script src="js/materialize.min.js"></script>
    <script type = "text/javascript"
         src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
 <script type = "text/javascript"
         src = "js/jquery.min.js"></script>

  <!-- <script type = "text/javascript"
         src = "js/script2.js"></script> -->
 

</head>
<body>

     
    <nav>
    <div class="row">
    <div class="nav-wrapper orange darken-3 col s12">
      <a href="#" class="brand-logo">  Configure Student Details </a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li>
            <a class="waves-effect waves-light black white-text btn" href="student_dashboard.php"><i class="material-icons left">dashboard</i>GO TO DASHBOARD</a></li>
             <a class="waves-effect waves-light black white-text btn" href="change-student-password.php"><i class="material-icons left">cached</i>CHANGE PASSWORD</a></li>
        
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
                  <input id="name" value="<?php echo $result->{'name'} ?>" type="text" >
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
            <input id="start_yr" value=<?php echo $result->{'pass out year'}-4 ?> type="number"  min="2016" max="2040" readonly>
            <label for="start_yr">Starting Year</label>
            
            
            </div>


            <div class="col s6">
            
            <input id="passout_yr" value=<?php echo $result->{'pass out year'}?> type="number"  min="2020" max="2044" readonly>
            <label for="passout_yr">Passout Year</label>
            
            </div>
          </div>
          
            

            
          </div>
        </div>
        <div class=" inline col s4" readonly>
    Department:
      <label>
        <input disabled name="group1" type="radio" 
        <?php echo ($result->{'department'}=="IT")?"checked":""  ?>/>
        <span>IT     </span>
      </label>
      <label>
        <input disabled  name="group1" type="radio" 
        <?php echo ($result->{'department'}=="CSE")?"checked":""  ?>/>
        <span>CSE   </span>
      </label>
   
      <label>
        <input  disabled name="group1" type="radio"  
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
          <input id="email" value= "<?php echo $result->{'email'}?>" type="email" class="validate">
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
         <!-- <a class="waves-effect waves-light red accent-3 center z-depth-4 btn"><i class="material-icons right">refresh</i>Refresh Entries</a>  -->

         <a onclick="updateStudent()" class="waves-effect waves-light teal darken-4 center z-depth-4 btn "><i class="material-icons right">save</i>Save & Continue</a>
        </div>
      </div>
    </div>
  </div>
</div> 
<script>
            const department = "<?php echo  $result->{'department'}; ?>";
         </script>
         <script src="js/updateStudent.js">

            </script> 
</body>
</html>
