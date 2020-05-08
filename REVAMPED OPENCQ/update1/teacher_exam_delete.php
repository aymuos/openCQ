<?php
	require('sender_header.php');

	//This file checks the login credentials for COE
	session_start();
	// $username = "BB";
	// $password = "AtoZ";
	$username=$_SESSION['usernameteacher']; 
	$password=$_SESSION['passwordteacher']; 
	$api="delete_exam.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"examId" => $_GET['e'],
					"code" => $_SESSION['code']
				);
	
	$result = send_post_request($url.$api,$data);
	echo $result;
	
	
?>