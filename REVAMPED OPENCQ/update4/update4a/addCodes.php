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



if(time() - $_SESSION['lastActiveTeacher'] > timeOut){
echo json_encode(json_encode( array("status" => "FAIL",
						"comment" => "session expired")));
						exit();
}
else{
	$_SESSION['lastActiveTeacher'] = time();
}







$username = $_SESSION['usernameteacher'];
$password = $_SESSION['passwordteacher'];
$data['key']=key;
$data['username']=$username;
$data['password']=$password;
$_GET = json_decode(file_get_contents('php://input'),TRUE);

// $_GET['codes']=['CS502'];
$data['codes']=$_GET['codes'];

$url = location."take_subjects.php";
$result = send_post_request($url,json_encode($data),1);
echo json_encode($result);
?>

