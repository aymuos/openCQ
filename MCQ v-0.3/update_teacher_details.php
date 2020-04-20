<?php
session_start();


include 'db_connection.php';

//This file shows all the previous test of a particular teacher and a
//particular subject code. Display all previous exams as well as newly
//created exams.





if ( isset($_SESSION['loggedinmaster']) == false ){
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
			<p class="text-center">Please <a href="master.html">Login</a> first</p>
		</div>
	</div>
</body>
</html>
';
}
else{


//This upadates the teacher details

	//include 'db_connection.php';


	$honortitle = $_POST["honortitle"];		//Title (eg: Mr,Mrs,Dr etc)
	$first_name = $_POST["first_name"];		//First name
	$last_name = $_POST["last_name"];		//Last name
	$designation = $_POST["designation"];	//Designation
	$dept = $_POST["group1"];				//Department
	$address = $_POST["address"];			//Barir address jeikhane giye thukbo
	$email = $_POST["email"];				//Humki dewar jonne mail
	$phoneno = $_POST["phoneno"];			//Prank call er jonne phone no
	
	$conn = OpenCon();
	try{

		$query = "INSERT INTO teacher(id,hontitle,name,lastname,designation,department,address,email,contact) VALUES (?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE hontitle = VALUES(hontitle), name= VALUES(name), lastname = VALUES(lastname), department = VALUES(department), designation = VALUES(designation), address = VALUES(address), contact = VALUES(contact), email = VALUES(email)";
		execute($conn,$query,"sssssssss",[get_teacher(),$honortitle,$first_name,$last_name,$designation,$dept,$address,$email,$phoneno],$stmt);
		close($stmt);
		echo 'Detais Updated Successfully! :)';
	}
	catch(Exception $e){
		report($e);
		echo 'Failed...Try again after sometime! :(';
		//exit("Error in update_teacher_details.php");
	}
	/*$ct=1;
	if($ct == 1){	//If the update is successful this condition is satisfied
		
	}
	else{
		
	}*/
	CloseCon($conn);
	
}	
?>
