<?php
	require('library.php');
	require('receiver_header.php');	
	$valid = checkSet(['key','username','password','subject_code','paper_name'],1);
	if($valid[0]==0){
		$arr = array(	'status' => 'FAIL',
						'comment' => $valid[1]
					);
		echo json_encode($arr);
		exit();
	}
	$sender_key = $_POST['key'];
	$sender_username = $_POST["username"];
	$sender_password = $_POST["password"];
	$sender_code = $_POST['subject_code'];
	$sender_name = $_POST['paper_name'];
	if($sender_key != $key){
		$arr = array(	'status' => 'FAIL',
						'comment' => 'incorrect key: '.$sender_key
					);
		echo json_encode($arr);
		exit();
	}
	try{
		Query::init();
		$query = "SELECT * FROM coe WHERE username = ? AND isActive = '1'";
		$q1=new Query($query,"s");
		$q1->execute([$sender_username]);
		$result = $q1->data();
		if(!$result){
			$arr = array(	'status' => 'FAIL',
							'comment' => 'incorrect username: '.$sender_username
					);
			echo json_encode($arr);
		}
		else if($result[0]['password'] != $sender_password){
			$arr = array(	'status' => 'FAIL',
							'comment' => 'incorrect password'
					);
			echo json_encode($arr);
		}
		else{	
			$query = "SELECT * from subject WHERE subjectCode = ? AND isActive = '1'";
			$q1 = new Query($query,"s");
			$q1->execute([$sender_code]);
			$result = $q1->data();
			if($result){
				$arr = array(	'status' => 'FAIL',
								'comment' => 'subject code: '.$sender_code.' already exists'
							);
				echo json_encode($arr);
			}
			else{
				$query = "INSERT INTO subject(subjectCode,paperName) VALUES(?,?)";
				$q1 = new Query($query,"ss");
				$q1->execute([$sender_code,$sender_name]);
				$arr = array(	'status' => 'OK',
								'comment' => 'subject code added successfully'
							);
				echo json_encode($arr);
			}
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
?>