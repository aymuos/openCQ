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
$data['key']=key;
$data['username']=$username;
$url = location."teacher_codes.php";
$result = send_get_request($url,$data);
$result = json_decode($result);
$r['status'] = $result->status;
$r['result']=[];
if($result->status=="OK"){
    foreach($result->result as $value){
        $body['code']=$value->code;
        $body['name']=$value->name;
        $r['result'][]=$body;
    }
}
else{
    echo json_encode($result);
    exit();
}
echo json_encode($r);
?>
