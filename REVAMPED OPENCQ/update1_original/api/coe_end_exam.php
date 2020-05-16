<?php
require('receiver_header.php');
require('library.php');
function set(){
    $valid = checkSet(['key','username','password','examId'],1);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
}
function validateUser(){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $query = "SELECT id FROM coe WHERE username=? AND password=? AND isActive='1' 
    LIMIT 1";
    $q = new Query($query,"ss");
    $q->execute([$user,$pass]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect username/password: $user";
        echo json_encode($result);
        exit();
    }
    
}

function validateExam($id){
    $query = "SELECT id FROM
    exam WHERE id=?  AND isActive='1' LIMIT 1";
    $q = new Query($query,"i");
    $q->execute([$id]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect examId: $id";
        echo json_encode($result);
        exit();
    }
    
}



try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="root";
    // $_POST['password']="shoot";
    // $_POST['examId']="ALL";
    set();
    $input = (object)($_POST);
    validateUser();
    if($input->examId!="ALL"){

        validateExam($input->examId);
		
		unlink("live/".$input->examId);
		
		
        $query = "UPDATE exam SET isActive='3' WHERE id=?";
        $q = new Query($query,"i");
        $q->execute([$input->examId]);
        $result['status']='OK';
        $result['comment']="exam has been ended";
		
        echo json_encode($result);

    }
    else{
		
		$query = "SELECT id from exam WHERE isCoeVisible='1' AND isActive='1'";
        $q = new Query($query);
        $q->execute();
		$data = $q->data();
		for($i=0;$i<count($data);$i++){
			unlink("live/".$data[$i]['id']);
		}
		
        $query = "UPDATE exam SET isActive='3' WHERE   isActive='1'";
        $q = new Query($query);
        $q->execute();
        $result['status']='OK';
        $result['comment']="exam has been ended";
        echo json_encode($result);
    }

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
    report($e);
    $sad = 'FAIL';
    $cat = 'server error occurred';
    $arror = array(  'status' => $sad, 'comment' => $cat);
    echo json_encode($arror);
    exit();
}
finally{
    Query::destroy();
}
?>