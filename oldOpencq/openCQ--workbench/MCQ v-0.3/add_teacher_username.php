<?php

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
else{


//This adds new account to the db. If user already exists then simply update the database.
	include 'db_connection.php';



	$teacher_uname = $_POST["uname"];	//Username
	$teacher_pass = $_POST["psw"];		//Password
	
	
	$conn = OpenCon();
	try{
		$query="INSERT INTO teacher(id,password) VALUES (?,?) ON DUPLICATE KEY UPDATE password=VALUES(password)";
		execute($conn,$query,"ss",[$teacher_uname,$teacher_pass],$stmt);
		close($stmt);
		echo 'Detais added Successfully! :)';
	}
	catch(Exception $e){
		report($e);
		echo 'Failed...Try again after sometime! :(';
	}

	CloseCon($conn);
	/*$ct=1;
	if($ct == 1){	//If the update is successful this condition is satisfied
		
	}
	else{
		
	}*/
}	
	
?>
