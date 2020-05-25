<?php
require('library.php');
require('receiver_header.php');




	$input = json_decode(file_get_contents('php://input'),TRUE);
	if(!isset($input['key'])){
		$result = array(	"status" => "FAIL",
							"comment" => "undefined parameter: key"
						);
		echo json_encode($result);
		exit();
	}
	if(!isset($input['username'])){
		$result = array(	"status" => "FAIL",
							"comment" => "undefined parameter: username"
						);
		echo json_encode($result);
		exit();
	}
	if(!isset($input['password'])){
		$result = array(	"status" => "FAIL",
							"comment" => "undefined parameter: password"
						);
		echo json_encode($result);
		exit();
	}
	if(!isset($input['data'])){
		$result = array(	"status" => "FAIL",
							"comment" => "undefined parameter: data"
						);
		echo json_encode($result);
		exit();
	}
	if($input['key'] != key){
		$result = array(	"status" => "FAIL",
							"comment" => "incorrect key: ".$input['key']
						);
		echo json_encode($result);
		exit();
	}
	try{
		Query::init();
		$query = "SELECT * FROM coe WHERE username=? AND isActive='1' LIMIT 1";
		$q = new Query($query,"s");
		$q->execute([$input['username']]);
		$data = $q->data();
		//var_dump($data);
		if(!$data){
			$result['status']="FAIL";
			$result['comment']="invalid username: ".$input['username'];
			echo json_encode($result);
			exit();
		}
		else if($data[0]['password'] != $input['password']){
			$result['status']="FAIL";
			$result['comment']="incorrect password";
			echo json_encode($result);
			exit();
		}
		
		
		$err_data = array();
		$success = 0;
		$total = count($input['data']);
		
		
		
		
		for($i=0;$i<$total;$i++){
			if(!isset($input['data'][$i]['email'])){
				$message = array(	"line" => $i,
									"reason" => 'undefined parameter: email'
								);
				array_push($err_data,$message);
				continue;
			}
			if(!isset($input['data'][$i]['name'])){
				$message = array(	"line" => $i,
									"reason" => 'undefined parameter: name'
								);
				array_push($err_data,$message);
				continue;
			}
			if(!isset($input['data'][$i]['roll'])){
				$message = array(	"line" => $i,
									"reason" => 'undefined parameter: roll'
								);
				array_push($err_data,$message);
				continue;
			}
			if(!isset($input['data'][$i]['stream'])){
				$message = array(	"line" => $i,
									"reason" => 'undefined parameter: stream'
								);
				array_push($err_data,$message);
				continue;
			}
			if(!isset($input['data'][$i]['passOutYear'])){
				$message = array(	"line" => $i,
									"reason" => 'undefined parameter: passOutYear'
								);
				array_push($err_data,$message);
				continue;
			}
			$name = ucwords(strtolower($input['data'][$i]['name']));
			$username = $input['data'][$i]['roll'];
			$email = $input['data'][$i]['email'];
			$stream = strtoupper($input['data'][$i]['stream']);
			$year = $input['data'][$i]['passOutYear'];
			if (!preg_match('/GCECT[B|M]-[R|L][0-9][0-9]-[1-3][0-9][0-9][0-9]/',$username) || strlen($username)!=15){
				$message = array(	"line" => $i,
									"reason" => 'invalid roll no: '.$username
								);
				array_push($err_data,$message);
				continue;
			}
			if($stream != 'CSE' && $stream != 'CT' && $stream != 'IT'){
				$message = array(	"line" => $i,
									"reason" => 'invalid stream: '.$stream
								);
				array_push($err_data,$message);
				continue;
			}
			
			try{
				$query = "SELECT * FROM student WHERE username=? AND isActive='1' LIMIT 1";
				$q = new Query($query,"s");
				$q->execute([$username]);
				$data = $q->data();
				if($data){
					$message = array(	"line" => $i,
										"reason" => 'roll no already exists: '.$username
									);
					array_push($err_data,$message);
					continue;
				}
				
				
				$query = "INSERT INTO student(username,name,password,email,departmentCode,joiningYear,passOutYear) VALUES (?,?,?,?,?,?,?)";
				$q = new Query($query,"sssssii");
				$q->execute([$username,$name,$email,$email,$stream,($year-4),$year]);
				$success+=1;
					
			}
			catch(Exception $e){
				$message = array(	"line" => $i,
									"reason" => 'could not enter the data. Some server error occurred'
								);
				array_push($err_data,$message);
				report($e);
				continue;
			}
		}
		
		$ans = array( 	"status" => "OK",
						"result" => array( "total rows" => $total,
											"successfull rows" => $success,
											"failed rows" => $total - $success,
											"error log" => $err_data
										)
					);
		
		echo json_encode($ans);
	}
	catch(Exception $e){
		$sad = 'FAIL';
		$cat = 'server error occurred';
		$arror = array(  'status' => $sad,
			'comment' => $cat);
		echo json_encode($arror);
		report($e);
	}
	finally{
		Query::destroy();
	}



?>