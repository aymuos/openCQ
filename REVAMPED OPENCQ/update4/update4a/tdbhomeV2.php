<?php
require ('sender_header.php');
session_start();
if (!isset($_SESSION['loggedinteacher'])){
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
    <p class="text-center">Please <a href="teacher-login.html">Login</a> first</p>
    </div>
    </div>
    </body>
    </html>
    ';
    exit();
}
$username = isset($_SESSION['teachername'])?$_SESSION['teachername']:"X";
$code= isset($_SESSION['code'])?$_SESSION['code']:"X";
$subname = isset($_SESSION['paper'])?$_SESSION['paper']:"X";



if(time() - $_SESSION['lastActiveTeacher'] > timeOut){
	header("location: set.php");
	exit();
}
else{
	$_SESSION['lastActiveTeacher'] = time();
}








?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Teacher Dashboard</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="css/tdbhome.css">
    </head>

    <body class="gradient5">

    <!-- navbar code-->
    
  <nav>
    <div class="nav-wrapper gradient1">
        <a class="navbar-brand gibpadding " href="#">
            <img class="gibpadding2" src="img/logo256.png" height="60" alt="GCECT">
        </a>
      <a class="brand-logo" href=""><h5>  Teacher Dashboard </h5></a>
      <ul class="right hide-on-med-and-down">
        
        <li><a href="logout.php" class="waves-effect waves-light btn gradient2">LOGOUT<i class="material-icons right">arrow_forward_ios</i></a></li>
      </ul>
    </div>
  </nav>

    
  <nav class="heightadjustnav2 z-depth-5">
    <div class="nav-wrapper gradient3">
      <div class="col s12 leftpad">
        <a href="teacher-login.html" class="breadcrumb">Login</a>
        <a href="tdbselectsubjectv1.php" class="breadcrumb">Select Subject</a>
        <a href="tdbhomeV2.php" class="breadcrumb">Teacher Dashboard</a>
      </div>
    </div>
  </nav>
            
            <!-- body of materialize-->

    <!--Teacher details card-->
    
  <div class="row">
    <div class="col s10 offset-s1">
      <div class="card leftpad white z-depth-4">
        <span class="black-text">
        <div class="row">
        <div class="col s6">
        <p class= "thick" > Teacher Name: <?php echo $username ?></p>
        </div>
        
        <div class="col s6">
         <p class= "thick"> Selected Subject: <?php echo "$code ($subname)"?></p>
        </div>
        </div>
        
       
        </span>
      </div>
    </div>
  </div>
            




      <div class="row cardpad">
        <div class ="col s8 offset-s2 ">
            <div class="card black-text z-depth-5">
            
    <!--card-->
            <div class="card-content">
                <span class="card-title  black-text text-darken-4"></span>
                      <p><h4><blockquote>QUESTION BANK SECTION</blockquote></h4></p>
                      <h6 style="font-style: italic;"> Click button to add , modify or delete chapters or questions </h6>
                      <div class="gibpadding2">
                        <a href= "tselectchapter.php" class="btn-floating btn-large waves-effect waves-light purple right"><p class="thick">GO</p></a>
                      </div>
                        
                      </div>
            </div>
            
        </div>
      </div>

      <!-- Reveal section ends-->


<!--card 2-->
      <div class="row cardpad">
        <div class ="col s8 offset-s2 ">
            <div class="card small black-text z-depth-5">
            
    
            <div class="card-content">
                <span class="card-title activator black-text text-darken-4">Click to access more 
                    <i class="material-icons right">menu_open</i></span>
                      <p><h4><blockquote>EXAMINATION SECTION</blockquote></h4></p>
                       <h6 style="font-style: italic;"> Expand to view detailed information about uploaded examination papers, exams running , previous examination papers or results of previous examinations </h6>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">CHOOSE AN OPTION<i class="material-icons right">close</i></span>

                  <!-- INSIDE REVEAL -->

                  <ul class="collection">
    <li class="collection-item avatar">
       <i class="material-icons circle light-green accent-3 black-text">dashboard</i>
      <span class="title"><p class="thick">Test Dashboard</p></span>
      <p>View detailed dashboard about setting up an examination <br>
      </p>
      <button class="btn waves-effect waves-light right secondary-content light-green accent-3 black-text" onclick="location.href='teacher_test_dashboard.php'" type="submit" name="action">GO 
    <i class="material-icons right">send</i>
  </button>
      <!--<a href="#!" class="secondary-content"><i class="material-icons">grade</i></a> -->
    </li>
    <!-- <li class="collection-item avatar">
      <i class="material-icons circle amber lighten-1 black-text">remove_red_eye</i>
     <span class="title"><p class="thick">View Result</p></span>
      <p>View Results of previously run examinations <br>
      </p>
      <button class="btn waves-effect waves-light right secondary-content amber lighten-1 black-text" href="tdbaddquestion.html" type="submit" name="action">GO 
    <i class="material-icons right">send</i>
  </button>
    </li> -->
    <li class="collection-item avatar">
      <i class="material-icons circle grey darken-4">insert_chart</i>
      <span class="title"><p class="thick">Past Examinations </p></span>
      <p>View Details about previously run examination and view question papers<br>
      </p>
      <button class="btn waves-effect waves-light right secondary-content grey darken-4 white-text" onclick="location.href='teacher_view_past_exam.php'" type="submit" name="action">GO 
    <i class="material-icons right">send</i>
  </button>
    </li>
    <!--
    <li class="collection-item avatar">
      <i class="material-icons circle red">play_arrow</i>
      <span class="title"><p class="thick">Modify a question</p></span>
      <p>Use this to modify previously added questions to an included chapter<br>
      </p>
      <button class="btn waves-effect waves-light right secondary-content teal darken-3 white-text" href="tdbaddquestion.html" type="submit" name="action">GO 
    <i class="material-icons right">send</i>
  </button>
    </li>

    <li class="collection-item avatar">
      <i class="material-icons circle red">play_arrow</i>
      <span class="title"><p class="thick">Delete a question</p></span>
      <p>Use this to delete previously added questions from an included chapter<br>
      </p>
      <button class="btn waves-effect waves-light right secondary-content teal darken-3 white-text" href="tdbaddquestion.html" type="submit" name="action">GO 
    <i class="material-icons right">send</i>
  </button>
    </li>
    -->
  </ul>


                    <p style="font-style: italic;">Refreshing the page will return you to the original section </p>
            </div>
        </div>
      </div>



      <!--card 3-->
      <div class="row cardpad">
        <div class ="col s8 offset-s2 ">
            <div class="card black-text z-depth-5">
              <div class="card-content">
                  <p><h5><blockquote>Password Change</blockquote></h5></p>
                  <P><h6 style="font-style: italic;"> Click the button to change your password</h6></p>
                   <a href="change-teacher-password.php" class="btn-floating btn-large waves-effect waves-light red right"><p class="thick">GO</p></a>
              </div>
            </div>
        </div>
      </div>

      <div class="row ">
    <div class="col s8 offset-s2 ">
    <div class="card white">
      <div class="card-content">
        <span class="black-text"> <p><h5><blockquote>Need to change subject ? Click the following button </p></h5></blockquote>
        </span>
         <a class="btn-floating btn-large waves-effect waves-light red right" href="tdbselectsubjectv1.php"><i class="material-icons">cached</i></a>
      </div>
      </div>
    </div>
  </div>    



      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>