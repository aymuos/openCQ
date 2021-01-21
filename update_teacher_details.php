<?php
require('sender_header.php');

session_start();

$url = location."modify_teacher.php";
$_GET = json_decode(file_get_contents("php://input"),TRUE);
$data['key']=key;
$data['username']=$_SESSION['usernameteacher'];
$data['password']=$_SESSION['passwordteacher'];
$data['name']=$_GET['name'];
$data['department']=$_GET['department'];
$data['designation']=$_GET['designation'];
$data['address']=$_GET['address'];
$data['email']=$_GET['email'];
$data['contact_no']=$_GET['contact_no'];
$result = send_post_request($url,$data);
echo $result;
?>