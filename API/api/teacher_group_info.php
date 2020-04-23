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
	else if(!isset($_GET["stream"])){
		$status = 'FAIL';
		$comment = 'undefined parameter: stream';
		$arr = array( 	'status' => $status,
						'comment' => $comment);
		echo json_encode($arr);
		exit();
	}
	else{
		$sender_key = $_GET['key'];
		$sender_stream = strtoupper($_GET['stream']);
		if($sender_key != $key){
			$status = 'FAIL';
			$comment = 'incorrect key: ';
			$arr = array( 	'status' => $status,
							'comment' => $comment.$sender_key);
			echo json_encode($arr);
			exit();
		}
		else if($sender_stream != "CSE" && $sender_stream != "CT" && $sender_stream != "IT" && $sender_stream != "1"){
			$status = 'FAIL';
			$comment = 'incorrect stream: ';
			$arr = array( 	'status' => $status,
							'comment' => $comment.$sender_stream);
			echo json_encode($arr);
			exit();
		}
		try{
			Query::init();
			if($sender_stream == '1'){
				$query = "SELECT * FROM teacher WHERE isActive = '1'";
				$q1 = new Query($query);
				$q1->execute();
			}
			else{
				$query = "SELECT * FROM teacher WHERE departmentCode = ? AND isActive = '1'";
				$q1 = new Query($query,"s");
				$q1->execute([$sender_stream]);
			}
			$student = $q1->data();		
			$result = array();
			for($i = 0; $i<count($student); $i++){
				$db_username = $student[$i]['username'];
				$db_name = $student[$i]['name'];
				$db_email = $student[$i]['email'];
				$db_contactNo = $student[$i]['contactNo'];
				$db_departmentCode = $student[$i]['departmentCode'];
				$db_designation = $student[$i]['designation'];
				$db_address = $student[$i]['address'];
				
				$temp = array(	'username' => $db_username,
								'name' => $db_name,
								'department' => $db_departmentCode,
								'designation' => $db_designation,
								'address' => $db_address,
								'email' => $db_email,
								'contact no' => $db_contactNo
							);
				array_push($result,$temp);	
							
			}
			
			$arr = array(	'status' => 'OK',
							'result' => $result);
				
							
				echo json_encode($arr);
				
			
		}
		catch(Exception $e){
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