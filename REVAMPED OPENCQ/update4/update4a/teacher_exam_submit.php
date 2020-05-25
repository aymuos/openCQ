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
else{
	require('sender_header.php');
	
	
	if(time() - $_SESSION['lastActiveTeacher'] > timeOut){
		echo json_encode( array("status" => "FAIL",
								"comment" => "session expired"));
		exit();
	}
	else{
		$_SESSION['lastActiveTeacher'] = time();
	}	

	
	
	
	
	
	$username=$_SESSION['usernameteacher']; 
	$password=$_SESSION['passwordteacher']; 
	$api="teacher_submit_exam.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"examId" => $_SESSION['examId'],
					"code" => $_SESSION['code']
				);
	
	$result = send_post_request(location.$api,$data);

	$ans = json_decode($result);
	
	if($ans->status == "OK")unset($_SESSION['examId']);
	

	echo $result;
	
}

?>