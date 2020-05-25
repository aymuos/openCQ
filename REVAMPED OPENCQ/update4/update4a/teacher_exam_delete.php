<?php
	require('sender_header.php');

	//This file checks the login credentials for COE
	session_start();
	// $username = "BB";
	// $password = "AtoZ";
	
	
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
	$api=location."delete_exam.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"examId" => $_GET['e'],
					"code" => $_SESSION['code']
				);
	
	$result = send_post_request($api,$data);
	echo $result;
	
	
?>