<?php


include 'db_connection.php';


//This page diaplays the results of all the students in a tabular form.
//Please proceed to the else part directly........

session_start();
if ( isset($_SESSION['loggedinmaster']) == false ){
	echo ' 
	<html>
		<head>
			<title>Oops!!!</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		</head>
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
	
	$test_id = $_POST["test_id"];

	$conn = OpenCon();
	
	try{
		$query = "SELECT student.user_id AS user, student.name AS name, student.department AS dept, SUM(exam_marks.marks) AS m FROM exam_marks INNER JOIN student ON exam_marks.user_id = student.user_id WHERE exam_marks.exam_id = ? GROUP BY student.user_id,student.name,student.department,student.year  ORDER BY m DESC;  ";
		execute($conn,$query,"i",[$test_id],$stmt);
		$result = get_data($stmt);
		close($stmt);

	}
	catch(Exception $e){
		report($e);
		exit("error");
	}
	
echo '

	
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="outputtable.css" >
  <title>Results Sheet</title>
  <link rel="icon" href="logo1024.png" type="image/gif" sizes="26x26">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script type="text/javascript">

	$(document).ready(function () {	
		$("#table-main tbody").on("click", "tr", function() {
			//get row contents into an array
			var tableData = $(this).children("td").map(function() {
			return $(this).text();
		}).get();
		var td=tableData[0];
		window.location.href = "view-result4.php?st_id=" + td + "&test_id=';echo $test_id;echo '";

		});
	});	
	
	</script>
  
  </head>
  
  
 <body>
 <h2> GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY , KOLKATA
</h2>
<p><h1 class="crjk">
  Results table:
  </h1></p>
  <p style="text-align: center">(Click on the row to view the Answer script)</p>
     <p class="ffq">
	 <form>
	 <input type="text"  name="test_id" value="';echo $test_id;echo '" readonly hidden>
	 <table class="Neur" id="table-main">
		<thead>
		<tr class="tblRows">
			<th>ROLL NUMBER</th>
			<th>NAME</th>
			<th>DEPARTMENT</th>
			<th>MARKS</th>
		</tr>
		</thead>
		<tbody>';
		
		
		
		foreach($result as $value){
			echo '<tr><td>';
			
			
			//Please Enter the roll no here.........
			echo $value['user'];
			
			
			echo '</td><td>';
			
			
			//Please enter the name here..........
			echo $value['name'];
			
			
			echo '</td><td>';
			
			
			//Please enter the department here..........
			echo $value['dept'];
			
			echo '</td><td>';
			
				
			
			
			//Please enter the MARKS here..........
			echo $value['m'];
			
			
			echo '</td></tr>';
			
		}
		CloseCon($conn);
		
		echo '
		</tbody>
	</table>
</form>	
</p>

	
    </tbody>
  </table>
	<div class="button-container" style="text-align:center;">
		<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button>
	</div>

</body>
</html>
	
';	
}
?>
