<?php


//The coe wants to log in.XDDD>.... Dhukte dibi naa........porikha cazz





//This file checks the login credentials for COE

session_start();



	$username=$_POST['uname']; 
	$password=$_POST['psw']; 


	

	//Set this variable to true if successfully logged in
    $_SESSION['loggedincoe'] = true;
    $_SESSION['usernamecoe'] = $username;
    
	
    header('location: coe_dashboard.php'); 


?>

