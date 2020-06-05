<?php
session_start();
require('sender_header.php');
$data['username'] = $_SESSION['usernameteacher'];
$data['password'] = $_SESSION['passwordteacher'];
$data['key']=key;
$data['sub_code']=$_SESSION['code'];
$_GET = json_decode(file_get_contents('php://input'),TRUE);
// $_GET['text']="pubg rage";
$data['chapter_name']=$_GET['text'];




if(time() - $_SESSION['lastActiveTeacher'] > timeOut){
echo json_encode( array("status" => "FAIL",
						"comment" => "session expired"));
						exit();
}
else{
	$_SESSION['lastActiveTeacher'] = time();
}





$url = location."add_chap.php";
$result = send_post_request($url,$data);
echo $result;
?>