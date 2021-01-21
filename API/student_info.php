<?php
	require('library.php');
	require('receiver_header.php');



	if(!isset($_GET["key"])){
		$status = 'FAIL';
		$comment = 'undefined parameter: key';	
		$arr = array( 	'status' => $status,
						'comment' => $comment);
		echo json_encode($arr);
		exit();
	}
	else if(!isset($_GET["username"])){
		$status = 'FAIL';
		$comment = 'undefined parameter: username';
		$arr = array( 	'status' => $status,
						'comment' => $comment);
		echo json_encode($arr);
		exit();
	}
	else{
		$sender_key = $_GET['key'];
		$sender_username = $_GET['username'];
		if($sender_key != $key){
			$status = 'FAIL';
			$comment = 'incorrect key: ';
			$arr = array( 	'status' => $status,
							'comment' => $comment.$sender_key);
			echo json_encode($arr);
			exit();
		}
		try{
			Query::init();
			$q1 = new Query("SELECT * FROM student WHERE username = ? AND isActive = '1'","s");
			$q1->execute([$sender_username]);
			$student = $q1->data();

			if(!$student){
				$status = 'FAIL';
				$comment = 'incorrect username: ';
				$arr = array( 	'status' => $status,
								'comment' => $comment.$sender_username);
				echo json_encode($arr);
				exit();
			}
			else{
				$db_username = $student[0]['username'];
				$db_name = $student[0]['name'];
				$db_joiningYear = $student[0]['joiningYear'];
				$db_passOutYear = $student[0]['passOutYear'];
				$db_registration = $student[0]['registration'];
				$db_email = $student[0]['email'];
				$db_contactNo = $student[0]['contactNo'];
				$db_departmentCode = $student[0]['departmentCode'];
				$arr = array(	'username' => $db_username,
								'name' => $db_name,
								'department' => $db_departmentCode,
								'joining year' => $db_joiningYear,
								'pass out year' => $db_passOutYear,
								'registration no' => $db_registration,
								'email' => $db_email,
								'contact no' => $db_contactNo
							);
							
				echo json_encode($arr);
				
			}
		}
		catch(Exception $e){
			report($e);
			$status = 'FAIL';
			$comment = 'server error occurred';
			$arr = array( 	'status' => $status,
							'comment' => $comment);
			echo json_encode($arr);
			exit();
		}
		finally{
			Query::destroy();
		}
	}
	
	
	
?>