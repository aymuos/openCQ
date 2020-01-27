<?php
include 'db_connection.php';
//This will take all the question of a particular chapter from the database and will show
//it in the screen so that if any modification is to be done 
//it can easily be implemented. Proceed to else part directly.



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




	$chname = $_POST["chapter-del"];	//This contains the chapter name whose questions is to be displayed.

	$chid = get_id($chname);





	echo '

<html>
<head>
<title>Add a Question</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="destroy.css">
<script type="text/javascript">

 $(document).ready(function () {	
	$("#table-main tbody").on("click", "tr", function() {
		//get row contents into an array
		var tableData = $(this).children("td").map(function() {
		return $(this).text();
    }).get();
	var td=tableData[0];
	window.location.href = "mod-a-ques3.php?ques_id=" + encodeURIComponent(td) + "&chapter_del=" + encodeURIComponent("';echo $chname;echo '") ;

	});
});	


</script>
</head>
<body id="page11">
	<div class="some" >
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
				<img class="logo" border="50" src="data/avatar.png" alt="Avatar"></img>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<font face="verdana" color="white" size="6.5px" > Dashboard</font>
					<a href="master-dashboard.php" style="text-decoration: none;opacity: 0.8"><font face="verdana" color="white" size="3px"  > &emsp;Home</font></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Account</a></li>
						<li><a href="master.html"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	
	<h1><b>Delete a Questions</b></h1>
	
	
	
	
	
	
	
	<div class="container">
	<form id="myForm" method="get" action="del-a-ques3.php">
	<select class="del-form-control" name="chapter-del" hidden>
		<option>';	
		echo $chname;
		echo '</option>
	</select>
	<table class="table table-hover" id="table-main">
    <thead>
      <tr>
        <th hidden>Id</th>
        <th>Questions</th>
      </tr>
    </thead>
    <tbody>
	
	';
	
	
	
	
	
	$conn = OpenCon();

	try{
		$query = "SELECT question_id, question FROM questions WHERE chapter_id = ?";
		execute($conn,$query,"s",[$chid],$stmt);
		$questions = get_data($stmt);
		close($stmt);
		CloseCon($conn);
	}
	catch(Exception $e){
		exit($e->getMessage());
	}
	
	//***Please modify this portion to display all the questions in the table.***\\\
	//Simply take all the chapter's question from the database and display it.
	
	#$len = 5;	//"len" contains the total no of question to be displayed.
	
	
	foreach($questions as $row){		
		echo '<tr class="tblRows">';
		echo '<td hidden>';
		
		
		
		
        //Please put the question's ID in this echo statement.
		echo $row['question_id'];
		
		
		
		
		echo '</td>';
        echo '<td>';
		
		
		
		
		//Please put the question's statement in this echo statement.
		echo $row['question'];
		
		
		
		
		echo '</td>';
		echo '</tr>';
	}
			
			
			
			
			
			
			
			
	//Rest of the part remains same.
	
	

	
echo '	
	
    </tbody>
  </table>
  </form>
	</div>
	
	

	
	
	<div class="button-container">
		<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button>
		
	</div>
  </form>
</div>

	
	
	
	
	
	
	
	

</body>
</html>


';
}
#echo "Hello";

?>














