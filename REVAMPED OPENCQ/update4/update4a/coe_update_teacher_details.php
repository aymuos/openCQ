<?php
require('sender_header.php');

session_start();



$url = location."coe_modify_teacher.php";
$_GET = json_decode(file_get_contents("php://input"),TRUE);
$data['key']=key;
$data['usernamecoe']=$_SESSION['usernamecoe'];
$data['passwordcoe']=$_SESSION['passwordcoe'];
$data['username']=$_GET['username'];
$data['name']=$_GET['name'];
$data['department']=$_GET['department'];
$data['designation']=$_GET['designation'];
$data['address']=$_GET['address'];
$data['email']=$_GET['email'];
$data['contact_no']=$_GET['contact_no'];
$result = send_post_request($url,$data);
echo $result;
?>