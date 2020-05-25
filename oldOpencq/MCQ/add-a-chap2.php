<?php

//This file inserts the name of the chapter to the database and then
//redirects to the page add-a-chap3.php. please proceed to the
//else part directly.

include 'db_connection.php';

session_start();
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
else {

	$name = $_POST["chapter-name"];
	$chapter_id = get_id($name);
	//"name" variable here contains the name of the chapter which is to be
	//added to the database.
	//Please add the chapter to the database here..........
	$conn = OpenCon();
	try{
		$query = "INSERT INTO chapters (chapter_id , chapter) VALUES (?, ?)";
		execute($conn,$query,"ss",[$chapter_id,$name],$stmt);
		close($stmt);
		CloseCon($conn);
		header('location: add-a-chap3.php');
	}
	catch(Exception $e){
		#echo $conn->errno;
		if($conn->errno === 1062){
			CloseCon($conn);
			close($stmt);
			exit("Duplicate Entry");
		}
		else{
			CloseCon($conn);
			close($stmt);
			exit($e->getMessage());
		}
	}
	
	//After updating the database this file redirects the page 
	//to "add-a-chap3.php".

}
?>
