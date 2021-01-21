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
if(isset($_SESSION['teachername'])){
    $r = $_SESSION['teachername'];
    // $result['status']="OK";
    $result=array('name' => "$r");
    echo json_encode($result);
    exit();
}
$username = $_SESSION['usernameteacher'];
$data['key']=key;
$data['username']=$username;
$url = location."teacher_info.php";
$result = send_get_request($url,$data);
echo $result;
?>
