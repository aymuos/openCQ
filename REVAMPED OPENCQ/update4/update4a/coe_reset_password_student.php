<?php

require('sender_header.php');

session_start();

$data['username']=$_POST['username'];
$data['new_password']=$_POST['password'];
$data['usernamecoe']=$_SESSION['usernamecoe'];
$data['passwordcoe']=$_SESSION['passwordcoe'];
$data['key']=key;
$data['category'] = $_POST['cat'];


$url = location."change_password.php";
$result = send_post_request($url,$data);
echo $result;

?>