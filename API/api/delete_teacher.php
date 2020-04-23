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
			$query = "SELECT * FROM teacher WHERE username = ? AND isActive = '1'";
			$q1 = new Query($query,"s");
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
				$query = "UPDATE teacher SET isActive = '0' WHERE username = ? AND isActive = '1'";
				$q1 = new Query($query,"s");
				$q1->execute([$sender_username]);
				
				$arr = array( 	'status' => 'OK',
								'comment' => 'teacher deleted');
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