<?php
	require('library.php');
	require('receiver_header.php');
	// $_POST['key']=key;
	// $_POST['username']="";
	// $_POST['password']="";
	// $_POST['sub_code']="";
	// $_POST['chapter_id']="";
	// $_POST['st']="";
	// $_POST['ac']="";
	// $_POST['wa1']="";

	// $_POST['wa2']="";
	// $_POST['wa3']="";
	// $_POST['wa4']="";
	
	$valid = checkSet(['key','username','password','sub_code','chapter_id','st','ac','wa1','wa2','wa3'],1);
	if($valid[0]==0){
		$arr = array(	'status' => 'FAIL',
						'comment' => $valid[1]
					);
		echo json_encode($arr);
		exit();
	}
	$sender_key = $_POST['key'];
	$sender_code = $_POST['sub_code'];
	$sender_username = $_POST['username'];
	$sender_password = $_POST['password'];
	$sender_chapterId = $_POST['chapter_id'];
	
	$question_data = array(	$_POST["st"],
							$_POST["ac"],
							$_POST["wa1"],
							$_POST["wa2"],
							$_POST["wa3"],
						);
						
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
		else if($data[0]['password']!=$sender_password){
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
				$comment = 'incorrect sub_code: ';
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
					$comment = 'sub_code: ';
					$arr = array( 	'status' => $status,
									'comment' => $comment.$sender_code.' is not present under the teacher');
					echo json_encode($arr);
				}
				else{
					$q = new Query("SELECT * FROM chapter WHERE id = ? AND isActive = '1'","i");
					$q->execute([$sender_chapterId]);
					$data = $q->data();
					if(!$data){
						$status = 'FAIL';
						$comment = 'invalid chapter_id: ';
						$arr = array( 	'status' => $status,
										'comment' => $comment.$sender_chapterId);
						echo json_encode($arr);
					}
					else{
						try{
							$n = $data[0]['noOfQues'];
							Query::tStart();
							$query ="INSERT INTO question(chapterId) VALUES(?)";
							$q = new Query($query,'i');
							$q->execute([$sender_chapterId]);
							$name = Query::insertId();
							
							$query ="UPDATE chapter SET noOfQues = ? WHERE id = ?";
							$q = new Query($query,'ii');
							$q->execute([$n+1,$sender_chapterId]);
							
							$file_path = "questionBank/".$name."_";
							$weight = array( 0,0,0,0,0,0);
							$weight[2]=weigh($question_data[1]);
							$weight[3]=weigh($question_data[2]);
							$weight[4]=weigh($question_data[3]);
							$weight[5]=weigh($question_data[4]);
							for($i=1;$i<=5;$i++){
								$file_name = $file_path.$i.".txt";
								$myfile = fopen($file_name,"w");
								if($i==1){
									fwrite($myfile,$question_data[$i-1]);
								}
								else{
									fwrite($myfile,$weight[$i]."\n".$question_data[$i-1]);
								}
								fclose($myfile);
							}
							Query::tStop();
							$arr = array ( 'status' => 'OK',
											'comment'=> 'question added successfully',
											'id' => $name
										);
							echo json_encode($arr);
						}
						catch(Exception $e){
							Query::tRoll();
							for($i=1;$i<=5;$i++){
								$file_name = $file_path.$i.".txt";
								if(file_exists($file_name))unlink($file_name); 
							}
							throw $e;
						}
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