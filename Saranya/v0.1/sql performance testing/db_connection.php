<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "test";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
 if($conn->connect_error){
 	exit("Error in connecting to database");
 }



$conn->set_charset("utf8mb4");
 #echo "Connected Successfully";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 
 return $conn;
 }

 function execute(&$conn,$query,$types,$inarr,&$stmt){
 	$stmt = $conn->prepare($query);
	if($types === ""){
		;
	}
	else{
		$stmt->bind_param($types, ...$inarr);
	}
	$stmt->execute();
	#echo $conn->errno;
	#return $stmt;
 }

 
function get_data(&$stmt){
	return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function close(&$stmt){
	$stmt->close();
}

function get_id($a){
	return strtolower(preg_replace('/\s/','',$a));
}

function CloseCon(&$conn)
 {
 $conn -> close();
 }
 function err($e){
 	error_log($e,3,"errors.txt");
 }
 function report($e){
 	err($e->getMessage()." Line: ".strval($e->getLine())."\n");
 }
 function get_user(){
 	return $_SESSION['username'];
 }
?>