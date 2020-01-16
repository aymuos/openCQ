<?php






//This file creates a test in the database from the provided information.
//This doesnot begins a test, just creates it and saves it.
//Proceed to the else part directly.


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






	$test_desc = $_POST["desc"];	//Small description regarding the test
	$test_id = $_POST["ti"];		//Test Id
	$total_questions = $_POST["lent"];	//Contains total no of questions. It will be always greter equal to 1.
	
	
	
	
	//Date can be null if it is not given. Otherwise it contains any date given by the user.
	$date = $_POST["date"];
	

	//Please put the total no of chapters in this variable.
	$len = 10;
	
	for($i=1;$i<=$len;$i++){
		
		
		
		if(isset($_POST["chappie".strval($i)])){
			$chname = $_POST["chappie".strval($i)];
			
			
			//This chapter ($chname) is included in test please make necessary changes
			echo $chname;
			
		}
		//if none of the chapter is selected then it doesnot enter in this IF statementx
		
	}
	
	//Make necessary changes to create the test.
	
	
	
	//Simply redirects to test-dashboard-create3.....
	header("Location: test-dashboard-create3.php");
	
}
?>