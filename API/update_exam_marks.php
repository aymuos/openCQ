<?php
require('receiver_header.php');
require('library.php');

function set(){
    $valid = checkSet(['key','username','password','questions','examId','code','defaultCorrect','defaultWrong'],1);
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

function caseBuild(){
    $carr = [];
    $warr = [];
    $ctypes = "";
    $wtypes = "";
    $arr = $_POST['questions'];
    $case = "CASE questionId\n";
    $cond_correct = "";
    $cond_wrong = "";
    foreach ($arr as  $value) {
        $cond_correct.="WHEN ? THEN ?\n";
        $ctypes .= "id";
        $carr[]=$value[0];
        $carr[]=$value[1];
        
        $cond_wrong.="WHEN ? THEN ?\n";
        $wtypes .= "id";
        $warr[]=$value[0];
        $warr[]=$value[2];
    }
    $cond_correct.="ELSE 1\nEND\n";
    $cond_wrong.="ELSE 0\nEND\n";
    return 
        [
            'cond_correct'=>"\n".$case.$cond_correct,
            'cond_wrong'=>"\n".$case.$cond_wrong,
            'ctypes'=>$ctypes,
            'carr'=>$carr,
            'wtypes'=>$wtypes,
            'warr'=>$warr
        ];
}

try{

    Query::init();
    //  $_POST['key']=key;
    //  $_POST['username']="orange";
    //  $_POST['password']="root";
    //  $_POST['examId']="4";
    //  $_POST['code']="BS(CS)306";
    // $_POST['questions']=[[1,1,0],[2,1,-1],[3,1,-2],[4,1,-2]];
    
    
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
	
	$dwm = $_POST['defaultCorrect'];
	$dcm = $_POST['defaultWrong'];
	
	
	$query = "UPDATE exam SET defaultCorrectMarks=$dwm, defaultWrongMarks=$dcm WHERE id = ?";
	$q = new Query($query,"i");
    $q->execute([$_POST['examId']]);
	
	
    $cases = (object)caseBuild();
    $query = "UPDATE exam_questions SET marks_when_correct=$cases->cond_correct, marks_when_wrong=$cases->cond_wrong WHERE examId = ?";
    $types = $cases->ctypes.$cases->wtypes."i";
    $inarr = array_merge($cases->carr,$cases->warr,[$_POST['examId']]);
    $q = new Query($query,$types);
    $q->execute($inarr);
    $reult['status']='OK';
    $reult['comment']='marks have been updated';
    echo json_encode($reult);
    // echo "..............Query..................\n";
    // echo $query."\n";
    // echo "..............Types..................\n";
    // echo "$types\n";
    // echo "..............inarr..................\n";
    // var_dump($inarr);
    // try{
    //         Query::tStart();
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
// UPDATE exam_questions
// SET marks_when_correct = 
// CASE questionId
// WHEN 1 THEN 10
// WHEN 2 THEN 20
// WHEN 3 THEN 30
// WHEN 4 THEN 40
// ELSE 1
// END 
// , marks_when_wrong =
// CASE questionId
// WHEN 1 THEN -10
// WHEN 2 THEN -0.5
// WHEN 3 THEN -10.6
// WHEN 4 THEN -30.9
// ELSE 0
// END
// WHERE examId=4;
?>
