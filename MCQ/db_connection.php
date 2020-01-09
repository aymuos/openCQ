<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "mcq";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
 if($conn->connect_error){
 	exit("Error in connecting to database");
 }




 #echo "Connected Successfully";
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>