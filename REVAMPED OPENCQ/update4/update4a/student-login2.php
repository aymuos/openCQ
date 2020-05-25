<?php
	require('sender_header.php');
	//This file checks the login credentials for COE
	session_start();
	$username=$_POST['username']; 
	$password=$_POST['password']; 
	$api_name="login.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"category" => '2',
				);
	
	$result = send_post_request($url.$api_name,$data);
	$ans = json_decode($result);
	if($ans->{'status'} == "OK"){
		$_SESSION['loggedinstudent'] = true;
		$_SESSION['usernamestudent'] = $username;
		$_SESSION['passwordstudent'] = $password;
	}
	echo $result;
?>

