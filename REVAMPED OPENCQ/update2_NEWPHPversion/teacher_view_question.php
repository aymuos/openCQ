<?php

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
      <title>Question Dashboard</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="css/tdbhome.css">
    </head>

    <body>

    <!-- navbar code-->
    
  <nav>
    <div class="nav-wrapper gradient1">
        <a class="navbar-brand gibpadding " href="#">
            <img class="gibpadding2" src="img/logo256.png" height="60" alt="GCECT">
        </a>
      <a class="brand-logo" href="tdbhomeV2.php"><h5>   Teacher Userspace - Questions </h5></a>
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
      </div>
    </div>
  </nav>
            


            <div class="row">
    <div class="col s10 offset-s1">
      <div class="card leeftpad white z-depth-4">
        <span class="black-text">
        <div class="row">
        <div class="col s8">
        <p class= "leftpad" ><b> Teacher Name: </b><?php echo $username ?></p> <!--JS bring username from api-->
        </div>
        
        <div class="col s4">
         <p class= "leftpad"><b> Selected Subject: </b><?php echo "$code ($subname)"?></p>
        </div>
		

        </div>
        
       
        </span>
      </div>
    </div>
  </div>


<!--stuff ends-->


    
	
	
	
<?php

	require('sender_header.php');
	$username=$_SESSION['usernameteacher']; 
	$password=$_SESSION['passwordteacher']; 
	$api="questions.php";
	if(isset($_SESSION['chapterId'])){
		$cid = $_SESSION['chapterId'];
	}
	else{
		$cid = '1';
	}
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"category" => '1',
					"questionId" => 'ALL',
					"chapterId" => $cid,
					"code" => $_SESSION['code'],
				);
	
	$result = send_post_request(location.$api,$data);

	$ans = json_decode($result);
	if($ans->{'status'} == "FAIL"){
		echo '<div class="white" style="font-size: 32px;text-align: center">Error Occurred! :(</div>';
	}
	else{
		
		echo '
<div class="row">
    <div class="col s10 offset-s1">
    <div>
    <div class="black-text">
    <div class="col s8">
        
        <h5><p class="thick"> Total Number of added Questions : '.count($ans->{'result'}).'</p></h5> </div>
        <div class="col s4">
            <a class="waves-effect waves-light btn btn-large green darken-3" href="taddnewquestions.php"><i class="material-icons left">add_box</i>ADD NEW QUESTIONS</a>
        </div>
        
    </div>
    </div>
</div>





  <div class="row">
    <div class="col s10 offset-s1">
      <div class="card blue darken-1 z-depth-3">
        <div class="card-content black-text">
          <span class="card-title">Saved Questions (Click to expand)</span>
          <ul class="collapsible">';
		
		
		
		
		for($i=0;$i<count($ans->{'result'});$i++){
			echo '
	<li>
		<div class="collapsible-header">
			<div class="row" style="width: 100%;padding-top: 20px;">
				<div class="col s0">
					<i class="material-icons">adjust</i>
				</div>
				<div class="col s7">
					Question : '.($i+1).'
				</div>
				<div class="col s3">
					Chapter : '.($ans->result[$i]->chapterName).'
				</div>
			</div>
		</div>
		<div class="collapsible-body white">
			<div class="row">
				<div class="col s10">
				</div>
				<div class="col"><a class="btn red btn-waves-effect" onclick="remove('.($ans->result[$i]->id).')">Remove</a>
				</div>
			</div>
			<!--Question body whole -->
			<div><blockquote>'.htmlspecialchars_decode($ans->result[$i]->problemStatement).'</blockquote></div>
			<div class="total">
				<div class="custom-left">a) </div>
				<div class="custom-right">'.htmlspecialchars_decode($ans->result[$i]->correctOption).'</div>
			</div> 
			<div class="total">
				<div class="custom-left">b) </div>
				<div class="custom-right">'.htmlspecialchars_decode($ans->result[$i]->incorrectOption1).'</div>
			</div>
			<div class="total">
				<div class="custom-left">c) </div>
				<div class="custom-right">'.htmlspecialchars_decode($ans->result[$i]->incorrectOption2).'</div>
			</div>
			<div class="total">
				<div class="custom-left">d) </div>
				<div class="custom-right">'.htmlspecialchars_decode($ans->result[$i]->incorrectOption3).'</div>
			</div>
        </div>
    </li>';
		
		
		}
	}

?>
</div>
</div>

<div class="container" style="text-align: center;margin-top: 100px;">
	<button class="btn red" onclick="window.location.href = 'tselectchapter.php'">Back</button>
</div>





		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/tdb2.js"></script>
	  <script>
		function remove(id){
			$.get('teacher_delete_question.php?id='+id,function (data, textStatus){		// success callback
					console.log(data);
					var res = JSON.parse(data);
					//M.toast({html: res.comment+"! :(",classes: 'rounded'});
					if(res.status == "OK"){
						M.toast({html: "Question is deleted! :)",classes: 'rounded'});
						setTimeout(myFunc, 2000);
					}
					else{
						M.toast({html: res.comment+"! :(",classes: 'rounded'});
					}
				});
		}
		function myFunc(){
			location.reload();
		}

	  </script>
    </body>
  </html>






