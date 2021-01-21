<?php

session_start();



if (!isset($_SESSION['loggedinteacher'])){
	$res = array( 	"status" => "FAIL",
					"comment" => "please login first"
				);
    echo json_encode($res);
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
	
	if(!isset($_GET['tot']) || !isset($_GET['dcm']) || !isset($_GET['dwm'])){
		echo json_encode( array("status" => "FAIL",
								"comment" => "invalid parameter set"));
		exit();
	}
	$len = $_GET['tot'];
	
	$data = array();
	for($i=0;$i<$len;$i++){
		if(!isset($_GET['id'.$i])){
			echo json_encode( array("status" => "FAIL",
									"comment" => "invalid parameter set"));
			exit();
		}
		if(!isset($_GET['crt'.$i])){
			echo json_encode( array("status" => "FAIL",
									"comment" => "invalid parameter set"));
			exit();
		}
		if(!isset($_GET['icrt'.$i])){
			echo json_encode( array("status" => "FAIL",
									"comment" => "invalid parameter set"));
			exit();
		}
		$arr = array($_GET["id".$i],$_GET["crt".$i],$_GET["icrt".$i]);
		array_push($data,$arr);
	}
	
//	var_dump ($data);
	
	
	$username=$_SESSION['usernameteacher']; 
	$password=$_SESSION['passwordteacher']; 
	$api="update_exam_marks.php";
	$data = array(	"key" => key,
					"username" => $username,
					"password" => $password,
					"examId" => $_SESSION['examId'],
					"code" => $_SESSION['code'],
					"defaultCorrect" => $_GET['dcm'],
					"defaultWrong" => $_GET['dwm'],
					"questions" => $data
				);
	
	$result = send_post_request(location.$api,json_encode($data),1);


	

	echo $result;
	
}

?>