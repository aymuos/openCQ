<?php

//This file is somewhat interesting. XD.
//You are given subject/course code.......simply echo the exam id.....
//Thats it........XD
	include 'db_connection.php';

	$conn = OpenCon();
	$code = $_REQUEST["q"];			//this is the course/subject code
	$query = "SELECT * FROM exam WHERE subject_id = ? AND is_active = '1'";
	execute($conn,$query,"s",[$code],$stmt);
	$exam = get_data($stmt);
	close($stmt);
	
	//Put the exam id here...
	echo $exam[0]['id'];

?>