<?php
require('receiver_header.php');
require('library.php');
$dcm = 0;
$dwm = 0;
function set(){
    $valid = checkSet(['key','username','password','category','examId'],1);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
}
function validateCat(){
    $cat = $_POST['category'];
    if($cat!='0' && $cat!='1'){
        $result['status']='FAIL';
        $result['comment']="incorrect category: $cat";
        echo json_encode($result);
        exit();
    }
}

function validateUser(){
    $cat = $_POST['category'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $table = ($cat==0)?"coe":"teacher";
    $query = "SELECT id FROM $table WHERE username=? AND password=? AND 
    isActive='1' LIMIT 1";
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

function validateExam($teacher=0){
    $exam = $_POST['examId'];
    $cat = $_POST['category'];
    if($cat=='0'){
        $query = "SELECT id,subjectID FROM exam WHERE id=? AND isCoeVisible='1' LIMIT 1";
        $q = new Query($query,"i");
        $q->execute([$exam]);
        $exist = $q->data();
        if(!$exist){
            $result['status']='FAIL';
            $result['comment']="incorrect examId: $exam";
            echo json_encode($result);
            exit();
        }
        return $exist[0]['subjectID'];
    }
    else{
        $query = "SELECT id,subjectID,defaultCorrectMarks,defaultWrongMarks FROM exam WHERE id=? AND isTeacherVisible='1' AND 
        teacherId=? LIMIT 1";
        $q = new Query($query,"ii");
        $q->execute([$exam,$teacher]);
        $exist = $q->data();
        if(!$exist){
            $result['status']='FAIL';
            $result['comment']="incorrect examId: $exam";
            echo json_encode($result);
            exit();
        }
		global $dcm;
		global $dwm;
		$dcm = $exist[0]['defaultCorrectMarks'];
		$dwm = $exist[0]['defaultWrongMarks'];
        return $exist[0]['subjectID'];
    }
}

try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="grey";
    // $_POST['password']="umbrella";
    // $_POST['category']="0";
    // $_POST['examId']="6";
    set();
    $input = (object)($_POST);
    validateKey($input->key);
    validateCat();
    $teacher = validateUser();
    $subject = validateExam($teacher);
    $query = "SELECT subjectCode,paperName FROM subject WHERE id=?";
    $q= new Query($query,"i");
    $q->execute([$subject]);
    $sub = $q->data();

    $query = "SELECT question.id AS qid,
    chapter.id AS cid,
    chapter.name AS cname,
    exam_questions.marks_when_correct AS marks_when_correct, 
    exam_questions.marks_when_wrong AS marks_when_wrong 
    FROM exam_questions INNER JOIN question 
    ON exam_questions.questionId = question.id INNER JOIN 
    chapter ON question.chapterId = chapter.id WHERE exam_questions.examId=?";

    $q = new Query($query,"i");
    $q->execute([$input->examId]);
    $info = $q->data();

    $result['status']="OK";
    $result['result']=[];
    foreach($info as $value){
        $body['id']=$value['qid'];
		$body['default correct marks'] = $dcm;
		$body['default wrong marks'] = $dwm;
        $body['marks when correct']=$value['marks_when_correct'];
        $body['marks when wrong']=$value['marks_when_wrong'];
        $question = new Question($value['qid']);
        $body['problemStatement']=$question->st;
        $body['correctOption'] = $question->correct()[0]->st;
        $incorrect = $question->incorrect();
        $body['incorrectOption1']=$incorrect[0][0]->st;
        $body['incorrectOption2']=$incorrect[1][0]->st;
        $body['incorrectOption3']=$incorrect[2][0]->st;
        $body['chapterId']=(int)$value['cid'];
        $body['chapterName']=$value['cname'];
        $body['code']=$sub[0]['subjectCode'];
        $body['paperName']=$sub[0]['paperName'];
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