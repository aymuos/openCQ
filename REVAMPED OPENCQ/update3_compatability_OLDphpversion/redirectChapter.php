<?php
session_start();
$_GET = json_decode(file_get_contents("php://input"),TRUE);
// $_GET['code']="MU250";
// $_GET['paper']="m";
$_SESSION['code']=$_GET['code'];
$_SESSION['paper']=$_GET['paper'];
echo json_encode(array("status"=>"OK"));
?>