<?php

require('sender_header.php');
//This displays the running exams..........
//Proceed to the else part directly.......



session_start();
if ( isset($_SESSION['loggedincoe']) == false ){
echo ' 
<html>
<head>
  <title>Oops!!!</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>
<body>
	<div class="well-lg">
		<div class="alert alert-danger">
			<p class="text-center">Please <a href="coe-login.html">Login</a> first</p>
		</div>
	</div>
</body>
</html>
';
}
else {



$url="localhost/update1/api/delete_teacher.php";
$data = array(		"key" => key,
					"username" => $_GET["username"],
				);
$result = send_get_request($url,$data);

echo $result;

}

?>
