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
    $query = "SELECT * FROM
    exam WHERE id=? LIMIT 1";
    $q = new Query($query,"i");
    $q->execute([$id]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect examId: $id";
        echo json_encode($result);
        exit();
    }
	if($exist[0]['isActive'] != '1'){
		$result['status']='FAIL';
        $result['comment']="further submission is not allowed";
        echo json_encode($result);
        exit();
	}
		
    
}
function validateParticipation($stid){
    $exam = $_POST['examId'];
    $query = "SELECT questionShuffle FROM marksheet WHERE examId=? AND studentId=? 
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
    return $info[0]['questionShuffle'];
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
    $seed = validateParticipation($stid);
    mt_srand($seed);
    $query = "SELECT questionId FROM exam_questions WHERE examId=? ORDER BY questionId";
    $q = new Query($query,"i");
    $q->execute([$input->examId]);
    $data = $q->data();
    $questions = [];
    foreach($data as $row){
        $questions[]=$row['questionId'];
    }
    shuffle($questions);
    $result['status']='OK';
    $result['result']=[];
    
    $attempt = getAttempt($stid,$input->examId);
    $i=0;
    foreach($questions as $question){
        $question = new Question($question);
        $question->opRandom();
        // $question.attempt($attempt[$i]);
        $body['question']=$question->st;
        $body['option1']=$question->options[0]->st;
        $body['option2']=$question->options[1]->st;
        $body['option3']=$question->options[2]->st;
        $body['option4']=$question->options[3]->st;
        $body['marked option']='option'.$attempt[$i];
        // var_dump($body);
        $i++;
        $result['result'][]=$body;
    }
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