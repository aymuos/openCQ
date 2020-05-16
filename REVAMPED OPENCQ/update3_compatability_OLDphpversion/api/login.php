<?php
	require('library.php');
	require('receiver_header.php');
	// $_POST['key']=key;
	// $_POST['username']="cyan";
	// $_POST['password']="root";
	// $_POST['category']="1";


	if(!isset($_POST["key"])){
		$status = 'FAIL';
		$comment = 'undefined parameter: key';	
		$arr = array( 	'status' => $status,
						'comment' => $comment);
		echo json_encode($arr);
		exit();
	}
	else if(!isset($_POST["username"])){
		$status = 'FAIL';
		$comment = 'undefined parameter: username';
		$arr = array( 	'status' => $status,
						'comment' => $comment);
		echo json_encode($arr);
		exit();
	}
	else if(!isset($_POST["password"])){
		$status = 'FAIL';
		$comment = 'undefined parameter: password';
		$arr = array( 	'status' => $status,
						'comment' => $comment);
		echo json_encode($arr);
		exit();
	}
	else if(!isset($_POST["category"])){
		$status = 'FAIL';
		$comment = 'undefined parameter: category';
		$arr = array( 	'status' => $status,
						'comment' => $comment);
		echo json_encode($arr);
		exit();
	}
	else{
		$sender_key = $_POST['key'];
		$sender_username = $_POST['username'];
		$sender_password = $_POST['password'];
		$sender_category = $_POST['category'];
		if($sender_key != $key){
			$status = 'FAIL';
			$comment = 'incorrect key: ';
			$arr = array( 	'status' => $status,
							'comment' => $comment.$sender_key);
			echo json_encode($arr);
			exit();
		}
		if($sender_category == 0){
			$profile ="coe";
		}
		else if($sender_category == 1){
			$profile = "teacher";
		}
		else if($sender_category == 2){
			$profile = "student";
		}
		else{
			$status = 'FAIL';
			$comment = 'incorrect category: ';
			$arr = array( 	'status' => $status,
							'comment' => $comment.$sender_category);
			echo json_encode($arr);
			exit();
		}
		
		
		
		try{
			Query::init();
			$q = new Query("SELECT * FROM ".$profile." WHERE username = ? AND isActive = '1'","s");
			$q->execute([$sender_username]);
			$student = $q->data();
			if(!$student){
				$status = 'FAIL';
				$comment = 'incorrect username: ';
				$arr = array( 	'status' => $status,
								'comment' => $comment.$sender_username);
				echo json_encode($arr);
				exit();
			}
			else if($student[0]['password'] != $sender_password){
				$status = 'FAIL';
				$comment = 'incorrect password';
				$arr = array( 	'status' => $status,
								'comment' => $comment);
				echo json_encode($arr);
				exit();
			}
			else{
				if($student[0]['isFirstLogin'] == '1'){
					$resp = 'yes';
					$q = new Query("UPDATE ".$profile." SET `isFirstLogin` = '0' WHERE username = ? AND isActive = '1'","s");
					$q->execute([$sender_username]);
				}
				else
					$resp = 'no';
				$status = 'OK';
				$comment = 'login successful';
				$arr = array( 	'status' => $status,
								'comment' => $comment,
								'is first login' => $resp);
				echo json_encode($arr);
				exit();
			}
		}
		catch(Exception $e){
			report($e);
			$status = 'FAIL';
			$comment = 'server error occurred';
			$arr = array( 	'status' => $status,
							'comment' => $comment);
			echo json_encode($arr);
		}
		finally{
			Query::destroy();
		}
	}
	
?>