<?php
require('library.php');
require('receiver_header.php');
function queryBuild($input){
    $arr = [];
    $types=[];
    $query = "SELECT 
    id,
    name,
    noOfQues AS numberOfQuestions,
    subjectID AS subjectId
    FROM chapter";
    if($input->subjectId!="ALL"){
        $query = $query." WHERE subjectID=? AND teacherId=? AND isActive='1'";
        $types = "ii";
        $arr = [$input->subjectId,$input->teacherId];
    }
    else{
        $query = $query." WHERE teacherId=? AND isActive='1'";
        $types = "i";
        $arr = [$input->teacherId];
    }
    return [$query,$types,$arr];
}


// $_GET['key']=key;
// $_GET['username']="Ben TennySon";
// $_GET['code']="ALL";

$valid = checkSet(['key','username','code']);
if($valid[0]==0){
    $result['status']='FAIL';
    $result['comment']=$valid[1];
    echo json_encode($result);
    exit();
}

function validateUser(){
    $username = $_GET['username'];
    $query = "SELECT id FROM teacher WHERE username=? AND isActive='1'";
    $q = new Query($query,"s");
    $q->execute([$username]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect username/password: $username";
        echo json_encode($result);
        exit();
    }
    $tid = $exist[0]['id'];
    return $tid;
}

function validateCode(){
    $code = $_GET['code'];
    $query = "SELECT id FROM subject WHERE 
    subjectCode=? AND isActive='1'";
    $q = new Query($query,"s");
    $q->execute([$code]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect code: $code";
        echo json_encode($result);
        exit();
    }
    $sid = $exist[0]['id'];
    return $sid;
}

$input = (object)($_GET);

if($input->key!=key){
    $result['status']='FAIL';
    $result['comment']="incorrect key: $input->key";
    echo json_encode($result);
    exit();
}

function validateAllocation($sid,$tid){
    $username = $_GET['username'];
    $code = $_GET['code'];
    $query = "SELECT subjectID FROM subject_under_teacher
    WHERE subjectID=? AND teacherId=? LIMIT 1";
    $q = new Query($query,"ii");
    $q->execute([$sid,$tid]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="teacher $username has not undertaken subject $code";
        echo json_encode($result);
        exit();
    }
}





try{
    Query::init();
    $tid = validateUser();
    $sid = "ALL";
    if($input->code != "ALL"){
        $sid = validateCode();

        validateAllocation($sid,$tid);
    }
    $input->subjectId = $sid;
    $input->teacherId = $tid;

    $query= queryBuild($input);
    $q = new Query($query[0],$query[1]);
    $q->execute($query[2]);

    $info = $q->data();

    $result['status']='OK';
    $result['result']=$info;
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