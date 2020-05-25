<?php


//Update password
session_start();




//user can create a new test using this file.
//Proceed to the else part directly.
include 'db_connection.php';



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


	$conn = OpenCon();
	$op = $_POST["old_password"];	//old password
	$np = $_POST["new_password"];	//new password
	//$np = "It's Her Choice";

	try{
		
		$query = "UPDATE teacher SET password = ? WHERE id = ? AND password = ?";
		execute($conn,$query,"sss",[$np,get_teacher(),$op],$stmt);
		//err($stmt->affected_rows);
		if($stmt->affected_rows === 0){
			echo "old password did not match! :(";
			
		}
		else{
			echo "Password was successfully changed! :)";
		}
		close($stmt);
		
	}
	catch(Exception $e){
		report($e);
		exit("error in update_teacher_password.php");
	}

	CloseCon($conn);

	/*$ct = 1;
	if($ct==1){		//If password was successfully change then this if condition is satisfied
		;
	}
	else{
		
	}*/
	
	
}	
?>