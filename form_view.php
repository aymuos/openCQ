<?php
require("sender_header.php");

// $_GET['rollNo']="GCECTB-R16-3021";
$_GET = json_decode(file_get_contents("php://input"),TRUE);
$url = location."receive.php";
$data['key']=key;
$data['rollNo']=$_GET['rollNo'];
// var_dump($url);
// var_dump($data);
$result = send_post_request($url,$data);
echo $result;
?>