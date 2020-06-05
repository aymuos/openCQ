<?php
require('library.php');
require('receiver_header.php');

// $k = $_POST['key']=key;
// $u = $_POST['username']=noSpace("Soumya Mukherjee");
// $p = $_POST['password']="root";
$result['status']="";

// $parameter['key']= ($_POST['key']==key)?1:0;
// $parameter['username']=0;
// $parameter['password']=1;

$check1 = checkSet(['key','name','stream','year','username','password','sUsername','sPassword'],1);

if($check1[0]===0){
    $result['status']="FAIL";
    $result['comment']=$check1[1];
    echo json_encode($result);
    exit();
}
$k = $_POST['key'];
$u = $_POST['username'];
$p = $_POST['password'];
$n = $_POST['name'];
$s = $_POST['stream'];
$y = $_POST['year'];
$su = $_POST['sUsername'];
$sp = $_POST['sPassword'];

if($_POST['key'] != key){
    $value = $k;
    $result['status']="FAIL";
    $result['comment']="incorrect key: $value";
    echo json_encode($result);
    exit();
}

try{
    Query::init();
	$query = "SELECT * FROM coe WHERE username=? AND isActive='1' LIMIT 1";

    $q = new Query($query,"s");
    $q->execute([$u]);
    $data = $q->data();
	//var_dump($data);
    if(!$data){
        $result['status']="FAIL";
        $result['comment']="invalid username: $u";
        echo json_encode($result);
        exit();
    }
	else if($data[0]['password'] != $p){
		$result['status']="FAIL";
        $result['comment']="incorrect password";
        echo json_encode($result);
        exit();
	}
	

	

    $query = "SELECT id FROM student WHERE username=? AND isActive='1' LIMIT 1";

    $q = new Query($query,"s");
    $q->execute([$su]);
    $data = $q->data();
    if($data){
        $result['status']="FAIL";
        $result['comment']="username: $su already exists";
        echo json_encode($result);
        exit();
    }


    $query = "INSERT INTO student(username,password,name,departmentCode,joiningYear,passOutYear) VALUES (?,?,?,?,?,?)";
    $q = new Query($query,"ssssii");
    $q->execute([$su,$sp,$n,$s,($y-4),($y)]);

    $result['status']="OK";
    $result['comment']="student added successfully";
    echo json_encode($result);
    
    // try{
    //     Query::tStart();
    //     Query::tStop();
    // }
    // catch(Exception $e){
    //     Query::tRoll();
    //     throw $e;
    // }
}
catch(Exception $e){
    $sad = 'FAIL';
    $cat = 'server error occurred';
    $arror = array(  'status' => $sad,
        'comment' => $cat);
    echo json_encode($arror);
    report($e);
    exit();
}
finally{
    Query::destroy();
}
?>