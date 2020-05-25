<?php
require('sender_header.php');

session_start();



$url = location."coe_modify_student.php";
$_GET = json_decode(file_get_contents("php://input"),TRUE);
$data['key']=key;
$data['usernameStudent']=$_GET['username'];
$data['username']=$_SESSION['usernamecoe'];
$data['password']=$_SESSION['passwordcoe'];
$data['name']=$_GET['name'];
$data['department']=$_GET['stream'];
$data['registration_no']=$_GET['registration_no'];
$data['joining_year']=$_GET['joining_year'];
$data['email']=$_GET['email'];
$data['contact_no']=$_GET['contact_no'];
// $data['designation']=$_GET['designation'];
// $data['address']=$_GET['address'];

//var_dump($data);







$result = send_post_request($url,$data);
echo $result;
?>