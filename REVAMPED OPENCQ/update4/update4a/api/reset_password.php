<?php
	require('library.php');
	require('receiver_header.php');



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
	else if(!isset($_POST["new_password"])){
		$status = 'FAIL';
		$comment = 'undefined parameter: new_password';
		$arr = array( 	'status' => $status,
						'comment' => $comment);
		echo json_encode($arr);
		exit();
	}
	else if(!isset($_POST["old_password"])){
		$status = 'FAIL';
		$comment = 'undefined parameter: old_password';
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
		$sender_new_password = $_POST['new_password'];
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
			$query = "SELECT * FROM ".$profile." WHERE username = ?
			 AND password=?  AND isActive = '1'";
			$q1 = new Query($query,"ss");
			$q1->execute([$sender_username,$_POST['old_password']]);
			$student = $q1->data();
			

			if(!$student){
				$status = 'FAIL';
				$comment = 'incorrect username/password: ';
				$arr = array( 	'status' => $status,
								'comment' => $comment.$sender_username);
				echo json_encode($arr);
				exit();
			}
			else{
				$query = "UPDATE ".$profile." SET password = ? WHERE username = ? AND isActive = '1'";
				$q1 = new Query($query,"ss");
				$q1->execute([$sender_new_password,$sender_username]);
				
				
				$status = 'OK';
				$comment = 'password updated successfully';
				$arr = array( 	'status' => $status,
								'comment' => $comment
								);
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
			exit();
		}
		finally{
			Query::destroy();
		}
	}
	
?>