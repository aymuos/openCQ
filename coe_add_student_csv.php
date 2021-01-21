<?php

require('sender_header.php');
//This displays the running exams..........
//Proceed to the else part directly.......



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
			<p class="text-center">Please <a href="coe-login.html">Login</a> first</p>
		</div>
	</div>
</body>
</html>
';
}
else {
	
	echo '

<html>
	<head>
	<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
		<title>COE Dashboard</title>
		
		
		
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- BOOTSTRAP AND MATERIALIZE LIBRARIES-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
    	<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    	<!-- Compiled and minified JavaScript -->
		<!-- end of bootstrap materialize libraries//  create provision for user css-->       
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
		
		
	
		
		<!--user css-->
        <link rel="stylesheet" type="text/css" href="css/temp.css">
		
		
		
		
		
		
<script>
(function ($) {
    $(function () {

        //initialize all modals           
        $(\'.modal\').modal();



        //or by click on trigger
        $(\'.trigger-modal\').modal();

    }); // end of document ready
})(jQuery); // end of jQuery name space
	$(document).ready(function(){
    $(\'select\').formSelect();
  });


	function addition(){
		M.toast({html: "Please Wait! :)", classes: \'rounded\'});
		var roll = $("#roll").val();
		var regExRoll = new RegExp("GCECT[B/M]-[R/L][0-9][0-9]-[1/2/3][0-9][0-9][0-9]");
		if(!regExRoll.test(roll) || roll.length != 15){
			M.toast({html: "Invalid Roll No! :(", classes: \'rounded\'});
			console.log("over");
			return;
		}
		var year = $("#year").val();
		regExRoll = new RegExp("20[0-9][0-9]");
		if(!regExRoll.test(year) || year.length != 4){
			M.toast({html: "Invalid Registration Year! :(", classes: \'rounded\'});
			console.log("over");
			return;
		}
		var stream = $("#stream").val();
		var name = $("#name").val();
		var pass = $("#psw").val();
		console.log(stream);
		console.log(name);
		$.post("coe_add_student_send.php",
			{
				sroll: roll,
				sname: name,
				sstream: stream,
				syear: year,
				spassword: pass
			},
			function(data, status){
				console.log(data);
				var res = JSON.parse(data);
				if(res.status == "OK"){
					M.toast({html: "Student added successfully! :)", classes: \'rounded\'});
					$("#roll").val("");
					$("#year").val("");
					$("#psw").val("");
					$("#name").val("");
					
				}
				else{
					M.toast({html: res.comment+"! :(", classes: \'rounded\'});
				}
		});
	}
	
	
	
	
	
	

	
</script>
	</head>
	<body>
		<div class="heading">
			<div class="left-logo">
				<img src="img/logo256.png" class="ing">
			</div>
			<label class="writing">Controller of Examination</label>
			<div class="right-logo">
				<a class="ing2" href="logout.php"><i class="material-icons left">input</i>Logout</a>
			</div>
		</div>
	
	
    <div class="container z-depth-5 white" style="background-color: #e6e6e6;width: 90%">
		<div class="row" style="padding-top: 30px">
			<div class="col s12">
				<span  style="font-size: 32px;color: orange"><b>Status</b><span>
			</div>
		</div>
';
	
	$file_name = $_FILES['csvFile']['name'];
	$file_ext = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
	
	if($file_ext !="csv"){
		echo '<span style="font-size: 32px"><b>Invalid file type: </b>'.$file_ext.' </span>
			<div class="container" style="padding-bottom: 60px">
				<a class="btn red" href="coe_add_student.php">Back</a>
			</div>
		';
		exit();
	}
	
	$file = fopen($_FILES['csvFile']['tmp_name'],"r");
	$heading = fgetcsv($file);
	if($heading[0] !="email"){
		echo '<span style="font-size: 24px"><b>Invalid first column: </b>'.$heading[0].'<br><b>It should be: </b>email </span>
			<div class="container" style="padding-bottom: 60px">
				<a class="btn red" href="coe_add_student.php">Back</a>
			</div>
		';
		exit();
	}
	if($heading[1] !="name"){
		echo '<span style="font-size: 24px"><b>Invalid first column: </b>'.$heading[1].'<br><b>It should be: </b>name </span>
			<div class="container" style="padding-bottom: 60px">
				<a class="btn red" href="coe_add_student.php">Back</a>
			</div>
		';
		exit();
	}
	if($heading[2] !="roll"){
		echo '<span style="font-size: 24px"><b>Invalid first column: </b>'.$heading[2].'<br><b>It should be: </b>roll </span>
			<div class="container" style="padding-bottom: 60px">
				<a class="btn red" href="coe_add_student.php">Back</a>
			</div>
		';
		exit();
	}
	if($heading[3] !="stream"){
		echo '<span style="font-size: 24px"><b>Invalid first column: </b>'.$heading[3].'<br><b>It should be: </b>stream </span>
			<div class="container" style="padding-bottom: 60px">
				<a class="btn red" href="coe_add_student.php">Back</a>
			</div>
		';
		exit();
	}
	if($heading[4] !="pass out year"){
		echo '<span style="font-size: 24px"><b>Invalid first column: </b>'.$heading[4].'<br><b>It should be: </b>pass out year </span>
			<div class="container" style="padding-bottom: 60px">
				<a class="btn red" href="coe_add_student.php">Back</a>
			</div>
		';
		exit();
	}
	
	
	$data = array();
	//var_dump($data);
	
	
	
	while(! feof($file))
	{
		$line = fgetcsv($file);
		if($line[0]==null)continue;
		$arr = array(	"email" => $line[0],
						"name" => $line[1],
						"roll" => $line[2],
						"stream" => $line[3],
						"passOutYear" => $line[4]
					);
		
		array_push($data,$arr);
	}
	fclose($file);

	
	$url=location."add_student_group.php";
	$result = send_post_request($url,json_encode(array("key"=>key,"username" => $_SESSION['usernamecoe'],"password"=> $_SESSION['passwordcoe'],"data" => $data)),1);
	
	//echo $result;
	$ans = json_decode($result);
	
	if($ans->{'status'} == "OK"){
	echo '
	
	<div class="row">
		<div class="col s3">
			<span style="font-size: 20px"><strong>Total no of rows: </strong> &emsp;'.$ans->{'result'}->{'total rows'}.'</span>
		</div>
		<div class="col s1">
		</div>
		<div class="col s3">
			<span style="font-size: 20px"><strong>Successfull entries: </strong> &emsp;'.$ans->{'result'}->{'successfull rows'}.'</span>
		</div>
		<div class="col s1">
		</div>
		<div class="col s3">
			<span style="font-size: 20px"><strong>Failed entries: </strong> &emsp;'.$ans->{'result'}->{'failed rows'}.'</span>
		</div>
	</div>';
	
	
		if($ans->{'result'}->{'failed rows'} != 0){
			
		echo '
		<div class="row">
			<div class="col s3">
				<span style="font-size: 20px"><strong>Error Logs: </strong> &emsp;</span>
			</div>
		</div>
		';
			for($i=0;$i<$ans->{'result'}->{'failed rows'};$i++){
				
				echo '
					<div class="row">
						<div class="col s3">
							<span style="font-size: 15px"><strong>Error at row : </strong> &emsp;'.($ans->{'result'}->{'error log'}[$i]->{'line'} + 2).'</span>
						</div>
						<div class="col s8" style="text-align: left">
							<span style="font-size: 15px"><strong>Message : </strong> &emsp;'.$ans->{'result'}->{'error log'}[$i]->{'reason'}.'</span>
						</div>
					</div>';
			}
			
			
			
		}
		else{
			echo '<span style="font-size: 24px">'.$ans->{'comment'}.'</span>
		';
			
			
		}
	
	
	echo '
				<div class="row" style="padding-bottom: 100px">
					<div class="col s12">
						<a class="btn red" href="coe_add_student.php">Back</a>
					</div>
				</div>
		';
	
	
	
	
	
	
	
	
	
	}
	
	
	
	

}


?>