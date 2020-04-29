<?php
require('receiver_header.php');
require('library.php');
function set(){
    $valid = checkSet(['key','username','password','examId',"questionNumber",
    "optionNumber"],1);
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
    $query = "SELECT id FROM student WHERE username=? AND password=? AND isActive='1' 
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
    return $exist[0]['id'];
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
function validateParticipation($stid){
    $exam = $_POST['examId'];
    $query = "SELECT attempts FROM marksheet WHERE examId=? AND studentId=? 
    AND submitted='0' LIMIT 1";
    $q = new Query($query,"ii");
    $q->execute([$exam,$stid]);
    $info = $q->data();
    if(!$info){
        $result['status']='FAIL';
        $result['comment']="further submission is not allowed";
        echo json_encode($result);
        exit();
    }
    return $info[0]['attempts'];
}

try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="Having fun";
    // $_POST['password']="lol";
    // $_POST['examId']="2";
    // $_POST['questionNumber']="2";
    // $_POST['optionNumber']="-4";
    set();
    $input = (object)($_POST);
    $stid = validateUser();

    validateExam($input->examId);
    $attempt = validateParticipation($stid);
    if($input->questionNumber>strlen($attempt) || (int)$input->questionNumber<=0){
        $result['status']='FAIL';
        $result['comment']="incorrect questionNumber: $input->questionNumber";
        echo json_encode($result);
        exit();
    }
    if($input->optionNumber>4 || $input->optionNumber<0){
        $result['status']='FAIL';
        $result['comment']="incorrect optionNumber: $input->optionNumber";
        echo json_encode($result);
        exit();
    }
    saveAttempt($stid,$input->examId,$input->questionNumber,($input->optionNumber)%5);
    $result['status']='OK';
    $result['comment']='attempt is saved';
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