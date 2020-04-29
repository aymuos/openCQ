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
    $query = "SELECT examId FROM marksheet WHERE examId=? AND studentId=? 
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
    // return $info[0]['questionShuffle'];
}



try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="Having fun";
    // $_POST['password']="lol";
    // $_POST['examId']="3";
    set();
    $input = (object)($_POST);
    $stid = validateUser();

        validateExam($input->examId);
        validateParticipation($stid);

    $query = "SELECT COUNT(examId) AS  count FROM exam_questions WHERE examId = ?";
    $q = new Query($query,"i");
    $q->execute([$input->examId]);
    $count = $q->data();
    $count = $count[0]['count'];
    $attempt = str_repeat("0",$count);

    $qshuffle = mt_rand();
    $file = exam.$stid."_".$input->examId.".txt";
    $file = fopen($file,"w");
    fwrite($file,$attempt);
    fclose($file);
    $query = "INSERT IGNORE INTO marksheet(examId,studentId,questionShuffle,
    attempts,marks) VALUES (?,?,?,?,0)";
    $q = new Query($query,"iiis");
    $q->execute([$input->examId,$stid,$qshuffle,$attempt]);

    $result['status']='OK';
    $result['comment']="student has participated in the exam";
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
    if($e->getCode()===1062){
        $result['status']='FAIL';
        $result['comment']="student is already in exam";
        echo json_encode($result);
        exit();
    }
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