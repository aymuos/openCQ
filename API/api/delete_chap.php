<?php
	require('library.php');
	require('receiver_header.php');
	
	
	
	$valid = checkSet(['key','username','password','sub_code','chapter_id'],1);
	if($valid[0]==0){
		$arr = array(	'status' => 'FAIL',
						'comment' => $valid[1]
					);
		echo json_encode($arr);
		exit();
	}
	$sender_key = $_POST['key'];
	$sender_username = $_POST['username'];
	$sender_code = $_POST['sub_code'];
	$sender_password = $_POST['password'];
	$sender_chapterId= $_POST['chapter_id'];
	// $sender_newChapterName = $_POST["new_chapter_name"];
						
	if($sender_key != $key){
		$arr = array(	'status' => 'FAIL',
						'comment' => 'incorrect key: '.$sender_key
					);
		echo json_encode($arr);
		exit();
	}
	try{
		Query::init();
		$q = new Query("SELECT * FROM teacher WHERE username = ? AND isActive = '1'","s");
		$q->execute([$sender_username]);
		$data = $q->data();
		if(!$data){
			$status = 'FAIL';
			$comment = 'incorrect username: ';
			$arr = array( 	'status' => $status,
							'comment' => $comment.$sender_username);
			echo json_encode($arr);
		}
		else if($data[0]['password'] != $sender_password){
			$status = 'FAIL';
			$comment = 'incorrect password';
			$arr = array( 	'status' => $status,
							'comment' => $comment);
			echo json_encode($arr);
		}
		else{
			$teacher_id = $data[0]['id'];
			$query = "SELECT * from subject WHERE subjectCode = ? AND isActive = '1'";
			$q1 = new Query($query,"s");
			$q1->execute([$sender_code]);
			$result = $q1->data();
			if(!$result){
				$status = 'FAIL';
				$comment = 'incorrect subject code: ';
				$arr = array( 	'status' => $status,
								'comment' => $comment.$sender_code);
				echo json_encode($arr);
			}
			else{
				$subject_id = $result[0]['id'];
				$q = new Query("SELECT * FROM subject_under_teacher WHERE subjectID = ? AND teacherId = ?","ii");
				$q->execute([$subject_id,$teacher_id]);
				$data = $q->data();
				if(!$data){
					$status = 'FAIL';
					$comment = 'subject code: ';
					$arr = array( 	'status' => $status,
									'comment' => $comment.$sender_code.' is not present under the teacher');
					echo json_encode($arr);
				}
				else{
					$query = "SELECT * FROM chapter WHERE id = ? AND isActive = '1'";
					$q = new Query($query,"i");
					$q->execute([$sender_chapterId]); 
					$result = $q->data();
					
					if(!$result || $result[0]['subjectID'] != $subject_id || $result[0]["teacherId"] != $teacher_id){
						$status = 'FAIL';
						$comment = 'incorrect chapter_id: ';
						$arr = array( 	'status' => $status,
										'comment' => $comment.$sender_chapterId);
						echo json_encode($arr);
					}
					else{
						$q = new Query("UPDATE chapter SET isActive = '0' WHERE id = ?","i");
						$q->execute([$sender_chapterId]);
						$status = 'OK';
						$comment = 'chapter deleted';
						$arr = array( 	'status' => $status,
										'comment' => $comment);
						echo json_encode($arr);
					}
				}
			}
		}
	}
	catch(Exception $e){
		$arr = array ( 'status' => 'FAIL',
						'comment'=> 'server error occurred'
					);
		echo json_encode($arr);
		report($e);
	}
	finally{
		Query::destroy();
	}
?>