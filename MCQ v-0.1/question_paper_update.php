<?php


//This file takes the question statement and options from the user.
//Please proceed to the else part directly.
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
	$conn = OpenCon();
	
	$test_id = $_GET["ti"]; //This is the test id.......
	$ch = $_GET["ch"];		//This is the chapter's name.............
	
	try{
		$query = "SELECT * FROM question WHERE chapter_id = ?";
		execute($conn,$query,"i",[$ch],$stmt);
		$res = get_data($stmt);
		close($stmt);

	}
	catch(Exception $e){
		report($e);
	}

	
	//exit("hamba");
	
	$n = 10;  //put no of questions in this chapter here.........
	$query = "SELECT name FROM chapter WHERE id = ?";
	execute($conn,$query,"i",[$ch],$stmt);
	$r = get_data($stmt);
	close($stmt);
	$i = 1; 
	foreach($res as $value){
		if($_GET["q".$i] != -1){
			//Add this question to the db.....
			$ques_id = $_GET["q".$i];
			err($ques_id);
			//echo $ques_id;
			//exit("hamba");
			try{
				$conn->autocommit(FALSE);

				$query = "INSERT INTO exam_question(name,url,exam_id,chapter_name) VALUES (?,?,?,?)";
				execute($conn,$query,"ssis",[$value['name'],$value['url'],$test_id,$r[0]['name']],$stmt);
				$idd = $conn->insert_id;
				err('<br>'."insert id = ".$idd.'<br>');
				close($stmt);
                err("question inserted");
				$query = "SELECT * FROM choice WHERE question_id = ? ORDER BY is_right DESC";
				execute($conn,$query,"i",[$value['id']],$stmt);
				$choice = get_data($stmt);
				close($stmt);
				err("searched thor");
				//exit("hamba");
				$query = "INSERT INTO exam_choice(name,url,exam_question_id,is_right) VALUES (?,?,?,'1')";
				execute($conn,$query,"ssi",[$choice[0]['name'],$choice[0]['url'],$idd],$stmt);
				close($stmt);
				//exit("hamba");
				$query = "INSERT INTO exam_choice(name,url,exam_question_id,is_right) VALUES (?,?,?,'0')";
				execute($conn,$query,"ssi",[$choice[1]['name'],$choice[1]['url'],$idd],$stmt);
				close($stmt);
				//exit("hamba");
				$query = "INSERT INTO exam_choice(name,url,exam_question_id,is_right) VALUES (?,?,?,'0')";
				execute($conn,$query,"ssi",[$choice[2]['name'],$choice[2]['url'],$idd],$stmt);
				close($stmt);

				$query = "INSERT INTO exam_choice(name,url,exam_question_id,is_right) VALUES (?,?,?,'0')";
				execute($conn,$query,"ssi",[$choice[3]['name'],$choice[3]['url'],$idd],$stmt);
				close($stmt);
				
                err("there are 4 brothers");
				$conn->autocommit(TRUE);


			}
			catch(Exception $e)
			{
				$conn->rollback();
				report($e);
                //echo "hello";
			
			}
			$i = $i + 1;
			
		}
	}
	



	//Uncomment these lines..........
	header("Location: question_paper.php?test_id=".$test_id);
	
}


?>
