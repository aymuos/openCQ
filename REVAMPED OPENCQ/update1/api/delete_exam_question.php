<?php
require('receiver_header.php');
require('library.php');
function set(){
    $valid = checkSet(['key','username','password','questionId','examId','code'],1);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
}

function validateSubject($sid){
    $query= "SELECT id FROM subject 
    WHERE id=? AND subjectCode=? AND isActive='1' LIMIT 1";
    $q = new Query($query,"is");
    $q->execute([$sid,$_POST['code']]);
    $exist=$q->data();
    $code = $_POST['code'];
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect code: $code";
        echo json_encode($result);
        exit();
    }
    // return $exist[0]['id'];
}

function validateUser($tid){
    $query = "SELECT id FROM teacher WHERE id=? AND username=? AND password=?
    AND isActive='1'";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $q = new Query($query,"iss");
    $q->execute([$tid,$username,$password]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect username/password: $username";
        echo json_encode($result);
        exit();
    }
    // return $exist[0]['id'];
}

function validateAllocation($subject,$user){
    try{
        $query = "SELECT subjectID FROM subject_under_teacher WHERE subjectID=? 
        AND teacherId=?";
        $q = new Query($query,"ii");
        $q->execute([$subject,$user]);
        $exist = $q->data();
        $input = (object)$_POST;
        if(!$exist){
            $result['status']='FAIL';
            $result['comment']="teacher $input->username has not undertaken subject $input->code";
            echo json_encode($result);
            exit();

        }
        
    }
    catch(Exception $e){
        throw $e;
    }

}

function validateExam($id){
    $query = "SELECT subjectID,teacherID FROM
    exam WHERE id=? AND isTeacherVisible='1' AND isActive='0' LIMIT 1";
    $q = new Query($query,"i");
    $q->execute([$id]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect examId: $id";
        echo json_encode($result);
        exit();
    }
    return [$exist[0]['subjectID'],$exist[0]['teacherID']];
}

function validateQuestion(){
    $query = "DELETE FROM exam_questions WHERE examId=? AND questionId=?";
    $q = new Query($query,"ii");
    $q->execute([$_POST['examId'],$_POST['questionId']]);
    $exist = $q->affected();
    if($exist===0){
        $question = $_POST['questionId'];
        $result['status']='FAIL';
        $result['comment']="incorrect questionId: $question";
        echo json_encode($result);
        exit();
    }

}

try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="BB";
    // $_POST['password']="AtoZ";
    // $_POST['code']="OP780";
    // $_POST['examId']="2";
    // $_POST['questionId']="10";
    set();
    $input = (object)($_POST);
    $valid = validateExam($input->examId);
    $subject = $valid[0];
    $teacher = $valid[1];
    validateSubject($subject);
    validateUser($teacher);
    validateAllocation($subject,$teacher);
    validateQuestion();
    $result['status']='OK';
    $result['comment']='question is deleted from the exam';
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