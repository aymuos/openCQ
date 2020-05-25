<?php
	require('sender_header.php');

	//This file checks the login credentials for COE
	session_start();
	// $username = "BB";
	// $password = "AtoZ";
	$username=$_POST['username']; 
	$password=$_POST['password']; 
	$url=location."login.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"category" => '1',
				);
	
	$result = send_post_request($url,$data);

	$ans = json_decode($result);
	if($ans->{'status'} == "OK"){
		$_SESSION['loggedinteacher'] = true;
		$_SESSION['usernameteacher'] = $username;
		$_SESSION['passwordteacher'] = $password;
		$data2['key']=key;
		$data2['username']=$username;
		$_SESSION['lastActiveTeacher'] = time();
		$url2 = location."teacher_info.php";
		$result2 = send_get_request($url2,$data2);
		$out2 = json_decode($result2);
		// var_dump($out2);


		$_SESSION['teachername']=$out2->name;
	}

	echo $result;
?>

