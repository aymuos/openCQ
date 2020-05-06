<?php
	require('library.php');
	require('receiver_header.php');



	
	$valid = checkSet(['key','examId'],0);
	if($valid[0]==0){
		$arr = array(	'status' => 'FAIL',
						'comment' => $valid[1]
					);
		echo json_encode($arr);
		exit();
	}
	$sender_key = $_GET['key'];
	$sender_code = $_GET['examId'];
	
						
	if($sender_key != $key){
		$arr = array(	'status' => 'FAIL',
						'comment' => 'incorrect key: '.$sender_key
					);
		echo json_encode($arr);
		exit();
	}
	try{
		
		
		
		if(is_readable('live/'.$sender_code) === false){
			$res = "exam has ended";
			$arr = array(	'status' => 'OK',
							'comment' => $res
						);
			echo json_encode($arr);
			exit();
		}
		else{
			
		$myfile =  fopen('live/'.$sender_code, "r");
		$attempt = fread($myfile,filesize('live/'.$sender_code));
		if($attempt == 1){
			$res = "exam is running";
		}
		else{
			$res = "exam has ended";
		}
		$arr = array(	'status' => 'OK',
						'comment' => $res
					);
		echo json_encode($arr);
		exit();
		
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