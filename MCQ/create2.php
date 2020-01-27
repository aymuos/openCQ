<?php


$name = $_POST["f_name"];	//Name
$roll = $_POST["f_roll"];	//Roll no
$reg = $_POST["f_reg"];		//Reg no.....Can be Null
$email = $_POST["f_email"];	//Email......Can be null
$year = $_POST["f_year"];	//Registration year
$dept = $_POST["f_dept"];	//department
$psw= $_POST["f_psw"];		//password



header("location: create3.html");


?>