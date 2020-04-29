<?php
require('receiver_header.php');
require('library.php');
function set(){
    $valid = checkSet(['key','username']);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
}

function validateKey($key){
    if($key!=key){
        $result['status']='FAIL';
        $result['comment']="incorrect key: $key";
        echo json_encode($result);
        exit();
    }
}

function validateUser($username){
    $query = "SELECT id FROM teacher 
    WHERE username=?  AND isActive='1' LIMIT 1";
    $q = new Query($query,"s");
    $q->execute([$username]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect username: $username";
        echo json_encode($result);
        exit();
    }
    return $exist[0]['id'];
}
try{
    Query::init();
    // $_GET['key']=key;
    // $_GET['username']="BB";
    set();
    $input = (object)($_GET);
    validateKey($input->key);
    $tid = validateUser($input->username);
    $query = "SELECT subject.id AS id,
    subject.subjectCode AS code,
    subject.paperName AS name 
    FROM subject INNER JOIN subject_under_teacher 
    ON subject.id = subject_under_teacher.subjectID 
    WHERE subject_under_teacher.teacherId=? AND subject.isActive ='1'";

    $q = new Query($query,"i");
    $q->execute([$tid]);
    $body = $q->data();
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