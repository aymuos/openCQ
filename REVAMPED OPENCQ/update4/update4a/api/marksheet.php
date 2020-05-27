<?php
require('receiver_header.php');
require('library.php');
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

function set(){
    $valid = checkSet(['key','username','password','examId','category','studentUsername'],1);
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
    $category = $_POST['category'];
    if($category==0){
        $table = "coe";
    }
    else if($category==1){
        $table = "teacher";
    }
    else{
        $result['status']='FAIL';
        $result['comment']="incorrect category: $category";
        echo json_encode($result);
        exit();
    }
    $query = "SELECT id FROM $table WHERE username=? AND password=? AND isActive='1' 
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
    $_POST['tid']=$exist[0]['id'];
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
    $types = "i";
    $arr = [$id];
    $cat = $_POST['category'];
    $tid = $_POST['tid'];
    $query = "SELECT isActive FROM
    exam WHERE id=?  AND isActive IN ('3','4')";
    if($cat==1){
        $query = $query." AND teacherID=?";
        $types = $types."i";
        $arr[]=$tid;
    }
    $q = new Query($query,$types);
    $q->execute($arr);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect examId: $id";
        echo json_encode($result);
        exit();
    }
    return $exist[0]['isActive'];
}

function exam_questions(){
    $examId = $_POST['examId'];
    $query = "SELECT questionId,marks_when_correct,marks_when_wrong FROM exam_questions
    WHERE examId = ? ORDER BY questionId";
    $q = new Query($query,"i");
    $q->execute([$examId]);
    $data = $q->data();
    $questions = [];
    foreach($data as $row){
        $questions[]=new ExamQuestion($row['questionId'],$row['marks_when_correct'],$row['marks_when_wrong']);
    }
    return $questions;
}

function marksheetData($stid){
    $examId = $_POST['examId'];
    // echo $stid."\n";
    // echo $examId."\n";
    $query = "SELECT questionShuffle,attempts,marks FROM 
    marksheet WHERE examId=? AND studentId=?";
    $q = new Query($query,"ii");
    $q->execute([$examId,$stid]);
    $data = $q->data();
    // var_dump($data);
    return [$data[0]['questionShuffle'],$data[0]['attempts'],$data[0]['marks']];
}



try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="grey";
    // $_POST['password']="umbrella";
    // $_POST['category']="0";
    // $_POST['studentUsername']="black";
    // $_POST['examId']="7";
    set();
    $input = (object)($_POST);
    $stid = validateUser();
    $isActive = validateExam($input->examId);
    $questions = exam_questions();
    $rest = marksheetData($stid);
    mt_srand($rest[0]);
    $dbAttempt = $rest[1];
    $dbMark = $rest[2];
    $attempt = ($isActive=='4')?$dbAttempt:getAttempt($stid,$input->examId);
    shuffle($questions);
    $result['status']='OK';
    $result['result']=[];
    
    $i=0;
    $cm = 0;
    foreach($questions as $question){
        $questionData = new Question($question->questionId);
        $questionData->opRandom();
        // $question.attempt($attempt[$i]);
        $body['marks when correct']=$question->marks_when_correct;
        $body['marks when wrong']=$question->marks_when_wrong;
        $body['question']=$questionData->st;
        $body['option1']=$questionData->options[0]->st;
        $body['option2']=$questionData->options[1]->st;
        $body['option3']=$questionData->options[2]->st;
        $body['option4']=$questionData->options[3]->st;
        $body['markedOption']="option".$attempt[$i];
        $body['correctOption']="option".$questionData->correct()[1];
        if($body['markedOption']==$body['correctOption']){
            $body['status']="AC";
            $cm+=$question->marks_when_correct;
        }
        else{
            $body['status']="WA";
            if($attempt[$i]!='0') $cm+=$question->marks_when_wrong;
        }
        // var_dump($body);
        $i++;
        $result['result'][]=$body;
    }
    $result['marks']=$cm;
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