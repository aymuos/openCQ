<?php
	require('sender_header.php');

	//This file checks the login credentials for COE
	session_start();
	// $username = "BB";
	// $password = "AtoZ";
	$username=$_POST['username']; 
	$password=$_POST['password']; 
	$api="login.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"category" => '1',
				);
	
	$result = send_post_request($url.$api,$data);

	$ans = json_decode($result);
	if($ans->{'status'} == "OK"){
		$_SESSION['loggedinteacher'] = true;
		$_SESSION['usernameteacher'] = $username;
		$_SESSION['passwordteacher'] = $password;
<<<<<<< HEAD
		$data2['key']=key;
		$data2['username']=$username;
		$url2 = location."teacher_info.php";
		$result2 = send_get_request($url2,$data2);
		$out2 = json_decode($result2);
		// var_dump($out2);


		$_SESSION['teachername']=$out2->name;
=======
		
		$api = "teacher_info.php";
		$data = array(	"key" => key,
						"username" => $username,
				);
	
		$result2 = send_get_request($url.$api,$data);
		//echo $result2;
		$ans2 = json_decode($result2);
		//echo $ans2->name;
		$_SESSION['name'] = $ans2->name;
		$_SESSION['code'] = 'CS502';
>>>>>>> 15af29ac9be395a8a33ca08e3554cea5942f6643
	}

	echo $result;
?>

