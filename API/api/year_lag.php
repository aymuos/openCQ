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

$check1 = checkSet(['key','username','password','studentUsername'],1);

if($check1[0]===0){
    $result['status']="FAIL";
    $result['comment']=$check1[1];
    echo json_encode($result);
    exit();
}
$k = $_POST['key'];
$u = $_POST['username'];
$p = $_POST['password'];
$uname = $_POST['studentUsername'];

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
	if(!$data){
		$result['status']="FAIL";
        $result['comment']="incorrect username: $u";
        echo json_encode($result);
        exit();
	}
	else if($data[0]['password'] != $p){
		$result['status']="FAIL";
        $result['comment']="incorrect password";
        echo json_encode($result);
        exit();
	}



    $query = "SELECT * FROM student WHERE username=? AND isActive='1' LIMIT 1";

    $q = new Query($query,"s");
    $q->execute([$uname]);
    $data = $q->data();
    if(!$data){
        $result['status']="FAIL";
        $result['comment']="username: $uname does not exists";
        echo json_encode($result);
        exit();
    }


    $query = "UPDATE student SET passOutYear = ? WHERE id = ?";
    $q = new Query($query,"ii");
    $q->execute([$data[0]['passOutYear']+1,$data[0]['id']]);

    $result['status']="OK";
    $result['comment']="Changes are made successfully";
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