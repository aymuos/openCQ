<?php

//This file will delete the chapter from the database.
//please proceed to the else part directly.
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


	$name = $_POST["chapter-del"];	//This has the chapter's name that has to be deleted
	$id = preg_replace('/\s/','',$name);
	$id = strtolower($id);
	$conn = OpenCon();
 	$conn->set_charset("utf8mb4");
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	try{
		$stmt = $conn->prepare("DELETE FROM chapters WHERE chapter_id = ?");
		$stmt->bind_param("s",$id);
		$stmt->execute();
	}
	catch(Exception $e){
		#echo $e->get_message();
	}

	$stmt->close();
	CloseCon($conn);


	//*****Modify the database here.*****\\






	//Redirects to "del-a-chap3.php"
	header('location: del-a-chap3.php');
}
?>
