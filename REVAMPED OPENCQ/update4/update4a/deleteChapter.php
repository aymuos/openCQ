<?php
require('sender_header.php');
session_start();
$data['username'] = $_SESSION['usernameteacher'];
$data['password'] = $_SESSION['passwordteacher'];
$data['key']=key;
$_GET = json_decode(file_get_contents('php://input'),TRUE);

$data['sub_code']= $_SESSION['code'];
$data['chapter_id']= $_GET['id'];



if(time() - $_SESSION['lastActiveTeacher'] > timeOut){
echo json_encode( array("status" => "FAIL",
						"comment" => "session expired"));
						exit();
}
else{
	$_SESSION['lastActiveTeacher'] = time();
}






$url = location."delete_chap.php";
$result = send_post_request($url,$data);
echo $result;
?>