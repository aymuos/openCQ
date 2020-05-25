<?php


//Add the subject codes to the database....
//Proceed to the else part directly.......
include 'db_connection.php';

$conn = OpenCon();

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
else {

	
	$sub_code = $_POST["pcode"];	//This has subject code 
	$sub_name = $_POST["pname"];	//This has subject name
	$lev = $_POST["group1"];		//This has either PG or UG
	$dept = $_POST["dept"];			//This has the department name....
	
	
	
	if($lev == 'UG'){
		$lev = '1';
	}	
	else{
		$lev = '0';
	}
	try{
		$query = "INSERT INTO subject(id,name,department,UG) VALUES (?,?,?,?)";
		execute($conn,$query,"ssss",[$sub_code,$sub_name,$dept,$lev],$stmt);
		close($stmt);
	}
	catch(Exception $e){
		report($e);
	}

	
	CloseCon($conn);
	header("Location: coe_availablesubcodes.php");
}	
?>
	