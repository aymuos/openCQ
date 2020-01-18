<?php





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
		
		
		
		for($i=0;$i<=10;$i++){
			echo '<tr><td>';
			
			
			//Please Enter the roll no here.........
			echo 'GCECTB-R17-3018';
			
			
			echo '</td><td>';
			
			
			//Please enter the name here..........
			echo 'Rashed Mehdi';
			
			
			echo '</td><td>';
			
			
			//Please enter the department here..........
			echo 'CSE';
			
			echo '</td><td>';
			
				
			
			
			//Please enter the MARKS here..........
			echo '8.73';
			
			
			echo '</td></tr>';
			
		}

		
		echo '
		</tbody>
	</table>
</form>	
</p>

	
    </tbody>
  </table>


</body>
</html>
	
';	
}
?>