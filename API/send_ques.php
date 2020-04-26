<?php
	require("sender_header.php");
	$url='localhost/MCQN/api/add_question.php';
	$st = $_POST["statement"];
	$ac = $_POST["ac"];
	$wa1 = $_POST["wa1"];
	$wa2 = $_POST["wa2"];
	$wa3 = $_POST["wa3"];
	$data = array(	'key' => $key,
					'username'=> 'GCECT/F/00001',
					'password' => '987',
					'sub_code'=> 'CS502',
					'chapter_id'=>'80',
					'ques_id' => '7',
					'st'=> $st,
					'ac'=>$ac,
					'wa1'=> $wa1,
					'wa2'=> $wa2,
					'wa3'=> $wa3
				);
//Sending the post request. Returns a json file.
$result = send_post_request($url,$data);
//Printing the json file.
echo $result;

//$data = json_decode($result);
//echo $data->{'problem statement'};
	
//echo $data;

?>