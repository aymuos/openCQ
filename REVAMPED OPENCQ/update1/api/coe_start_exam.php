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
    $query = "SELECT subjectID FROM
    exam WHERE id=? AND isCoeVisible='1' AND isActive='2' LIMIT 1";
    $q = new Query($query,"i");
    $q->execute([$id]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect examId: $id";
        echo json_encode($result);
        exit();
    }
    return $exist[0]['subjectID']; 
}

function validateActivation($sid=""){
    $examId = $_POST['examId'];
    if($examId == "ALL"){
        $query = "SELECT subjectID FROM exam WHERE isCoeVisible='1' AND isActive='2'";
        $q = new Query($query);
        $q->execute();
        $info = $q->data();
        $subjects = [];
        foreach($info as $row){
            $subjects[]=$row['subjectID'];
        }
        $test = array_unique($subjects);
        if(count($test)!=count($subjects)){
            $result['status']='FAIL';
            $result['comment']="invalid attempt to activate two exams on same subject";
            echo json_encode($result);
            exit();
        }
    }
    else{
        $query = "SELECT id FROM exam WHERE isCoeVisible='1' AND isActive='1' 
        AND subjectID=? AND id<>?" ;
        $q = new Query($query,"ii");
        $q->execute([$sid,$examId]);
        $info = $q->data();
        // var_dump($info);
        if($info){
            $result['status']='FAIL';
            $result['comment']="invalid attempt to activate two exams on same subject";
            echo json_encode($result);
            exit();
        }
        
    }
}

try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="root";
    // $_POST['password']="shoot";
    // $_POST['examId']="2";
    set();
    $input = (object)($_POST);
    validateUser();
    $time = time();
    if($input->examId!="ALL"){

        $sid = validateExam($input->examId);
        validateActivation($sid);
        $query = "UPDATE exam SET startTime=?,isActive='1' WHERE id=?";
        $q = new Query($query,"ii");
        $q->execute([$time,$input->examId]);
        $result['status']='OK';
        $result['comment']="exam has been started";
		$myfile = fopen("live/$input->examId", "w");
		fwrite($myfile,"1");
        fclose($myfile);
		echo json_encode($result);

    }
    else{
        validateActivation();
		
		$query = "SELECT id from exam WHERE isCoeVisible='1' AND isActive='2'";
        $q = new Query($query);
        $q->execute();
		$data = $q->data();
		for($i=0;$i<count($data);$i++){
			$myfile = fopen("live/".$data[$i]['id'], "w");
			fwrite($myfile,"1");
			fclose($myfile);
		}
		
        $query = "UPDATE exam SET startTime=?,isActive='1' WHERE isCoeVisible='1' AND isActive='2'";
        $q = new Query($query,"i");
        $q->execute([$time]);
		
		
				
        $result['status']='OK';
        $result['comment']="exam has been started";
        
		
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