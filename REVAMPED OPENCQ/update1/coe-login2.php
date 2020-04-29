<?php


//The coe wants to log in.XDDD>.... Dhukte dibi naa........porikha cazz





//This file checks the login credentials for COE

	session_start();



	$username=$_POST['uname']; 
	$password=$_POST['psw']; 
    $_SESSION['loggedincoe'] = true;
    $_SESSION['usernamecoe'] = $username;
	$_SESSION['passwordcoe'] = $password;
    header('location: coe_dashboard.php');

?>

