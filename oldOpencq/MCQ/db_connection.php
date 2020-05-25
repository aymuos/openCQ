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
 function paper($a){
 	$p = [];
 	foreach($a as $v){
 		$p[$v['q']][]=[$v['c'],$v['m'],$v['r']];
 	}
 	return $p;
 }  
function choice_ordering($a){
	$choice=[];
	foreach($a as $v){
		$choice[$v[0]] = [$v[1],$v[2]];
	}
	$st=[];
	foreach($choice as $key=>$value){
		$st[]=$key;
	}
	$sp=[];
	$nsp=[];
	foreach($st as $value){
		$flag = 0;
		$arr = explode(" ",$value);
		foreach($arr as $x){
			if(strtolower($x) == "both"){
				$flag=1;
				break;
			}
		}
		if($flag == 1){
			$sp[]=[0,$value];
		}
		else{


			$flag = 0;
			//$arr = explode(" ",$value);
			foreach($arr as $x){
				if(strtolower($x) == "all"){
					$flag=1;
					break;
				}
			}
			if($flag == 1){
				$sp[]=[1,$value];
			}
			else{


				$flag = 0;
				//$arr = explode(" ",$value);
				foreach($arr as $x){
					if(strtolower($x) == "none"){
						$flag=1;
						break;
					}
				}
				if($flag == 1){
					$sp[]=[2,$value];
				}
				else{
					$nsp[]=$value;
				}
			}
		}

	}
	sort($nsp);
	sort($sp);

	$result =[];
	foreach($nsp as $value){
		$result[]=[$value,$choice[$value][0],$choice[$value][1]];
	}
	foreach($sp as $value){
		$result[]=[$value[1],$choice[$value[1]][0],$choice[$value[1]][1]];
	}
	return $result;
}

?>