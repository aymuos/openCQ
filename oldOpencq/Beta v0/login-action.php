<!DOCTYPE html>
<html>
<head>
<title>Mcq Test</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="action.js"></script>
</head>


<?php

include 'db_connection.php';
/*set_error_handler(function($errno,$errstr,$errfile,$errline){
	throw new Exception("$errstr with $errno on $errfile in $errline");
})*/





$conn = OpenCon();
 $conn->set_charset("utf8mb4");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
$username=$_POST['uname']; 
$password=$_POST['psw'];

#echo "\nhello Rashed";
try{

	$query = "SELECT * FROM student WHERE user_id = ? and password = ? ";
	execute($conn,$query,"ss",[$username,$password],$stmt);
	$student = get_data($stmt);
	close($stmt);
	//$stmt = $conn->prepare("");
	//$stmt->bind_param("ss",$username,$password);
	//$stmt->execute();

	//$stmt->store_result();
	if(!$student){
		#echo "Not connected";
		header('location: tests.php');
	} 
	else{
		//$stmt->bind_result($user_id,$pass,$name,$dept,$year);
		//$stmt->fetch();
		#echo "Connected Successfully";
		session_start();
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
		err("connected");
		header('location: student-dashboard.php');
	} 
}
catch(Exception $e){
	echo $e->get_message();

}

$stmt->close();
CloseCon($conn);
?>