<?php
require ('sender_header.php');
session_start();
// if (!isset($_SESSION['loggedinmaster'])){
//     echo ' 
//     <html>
//     <head>
//       <title>Oops!!!</title>
//       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
//       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
//       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
//     </html>
//     <body>
//     <div class="well-lg">
//     <div class="alert alert-danger">
//     <p class="text-center">Please <a href="master.html">Login</a> first</p>
//     </div>
//     </div>
//     </body>
//     </html>
//     ';
//     exit();
// }
$username = $_SESSION['usernameteacher'];
$password = $_SESSION['passwordteacher'];
$data['key']=key;
$data['username']=$username;
$data['password']=$password;
$_GET = json_decode(file_get_contents('php://input'),TRUE);
$data['code']=$_GET['code'];
$url = location."remove_subject.php";
$result = send_post_request($url,$data);
echo $result;
?>