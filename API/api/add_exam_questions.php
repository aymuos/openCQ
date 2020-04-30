<?php
require('receiver_header.php');
require('library.php');
function set(){
    $valid = checkSet(['key','username','password','questions','examId','code'],1);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
}
// function validateKey($key){
//     if($key!=key){
//         $result['status']='FAIL';
//         $result['comment']="incorrect key: $key";
//         echo json_encode($result);
//         exit();
//     }
// }
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

function validateChapters($combined,$sid,$tid){
    $chapters = [];
    foreach($combined as $pair){
        $chapters[]=$pair[0];
    }
    $clause=implode(',',array_fill(0,count($chapters),'?'));
    $types=str_repeat("i",count($chapters));
    $query = "SELECT id FROM chapter WHERE id in ($clause) AND subjectID = ? 
    AND teacherId=? AND isActive='1'";
    $types=$types."ii";
    $chapters[]=$sid;
    $chapters[]=$tid;
    $q = new Query($query,$types);
    $q->execute($chapters);
    $exist = $q->data();
    $ids = [];
    foreach($exist as $row){
        $ids[]=$row['id'];
    }
    array_pop($chapters);
    array_pop($chapters);
    $left = array_diff($chapters,$ids);
    if($left){
        $value = $left[0];
        $result['status']='FAIL';
        $result['comment']="incorrect chapterId: $value";
        echo json_encode($result);
        exit();
    }
}

function validateQuestions($combined){
    $questions = [];
    foreach($combined as $pair){
        $questions[]=$pair[1];
    }
    $clause=implode(',',array_fill(0,count($questions),'?'));
    $types=str_repeat("i",count($questions));

    $query = "SELECT chapterId,id FROM question WHERE id IN
    ($clause) AND isActive='1'";
    $q = new Query($query,$types);
    $q->execute($questions);
    $res = $q->stmt->get_result()->fetch_all(MYSQLI_NUM);
    
    $left = array_udiff($combined,$res,function($a,$b){
        if($a[0]===$b[0] && $a[1]===$b[1]){
            return 0;
        }
        else if($a[0]>$b[0]){
            return +1;
        }
        else if($a[0]===$b[0] && $a[1]>$b[1]){
            return +1;
        }
        else if($a[0]<$b[0]){
            return -1;
        }
        else{
            return -1;
        }
    });
    // var_dump($left);
    // exit();
    if($left){
        $left = array_values($left);
        $chapter = $left[0][0];
        $question = $left[0][1];
        $result['status']='FAIL';
        $result['comment']="invalid pair: ($chapter,$question)";
        echo json_encode($result);
        exit();
    }

}

try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="BB";
    // $_POST['password']="AtoZ";
    // $_POST['examId']="2";
    // $_POST['code']="OP780";
    // $_POST['questions']=[[6,8],[6,9],[7,10],[7,11]];
    $_POST = json_decode(file_get_contents('php://input'),TRUE);
    set();
    $input = (object)($_POST);
    validateKey($input->key);
    $result = validateExam($input->examId);
    $sid = $result[0];
    $tid = $result[1];
    validateSubject($sid);
    validateUser($tid);
    validateAllocation($sid,$tid);
    validateChapters($input->questions,$sid,$tid);
    validateQuestions($input->questions);
    $clause = implode(',',array_fill(0,count($input->questions),'(?,?)'));
    $types = str_repeat('ii',count($input->questions));
    $inArr = [];
    foreach($input->questions as $pair){
        $inArr[]=$input->examId;
        $inArr[]=$pair[1];
    }
    $query = "INSERT IGNORE INTO exam_questions(examId,questionId) VALUES $clause";
    $q = new Query($query,$types);
    $q->execute($inArr);
    $reult['status']='OK';
    $reult['comment']='questions are added to the exam';
    echo json_encode($reult);
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