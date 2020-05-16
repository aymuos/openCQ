<?php
require ('sender_header.php');
session_start();
if (!isset($_SESSION['loggedinteacher'])){
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
      <title>Select Chapters</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="css/tdbhome.css">
  <link rel="stylesheet" href="css/additional.css">
    </head>

    <body>

    <!-- navbar code-->
    
  <nav>
    <div class="nav-wrapper gradient1">
        <a class="navbar-brand gibpadding " href="#">
            <img class="gibpadding2" src="img/logo256.png" height="60" alt="GCECT">
        </a>
      <a class="brand-logo" href="#"><h5>   Teacher Userspace -Select Chapters </h5></a>
      <ul class="right hide-on-med-and-down">
        
        <li><a class="waves-effect waves-light btn gradient2">LOGOUT<i class="material-icons right">arrow_forward_ios</i></a></li>
      </ul>
    </div>
  </nav>

    
  <nav class="heightadjustnav2 z-depth-5">
    <div class="nav-wrapper gradient3">
      <div class="col s12 leftpad">
        <a href="teacher-login.html" class="breadcrumb">Login</a>
        <a href="tdbselectsubjectv1.php" class="breadcrumb">Select Subject</a>
        <a href="" class="breadcrumb">Teacher Dashboard</a>
        <a href="tselectchapter.php" class="breadcrumb">Select Chapter</a>
      </div>
    </div>
  </nav>
            

<!--MAIN CARD CONTENTS OPENS-->

 <div class="row">
    <div class="col s10 offset-s1">
      <div class="card leftpad white z-depth-4">
        <span class="black-text">
        <div class="row">
        <div class="col s6">
        <p class= "thick leftpad" > Teacher Name: <?php echo $username ?></p> <!--JS bring username from api-->
        </div>
        
        <div class="col s6">
         <p class= "thick leftpad"> Selected Subject: <?php echo "$code($subname)"?></p>
        </div>
        </div>
        
       
        </span>
      </div>
    </div>
  </div>

  <div ><h4 class= "center-align"> Choose a chapter from the following list </h4></div>
  

  <main>
      
  </main>          
  
   <!-- <div class="row">
    <div class="col s8 offset-s2 ">
      <div class="card subcardsize blue accent-4">
        <div class="card-content white-text">
        <div class="col s8"> -->
          <!-- <span class="card-title thick">Chapter 2 : Speed ,Velocity & Acceleration</span> -->
          
          <!-- <p> Subject : Physics -->
          
          <!-- </p> -->
          
            <!-- <textarea class="form-control modifyChapter" rows="7"> Speed ,Velocity & Acceleration</textarea>
          
        </div>
         
          <div class="col s1"> <span class="badge"><a class="waves-effect waves-light btn-small black white-text">55</a></span></div>

           <div class="col s1"><button class="btn-floating  btn-large waves-effect waves-light teal lighten-4 black-text" type="submit" name="action">GO
    <i class="material-icons right">arrow_forward</i>
  </button></div>

          <div class="col s1">
            <a class="btn-floating btn-large waves-effect waves-light  green darken-4"><i class="material-icons">edit</i></a>
          </div>
          <div class="col s1">
          <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">delete_forever</i></a>
          </div>
        </div>
      </div>
    </div>
  </div> -->




  
            

            <!-- subject card ends below code for floating fixed button-->
            <!-- <textarea class="form-control z-depth-1 addChapter" rows="3" placeholder="Write something here..."></textarea> -->
            <!-- <div class="fixed-action-btn">
              
                <a class="btn btn-large orange darken-1 black-text " href="#!">
                     <i class="material-icons">add</i>new
                </a>
            </div>             -->

<!--code for adding new chapters-->
<div class="row">
    <div class="col s10 offset-s1">
      <div class="card white darken-1">
        <div class="card-content black-text">
          <span class="card-title">Chapter Name not found? Add the chapter Instead</span>

              <div class="row">
    <form class="col s12">
      <div class="row">
                <div class="input-field col s8">
          <input placeholder="Type here..." id="new_chapter" type="text" class="validate">
          <label for="new_chapter">Type the new chapter name</label>
        </div>
        <div class="col s4"><button class="waves-effect waves-light lime btn" type="submit">ADD</button></div>

      </div>
    </form>
  </div>
          
          </div>
      </div>
    </div>
  </div>
<!--code ends-->














      



      <!--JavaScript at end of body for optimized loading-->

      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/tselectchapterApp.js"></script>
  
    </body>
  </html>