<?php
require('sender_header.php');
session_start();
if (!isset($_SESSION['loggedinteacher'])){
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
    exit();
}




if(time() - $_SESSION['lastActiveTeacher'] > timeOut){
	echo (time() - $_SESSION['lastActiveTeacher']);
	header("location: set.php");
	exit();
}
else{
	$_SESSION['lastActiveTeacher'] = time();
}







$username = isset($_SESSION['teachername'])?$_SESSION['teachername']:"X";
$code= isset($_SESSION['code'])?$_SESSION['code']:"X";
$subname = isset($_SESSION['paper'])?$_SESSION['paper']:"X";
$chapname = isset($_SESSION['chapterName'])?$_SESSION['chapterName']:"X";
$qid = $_GET['id'];
$user = $_SESSION['usernameteacher'];
$password = $_SESSION['passwordteacher'];
$api = location."questions.php";
if(isset($_SESSION['chapterId'])){
    $cid = $_SESSION['chapterId'];
}
else{
    $cid = '1';
}
$data = array(	
"key" => key,
"username" => $user,
"password" => $password,
"category" => '1',
"questionId" => $qid,
"chapterId" => $cid,
"code" => $_SESSION['code'],
);
$result = send_post_request($api,$data);
$ans = json_decode($result);
if($ans->{'status'} == "FAIL"){
    exit('<div class="white" style="font-size: 32px;text-align: center">Error Occurred! :(</div>');
}
?>

<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Teacher Dashboard</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="css/tdbhome.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
			
	
	

	
	
	</head>

    <body>

    <!-- navbar code-->
<header>
  <nav>
    <div class="nav-wrapper gradient1">
        <a class="navbar-brand gibpadding " href="#">
            <img class="gibpadding2" src="img/logo256.png" height="60" alt="GCECT">
        </a>
      <a class="brand-logo" href="tdbhomeV2.php"><h5>   Teacher Dashboard New Question </h5></a>
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
        <a href="tselectchapter.php" class="breadcrumb">Select Chapter</a>
        <a href="teacher_view_question.php" class="breadcrumb">View Questions</a>
        <a href="taddnewquestions.php" class="breadcrumb">Add New Question</a>
      </div>
    </div>
  </nav>

  <div class="row">
    <div class="col s10 offset-s1" id="teachernamecard">
      <div class="card leeftpad white z-depth-4">
        <span class="black-text">
        <div class="row">
        <div class="col s5">
        <p class= "thick leftpad" > Teacher Name: <?php echo $username ?></p> <!--JS bring username from api-->
        </div>
        <div class="col s5">
        <p class= "thick leftpad" > Chapter Name: <?php echo $chapname ?></p> <!--JS bring username from api-->
        </div>
        
        <div class="col s5">
         <p class= "thick leftpad"> Selected Subject: <?php echo "$code ($subname)"?></p>
        </div>
        <div class="col s1">  <a href="#!" class="btn btn-small btn-flat white green-text waves-effect waves-purple" onclick="hideFunction()">Hide</a>
        </div>
        </div>
        
       
        </span>
      </div>
    </div>
  </div>
</header>


<!--code for sidenav-->

<!-- LEFT SIDEBAR	 -->
<!--
<ul id="slide-out" class="sidenav  sidenav-fixed">
    <li><div class="user-view">
      <div class="background">
        <img src="https://png.pngtree.com/thumb_back/fh260/back_pic/00/14/65/3256657136926fa.jpg">
      </div>
      <a href="#user"><img class="circle" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1"></a>
      <a href="#name"><span class="white-text name">John Doe</span></a>
      <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
  </ul>
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

    -->



<!--MIDDLE SECTION paper details-->

<div class="row">
    <div class="col s10 offset-s1">
      <div class="card white darken-1 z-depth-0">
        <div class=" card-content black-text">

        <div class="col s4">
          <i class="material-icons left">play_arrow</i>
          <p class="thick">PAPER CODE : <?php echo $code?></p>
        </div>
        <div class="col s8">
        <i class="material-icons left">play_arrow</i>
          <p class="thick">PAPER NAME : <?php echo $subname?></p>
        </div>
      </div>
    </div>
  </div>


<!-- MAIN SECTION-->

