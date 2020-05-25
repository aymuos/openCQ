<?php
require('sender_header.php');

session_start();

$url = location."modify_student.php";
$_GET = json_decode(file_get_contents("php://input"),TRUE);
$data['key']=key;
$data['username']=$_SESSION['usernamestudent'];
$data['password']=$_SESSION['passwordstudent'];
$data['name']=$_GET['name'];
$data['department']=$_GET['department'];
$data['registration_no']=$_GET['registration_no'];
$data['joining_year']=$_GET['joining_year'];
$data['email']=$_GET['email'];
$data['contact_no']=$_GET['contact_no'];
// $data['designation']=$_GET['designation'];
// $data['address']=$_GET['address'];
$result = send_post_request($url,$data);
echo $result;
?>