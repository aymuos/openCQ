<?php


//Update password



	$op = $_POST["old_password"];	//old password
	$np = $_POST["new_password"];	//new password
	
	$ct = 1;
	if($ct==1){		//If password was successfully change then this if condition is satisfied
		echo "Password was successfully changed! :)";
	}
	else{
		echo "old password did not matched! :(";
	}
	
	
	
?>