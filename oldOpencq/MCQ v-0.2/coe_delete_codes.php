<?php


//Delete the subject codes from the database....
//Proceed to the else part directly.......
include 'db_connection.php';




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

	
	$conn = OpenCon();	
	$sub_code = $_GET["cid"];		//This has the subject code
	try{
		$query = "DELETE FROM subject WHERE id = ?";
		execute($conn,$query,"s",[$sub_code],$stmt);
		close($stmt);
	}
	catch(Exception $e){
		report($e);
	}
	
	CloseCon($conn);
	header("Location: coe_availablesubcodes.php");
}	
?>
	