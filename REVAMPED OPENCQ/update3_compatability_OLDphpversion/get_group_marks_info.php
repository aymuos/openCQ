<?php
	session_start();
	require('sender_header.php');
	$api = "student_marks.php";
	$username = $_SESSION['usernameteacher']; 
	$password = $_SESSION['passwordteacher'];
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"examStatus" => '4',
					"examId" => $_SESSION['examId'],
					"code" => $_SESSION['code'],
					"batchPassoutYear" => 'ALL',
					"stream" => $_GET['stream'],
					"visible" => '1',
					"category" => '1'
				);
	
	$result = send_post_request(location.$api,$data);
	echo $result;

?>