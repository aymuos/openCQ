<?php
	require('sender_header.php');

	//This file checks the login credentials for COE
	session_start();
	// $username = "BB";
	// $password = "AtoZ";
	$username=$_SESSION['usernameteacher']; 
	$password=$_SESSION['passwordteacher']; 
	$api="create_exam.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"code" => $_SESSION['code'],
					"description" => $_GET['desc'],
					"batchPassoutYear" => $_GET['year'],
					"stream" => $_GET['stm']
				);
	
	$result = send_post_request(location.$api,$data);
	echo $result;
	
	
?>