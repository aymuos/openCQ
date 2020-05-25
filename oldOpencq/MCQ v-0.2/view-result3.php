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
		$query = "SELECT * FROM student_allocation WHERE exam_id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		$student = get_data($stmt);
		close($stmt);
		
		
		$query = "SELECT * FROM exam WHERE id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		$exam = get_data($stmt);
		close($stmt);
		
		
		$query = "SELECT * FROM subject WHERE id =?";
		execute($conn,$query,"s",[$_SESSION["sub_code"]],$stmt);
		$subject = get_data($stmt);
		close($stmt);


		$query = "SELECT * FROM exam_question WHERE exam_id = ?";
		execute($conn,$query,"i",[$test_id],$stmt);
		$exam_question = get_data($stmt);
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
  <link rel="stylesheet" href="print.css" media="print">
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



<div class="head">
<p class="text">Theory / ';
					
					
					//Echo b.tech or m.tech...
					if($subject[0]['UG']=='1'){
						echo 'B.Tech';
					}
					else{
						echo 'M.Tech';
					}
					

					echo ' / <b>Stream - </b>';
					
					//Echo the stream.....
					echo $subject[0]['department'];
					
					
					
					echo ' / <b>Code </b>- ';
					
					
					//Echo the paper code here.........
					echo $subject[0]['id'];

					echo ' / <b>Year - </b>';
					
					
					//Echo the year here.............
					$time = $exam[0]['create_time'];

					$year = date('Y');
					$nextYear = (int)($year) + 1;
					$nextYearTwo = $nextYear%100;
					echo "$year";
					
					
					echo '</p>
					<p class="text"><b>Paper Name : </b>';
					
					
					//Echo paper name here.........
					echo $subject[0]['name'];
					
					
					
					
					echo '</p>

</div>









<p><h1 class="crjk">
  Results table:
  </h1></p>
  <p class="clkk" style="text-align: center">(Click on the row to view the Answer script)</p>
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
		
		
		
		foreach($student as $value){

			$query = "SELECT * FROM student WHERE id = ?";
			execute($conn,$query,"s",[$value['student_id']],$stmt);
			$result = get_data($stmt);
			close($stmt);
			echo '<tr><td>';
			
			
			//Please Enter the roll no here.........
			echo $result[0]['id'];
			
			
			echo '</td><td>';
			
			
			//Please enter the name here..........
			echo $result[0]['name'];
			
			
			echo '</td><td>';
			
			
			//Please enter the department here..........
			echo $result[0]['stream'];
			
			echo '</td><td>';
			
			/*$query = "SELECT COUNT(*) AS c FROM exam_mark WHERE student_id = ? AND mark = 1";
			execute($conn,$query,"s",[$result[0]['id']],$stmt);
			$result2 = get_data($stmt);
			close($stmt);
			
			//Please enter the MARKS here..........
			echo $result2[0]['c'];*/
			$hambacount = 0;
			foreach($exam_question as $v){
				$query = "SELECT * FROM exam_mark WHERE student_id = ? AND exam_question_id = ?";
				execute($conn,$query,"si",[$result[0]['id'],$v['id']],$stmt);
				$mark = get_data($stmt);
				close($stmt);
				if($mark[0]['mark']==1){
					$hambacount = $hambacount + 1;
				}

			}
			
			echo $hambacount;
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
		<button type="button" class="btn btn-success" onclick="window.print()">Print</button>
		<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button>
	</div>

</body>
</html>
	
';	
}
?>















