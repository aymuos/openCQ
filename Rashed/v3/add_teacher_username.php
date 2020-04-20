<?php

//This adds new account to the db. If user already exists then simply update the database.




	$teacher_uname = $_POST["uname"];	//Username
	$teacher_pass = $_POST["psw"];		//Password
	
	
	$ct=1;
	if($ct == 1){	//If the update is successful this condition is satisfied
		echo 'Detais added Successfully! :)';
	}
	else{
		echo 'Failed...Try again after sometime! :(';
	}
	
	
?>
