<?php
	require('sender_header.php');
	//This file checks the login credentials for COE
	session_start();
	$username=$_POST['username']; 
	$password=$_POST['password']; 
	$url="localhost/update1/api/login.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"category" => '0',
				);
	
	$result = send_post_request($url,$data);
	$ans = json_decode($result);
	if($ans->{'status'} == "OK"){
		$_SESSION['loggedincoe'] = true;
		$_SESSION['usernamecoe'] = $username;
		$_SESSION['passwordcoe'] = $password;
	}
	echo $result;
?>

