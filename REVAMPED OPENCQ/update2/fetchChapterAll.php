<?php
require('sender_header.php');
session_start();
$data['username'] = $_SESSION['usernameteacher'];
$data['key']=key;
$data['code'] = $_SESSION['code'];

$url = location."all_chapters.php";

$result = send_get_request($url,$data);
echo $result;

?>