<?php
require('receiver_header.php');
require('library.php');
function set(){
    $valid = checkSet(['key','username','password','examId','studentUsername'],1);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
}
function validateUser(){
    $user = $_POST['username'];
    $stuser = $_POST['studentUsername'];
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
    $query= "SELECT MAX(id) AS stid FROM student WHERE username=?";
    $q = new Query($query,"s");
    $q->execute([$stuser]);
    $info = $q->data();
    if(!$info[0]['stid']){
        $result['status']='FAIL';
        $result['comment']="incorrect studentUsername: $stuser";
        echo json_encode($result);
        exit();
    }
    // var_dump($info);
    return $info[0]['stid'];
}
function validateExam($id){
    $query = "SELECT id FROM
    exam WHERE id=?  AND isActive = '1' LIMIT 1";
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

function validateParticipation($stid){
    $exam = $_POST['examId'];
    $query = "SELECT examId FROM marksheet WHERE examId=? AND studentId=? 
    LIMIT 1";
    $q = new Query($query,"ii");
    $q->execute([$exam,$stid]);
    $info = $q->data();
    if(!$info){
        $result['status']='FAIL';
        $result['comment']="student has never started the exam";
        echo json_encode($result);
        exit();
    }
    // return $info[0]['questionShuffle'];
}
try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="root";
    // $_POST['password']="shoot";
    // $_POST['studentUsername']="Having fun";
    // $_POST['examId']="2";
    set();
    $input = (object)($_POST);
    $stid = validateUser();
    validateExam($input->examId);
    validateParticipation($stid);
    $query = "UPDATE marksheet SET submitted='0' WHERE examId=? AND studentId=?";
    $q = new Query($query,"ii");
    $q->execute([$input->examId,$stid]);
    $result['status']='OK';
    $result['comment']='exam has been restarted for the student';
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