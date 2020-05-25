<?php
session_start();
$_GET = json_decode(file_get_contents("php://input"),TRUE);
// $_GET['code']="MU250";
// $_GET['paper']="m";
$_SESSION['chapterId']=$_GET['id'];
$_SESSION['chapterName']=$_GET['text'];
echo json_encode(array("status"=>"OK"));
?>