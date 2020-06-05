<?php

require('sender_header.php');
//This displays the running exams..........
//Proceed to the else part directly.......



session_start();
if ( isset($_SESSION['loggedincoe']) == false ){
echo '
	please login!
';
}
else {



$url=location."add_student.php";
$data = array(		"key" => key,
					"username" => $_SESSION["usernamecoe"],
					"password" => $_SESSION["passwordcoe"],
					"stream" => $_POST["sstream"],
					"name" => $_POST["sname"],
					"year" => $_POST["syear"],
					"sUsername" => $_POST['sroll'],
					"sPassword" => $_POST['spassword']
				);
$result = send_post_request($url,$data);

echo $result;

}

?>
