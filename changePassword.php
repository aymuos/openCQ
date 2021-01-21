<?php

require('sender_header.php');

session_start();

$data['username']=$_SESSION['usernameteacher'];
// $data['password']=$_SESSION['passwordteacher'];
$data['key']=key;

$_GET = json_decode(file_get_contents("php://input"),TRUE);

$data['category']=$_GET['category'];
$data['old_password']=$_GET['old_password'];
$data['new_password']=$_GET['new_password'];
$url = location."reset_password.php";
$result = send_post_request($url,$data);
echo $result;

?>