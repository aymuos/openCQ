<?php
require('receiver_header.php');
require('library.php');

function set(){
    $valid = checkSet(['key','username','examStatus','examId','code','batchPassoutYear',
    'stream','visible']);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
}

function validityStatus(){
    $status = $_GET['examStatus'];
    if($status != "ALL"){

        if($status!="0" && $status!="1" && $status!="2" && $status!="3" && $status!="4"){
            $result['status']='FAIL';
            $result['comment']="incorrect examStatus: $status";
            echo json_encode($result);
            exit();
        }
    }
}

function validityUser(){

    $user = $_GET['username'];
    if($user!="ALL"){

        $query = "SELECT id,name FROM teacher WHERE username=? ORDER BY id DESC LIMIT 1";
        $q = new Query($query,"s");
        $q->execute([$user]);
        $exist = $q->data();
        if(!$exist){
            $result['status']='FAIL';
            $result['comment']="incorrect username: $user";
            echo json_encode($result);
            exit();
        }
        $GLOBALS['nameOfTheTeacher']=$exist[0]['name'];
        return $exist[0]['id'];
    }
    return "ALL";
}
function validityCode(){
    $code = $_GET['code'];
    if($code!="ALL"){
        $query = "SELECT id,paperName FROM subject WHERE subjectCode=? ORDER BY id DESC LIMIT 1";
        $q = new Query($query,"s");
        $q->execute([$code]);
        $exist = $q->data();
        if(!$exist){
            $result['status']='FAIL';
            $result['comment']="incorrect code: $code";
            echo json_encode($result);
            exit();
        }
        $GLOBALS['paperName']=$exist[0]['paperName'];
        return $exist[0]['id'];
    }
    return "ALL";
}

function validateBatch($batch){
    if($batch=="ALL"){
        return;
    }
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
function validateVisible(){
    $v = $_GET['visible'];
    if($v<0 || $v>1){
        $result['status']='FAIL';
        $result['comment']="incorrect visible: $v";
        echo json_encode($result);
        exit();
    }
}
function validateStream($stream){
    if($stream=="ALL"){
        return;
    }
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

function decodeStime($stime){
    return ($stime===0)?"not started":$stime;
}

function decodeStatus($status){
    switch ($status) {
        case '0':
            return "created";
            break;
        case '1':
            return "live";
            break;
        case '2':
            return "submitted";
            break;
        case '3':
            return "ended(results have not been updated)";
            break;
        case '5':
            return "ended(results have been updated)";
            break;
    }
}
try{
    Query::init();
    // $_GET['key']=key;
    // $_GET['username']="ALL";
    // $_GET['examStatus']="ALL";
    // $_GET['examId']="ALL";
    // $_GET['batchPassoutYear']="ALL";
    // $_GET['stream']="ALL";
    // $_GET['code']="ALL";
    // $_GET['visible']="ALL";
    set();
    $input =(object)($_GET);
    validateKey($input->key);
    $user = validityUser();
    $sub = validityCode();
    validateBatch($input->batchPassoutYear);
    validateStream($input->stream);
    if($input->visible!="ALL"){
        validateVisible();
    }
    $types="";
    $inArr=[];
    $table = "exam";
    $selection = "
    exam.id AS eid,
    exam.createTime AS ctime,
    exam.startTime AS stime,
    exam.desciption AS des,
    exam.batchPassOutYear AS bpy,
    exam.streamCodeNumber AS stream,
    exam.isActive AS status";
    if($input->examId != "ALL"){
        $exam = "?";
        $types= $types."i";
        $inArr[]=$input->examId;
    }
    else{
        $exam = "exam.id";

    }
    if($input->examStatus!="ALL"){
        $status = "?";
        $types = $types."s";
        $inArr[]=$input->examStatus;
    }
    else{
        $status = "exam.isActive";
    }
    if($input->code!="ALL"){
        $sid = '?';
        $types = $types."i";
        $inArr[]=$sub;
    }
    else{
        $sid = 'exam.subjectID';
        $table = $table." INNER JOIN subject ON exam.subjectID=subject.id";
        $selection = $selection.",subject.subjectCode AS code,subject.paperName AS paperName ";
    }
    if($input->username!="ALL"){
        $uid = '?';
        $types = $types."i";
        $inArr[]=$user;
    }
    else{
        $uid = 'exam.teacherID';
        $table = $table." INNER JOIN teacher ON exam.teacherID=teacher.id"; 
        $selection = $selection.",teacher.username AS user,teacher.name AS name ";
    }

    if($input->batchPassoutYear!="ALL"){
        $passout = '?';
        $types = $types."s";
        $inArr[]=$input->batchPassoutYear;
    }
    else{
        $passout = 'exam.batchPassOutYear';
    }
    if($input->stream!="ALL"){
        $stream = '?';
        $types = $types."s";
        $inArr[]=$input->stream;
    }
    else{
        $stream = 'exam.streamCodeNumber';
    }
    $query = "SELECT $selection FROM $table WHERE 
    exam.id=$exam AND exam.batchPassOutYear=$passout
    AND exam.streamCodeNumber=$stream AND
    exam.isActive=$status AND exam.subjectID = $sid AND exam.teacherID = $uid";
    if($input->visible=='0'){
        $query = $query." AND exam.isCoeVisible='1'";
    }
    else if($input->visible=='1'){
        $query = $query." AND exam.isTeacherVisible='1'";
    }
    $q = new Query($query,$types);
    $q->execute($inArr);
    $info = $q->data();
    if(!$info && $input->examId!="ALL"){
        $result['status']='FAIL';
        $result['comment']="incorrect examId: $input->examId";
        echo json_encode($result);
        exit();
    }
    $result['status']='OK';
    $result['result']=[];
    
    foreach($info as $row){
        $body['id']=$row['eid'];
        $body['created at']=$row['ctime'];
        $body['started at']=decodeStime($row['stime']);
        $body['description']=$row['des'];
        $body['batchPassoutYear']=$row['bpy'];
        $body['stream']=validateStream($row['stream']);
        $body['examStatus']=decodeStatus($row['status']);
        $body['code']=($input->code!="ALL")?$input->code:$row['code'];
        $body['paperName']=($input->code!="ALL")?$paperName:$row['paperName'];
        $body['createdBy']=($input->username!="ALL")?$input->username:$row['user'];
        $body['createdByName']=($input->username!="ALL")?$nameOfTheTeacher:$row['name'];
        $result['result'][]=$body;
    }
    echo json_encode($result);
    // var_dump($info);
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