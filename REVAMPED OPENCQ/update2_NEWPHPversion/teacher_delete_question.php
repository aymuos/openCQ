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
	$username=$_SESSION['usernameteacher']; 
	$password=$_SESSION['passwordteacher']; 
	$api="delete_question.php";
	if(isset($_SESSION['chapterId'])){
		$cid = $_SESSION['chapterId'];
	}
	else{
		$cid = '1';
	}
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"chapterId" => $cid,
					"questionId" => $_GET['id'],
					"code" => $_SESSION['code']
				);
	
	$result = send_post_request(location.$api,$data);

	$ans = json_decode($result);


	echo $result;
	
}

?>