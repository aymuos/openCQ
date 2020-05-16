<?php
require('receiver_header.php');
require('library.php');

function set(){
    $valid = checkSet(['key','username','password','batchPassoutYear','stream','code','description'],1);
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
function validateUser($username,$password){
    $query = "SELECT id FROM teacher WHERE username=? AND password=?
    AND isActive='1'";
    $q = new Query($query,"ss");
    $q->execute([$username,$password]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect username/password: $username";
        echo json_encode($result);
        exit();
    }
    return $exist[0]['id'];
}
function validateCode($code){
    $query= "SELECT id FROM subject 
    WHERE subjectCode=? AND isActive='1' LIMIT 1";
    $q = new Query($query,"s");
    $q->execute([$code]);
    $exist=$q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect code: $code";
        echo json_encode($result);
        exit();
    }
    return $exist[0]['id'];
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

function validateBatch($batch){
    $parameter['batchPassoutYear']=$batch;
    $valid = checkValid($parameter);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
    // exit($batch);
    // echo strlen($batch)."\n";
    // echo $batch[0]."\n";
    // exit($batch[1]);
    if(strlen($batch)!=4 || ($batch[0]!='2' || $batch[1]!='0')){
        $result['status']='FAIL';
        $result['comment']="incorrect batchPassoutYear: $batch";
        echo json_encode($result);
        exit();
    }
}

function validateStream($stream){
    switch ($stream) {
        case '1':
            return ["CSE"];
            break;
        case '2':
            return ["IT"];
            break;
        case '3':
            return ["CSE","IT"];
            break;
        case '4':
            return ["CT"];
            break;
        case '5':
            return ["CSE","CT"];
            break;
        case '6':
            return ['IT','CT'];
            break;
        case '7':
            return ['CSE','IT','CT'];
            break;    
        default:
            $result['status']='FAIL';
            $result['comment']="incorrect stream: $stream";
            echo json_encode($result);
            exit();
            break;
    }
}
try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="BB";
    // $_POST['password']="AtoZ";
    // $_POST['description']="test exam 1";
    // $_POST['batchPassoutYear']="2011";
    // $_POST['stream']="6";
    // $_POST['code']="MU250";
    set();
    $input = (object)($_POST);
    validateKey($input->key);
    validateBatch($input->batchPassoutYear);
    $stream = validateStream($input->stream);
    $tid = validateUser($input->username,$input->password);
    $sid = validateCode($input->code);
    validateAllocation($sid,$tid);
    $time = time();
    $query = "INSERT INTO exam(
        createTime,
        startTime,
        desciption,
        batchPassoutYear,
        streamCodeNumber,
        isCoeVisible,
        isTeacherVisible,
        isActive,
        subjectID,
        teacherID) 
        VALUES (?,0,?,?,?,'0','1','0',?,?)";
    $q = new Query($query,"isssii");
    $q->execute([$time,$input->description,$input->batchPassoutYear,$input->stream,$sid,$tid]);
    $id = $q->insertId();
    $body=[array('id' => $id )];
    $result['status']='OK';
    $result['result']=$body;
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