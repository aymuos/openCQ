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

class ExamQuestion{
    public $questionId;
    public $marks_when_correct;
    public $marks_when_wrong;
    public function __construct($id,$marks_when_correct,$marks_when_wrong){
        $this->questionId = $id;
        $this->marks_when_correct = $marks_when_correct;
        $this->marks_when_wrong = $marks_when_wrong;
    }
}

try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="black";
    // $_POST['password']="root";
    // $_POST['examId']="7";
    set();
    $input = (object)($_POST);
    $stid = validateUser();

    validateExam($input->examId);
    $seed = validateParticipation($stid);
    mt_srand($seed);
    $query = "SELECT questionId,marks_when_correct,marks_when_wrong FROM exam_questions WHERE examId=? ORDER BY questionId";
    $q = new Query($query,"i");
    $q->execute([$input->examId]);
    $data = $q->data();
    $questions = [];
    foreach($data as $row){
        $questions[]=new ExamQuestion($row['questionId'],$row['marks_when_correct'],$row['marks_when_wrong']);
    }
    shuffle($questions);
    $result['status']='OK';
    $result['result']=[];
    
    $attempt = getAttempt($stid,$input->examId);
    // $attempt = "0000000000";
    $i=0;
    foreach($questions as $question){
        $questionData = new Question($question->questionId);
        $questionData->opRandom();
        // $question.attempt($attempt[$i]);
        // $body['id']=$question->questionId;
        $body['question']=$questionData->st;
        $body['option1']=$questionData->options[0]->st;
        $body['option2']=$questionData->options[1]->st;
        $body['option3']=$questionData->options[2]->st;
        $body['option4']=$questionData->options[3]->st;
        $body['marked option']='option'.$attempt[$i];
        $body['marks when correct']=$question->marks_when_correct;
        $body['marks when wrong']=$question->marks_when_wrong;
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