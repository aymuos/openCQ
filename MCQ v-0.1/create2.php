<?php

include 'db_connection.php';

$name = $_POST["f_name"];	//Name
$roll = $_POST["f_roll"];	//Roll no
$reg = $_POST["f_reg"];		//Reg no.....Can be Null
$email = $_POST["f_email"];	//Email......Can be null
$year = $_POST["f_year"];	//Registration year
$dept = $_POST["f_dept"];	//department
$psw= $_POST["f_psw"];		//password

$conn = OpenCon();

try{


	$query = "INSERT INTO student(user_id, password, name, stream, year, email, registration) VALUES (?,?,?,?,?,?,?)";
	execute($conn,$query,"sssssss",[$roll,$psw,$name,$dept,$year,$email,$reg],$stmt);

	close($stmt);

}
catch(Exception $e){
	if($conn->errno === 1062){
		echo("User already exists");
	}
	else{
		report($e);
	}
	exit("");
}

CloseCon($conn);

header("location: create3.html");


?>