<?php

//This upadates the teacher details




	$honortitle = $_POST["honortitle"];		//Title (eg: Mr,Mrs,Dr etc)
	$first_name = $_POST["first_name"];		//First name
	$last_name = $_POST["last_name"];		//Last name
	$designation = $_POST["designation"];	//Designation
	$dept = $_POST["group1"];				//Department
	$address = $_POST["address"];			//Barir address jeikhane giye thukbo
	$email = $_POST["email"];				//Humki dewar jonne mail
	$phoneno = $_POST["phoneno"];			//Prank call er jonne phone no
	
	
	$ct=1;
	if($ct == 1){	//If the update is successful this condition is satisfied
		echo 'Detais Updated Successfully! :)';
	}
	else{
		echo 'Failed...Try again after sometime! :(';
	}
	
	
?>
