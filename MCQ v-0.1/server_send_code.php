<?php

include 'db_connection.php';

include 'server_send_code_functions.php';

//This file is somewhat interesting. XD.
//You are given subject/course code.......simply echo the subject/course name.....
//That it........XD

	$conn = OpenCon();
	$code = $_REQUEST["q"];			//this is the course/subject code

	$name = findName($conn,$code);
	
	//Put the paper/course/subject name here...
	echo $name;

	CloseCon($conn);

?>