<div class="row">
    <div class="col s10 offset-s1">
      <div class="card blue-grey darken-3">
        <div class="card-content white-text">
          <div class="col s12"> <br></div>

  <div class="row">
    <div class="col s10"><span class="card-title"><h5>Enter Question Details</h5></div>
      <div class="col s2"><span class="flow-text"><a class="btn red modal-trigger" onclick="opening()">PREVIEW</a></span></div>
    </div>


          
          
            <ul class="collapsible">
              <li>
                <div class="collapsible-header white-text black"><i class="material-icons">info</i><h5>For a quick glance at the editor features click here</h5></div>
                <div class="collapsible-body"> 
                
                <p> * Upload image (if any) via the add (+) icon inside the editor. </p>
                <p>* Press (Ctrl + shift +F) to Go
          into Expanded View .Press the same again once you've finished typing to return to normal view.</p>
          <p>* Copy and Paste from Microsoft Word is supported .</p>
          <p>* Use Ctrl + F to search and replace words from the text editor</p>
          <span>
          </span></div>
              </li>
            </ul>
          </span>
          <span class="card-content">
          <form method="post" action="modifyQuestion.php" enctype="multipart/form-data"> <!--no idea about send question.php-->
            <div class="row">
                  <div class="col s12">
                  <div class="card-panel grey darken-4">
	            <h5>Question Statement:</h5>
	            <textarea id="editableDiv" name="statement" placeholder="Enter a statement">
		          
	            </textarea>
	        <br><br>
          </div>
                  </div>
              </div>
	
              <div class="row">
                  <div class="col s12">
                  <div class="card-panel grey darken-4">
	            <h5 class="left-align">Enter the correct answer:</h5>
	            <textarea id="option1" name="ac" class="center-align z-depth-5">
		                
	            </textarea>
	            <br><br>
               </div>
                  </div>
              </div>
	
              <div class="row">
                  <div class="col s12">
                  <div class="card-panel grey darken-4">
	            <h5>Incorrect Answer 1:</h5>
	            <textarea id="option2" name="wa1">
		            
	            </textarea>
	            <br><br>
               </div>
                  </div>
              </div>
	
                <div class="row">
                  <div class="col s12">
                  <div class="card-panel grey darken-4">
	            <h5>Incorrect Answer 2:</h5>
	              <textarea id="option3" name="wa2">

	              </textarea>
	              <br><br>
                 </div>
                  </div>
              </div>
	
          
	            
              <div class="row">
                  <div class="col s12">
                  <div class="card-panel grey darken-4">
                  <h5>Incorrect Answer 3:</h5>
	                  <textarea id="option4" name="wa3" placeholder="Describe yourself here...">
                    
	                  </textarea>
	                <br><br>
                  </div>
                  </div>
              </div>
              <div class="row" style="display:none">
                  <div class="col s12">
                  <div class="card-panel grey darken-4">
                  <h5>Incorrect Answer 3:</h5>
	                  <textarea id="qid" name="qid">
                        <?php echo $qid; ?>
	                  </textarea>
	                <br><br>
                  </div>
                  </div>
              </div>
  
  </span>



        </div>
        <div class="card-action center">
            <a class="btn waves-effect waves-light red center-align" onclick="window.history.back()">Back
    <i class="material-icons right">settings_backup_restore</i></a>
		
     <button class="btn waves-effect waves-light pink accent-3 center" type="submit" name="action" href="#modal1" >SAVE QUESTION
    <i class="material-icons right">save</i>
  </button>
        </div>
      </div>
    </div>
  </div>

</form>


  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Preview Question</h4>
	  <b>Question:</b><br>
	  <div id="modal-question"></div>
	  <b>Options:</b><br>
	  <div class="total"><div class="custom-left">a) </div><div class="custom-right" id="modal-option1"></div></div>
	  <div class="total"><div class="custom-left">b) </div><div class="custom-right" id="modal-option2"></div></div>
	  <div class="total"><div class="custom-left">c) </div><div class="custom-right" id="modal-option3"></div></div>
	  <div class="total"><div class="custom-left">d) </div><div class="custom-right" id="modal-option4"></div></div>
	  
    </div>
    <div class="modal-footer" >
		<div>The order of the option will vary during the exam</div>
      <a href="#!" class="modal-close waves-effect waves-green btn">Close</a>
    </div>
  </div>




      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/experimentj.js"></script>
      <script type="text/javascript" src="js/tdb2.js"></script>
      <script type="text/javascript" src="js/experimentj.js"></script>
      <script src="textboxio/textboxio/textboxio.js">var editor = textboxio.replace('#mytextarea');</script>
      <script type="text/javascript">
  var config = {
	codeview: {
		enabled : false 
	},
    images : {
        editing : {
				preferredWidth : 900
			}
		}
	};
    var divEditorProblem = textboxio.replace('#editableDiv',config);
	var option1 = textboxio.replace('#option1',config);
	var option2 = textboxio.replace('#option2',config);
	var option3 = textboxio.replace('#option3',config);
    var option4 = textboxio.replace('#option4',config);
    const cat = {};
    cat.statement =`<?php echo htmlspecialchars_decode($ans->result[0]->problemStatement) ?>`;  
	divEditorProblem.content.set(`<?php echo htmlspecialchars_decode($ans->result[0]->problemStatement) ?>`);
	option1.content.set(`<?php echo htmlspecialchars_decode($ans->result[0]->correctOption) ?>`);
	option2.content.set(`<?php echo htmlspecialchars_decode($ans->result[0]->incorrectOption1) ?>`);
	option3.content.set(`<?php echo htmlspecialchars_decode($ans->result[0]->incorrectOption2) ?>`);
	option4.content.set(`<?php echo htmlspecialchars_decode($ans->result[0]->incorrectOption3) ?>`);
	

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


function opening(){
	$('#modal-question').html("<blockquote>"+divEditorProblem.content.get()+"<blockquote>");
	$('#modal-option1').html(option1.content.get());
	$('#modal-option2').html(option2.content.get());
	$('#modal-option3').html(option3.content.get());
	$('#modal-option4').html(option4.content.get());
	$('#modal1').modal('open');
}



</script>
    </body>
  </html>
  
  
  
  
  
  
  