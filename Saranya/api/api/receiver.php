<?php

include 'receiver_header.php';



//This is a sample format how an API script will look like.
//Initially it will get all the POST requests. The format of 
//the POST request will be specified by the API developers in advance.
//This will return json file.



if(isset($_GET["address"])){
	//$arr = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5,'result'=>array(array('id'=>'254','name'=>'54'),array('id'=>'781','name'=>'54'),array('id'=>'842','name'=>'54')));
/*    $arr = array  (	'status' => 'OK',
					'result' => array(
									array(
										'username' => 'GCECTB-R17-3018',
										'name' => 'RASHED MEHDI',
										'department' => 'CSE',
										'joining year' => 2017,
										'semester' => 6,
										'registration no' => '',
										'email' => '',
										'contact no' => ''
					
									),
									array(
										'username' => 'GCECTB-R17-1019',
										'name' => 'RISHAV BANERJEE',
										'department' => 'CT',
										'joining year' => 2017,
										'semester' => 6,
										'registration no' => '',
										'email' => '',
										'contact no' => ''
					
									),
									array(
										'username' => 'GCECTB-R17-3030',
										'name' => 'SOUMYA MUKHERJEE',
										'department' => 'CSE',
										'joining year' => 2017,
										'semester' => 6,
										'registration no' => '',
										'email' => '',
										'contact no' => ''
					
									),
									array(
										'username' => 'GCECTB-R17-2024',
										'name' => 'SARANYA NAHA ROY',
										'department' => 'IT',
										'joining year' => 2017,
										'semester' => 6,
										'registration no' => '',
										'email' => '',
										'contact no' => ''
					
									))
					);*/
		$arr = array ( 'status'=>'FAIL',
						'comment'=>'incorrect joining_year: 3017');
	echo json_encode($arr); // {"a":1,"b":2,"c":3,"d":4,"e":5}
}
else{
	echo "Fail";
}

?>

