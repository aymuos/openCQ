<?php
require('receiver_header.php');
require('library.php');

function set(){
    $valid = checkSet(['key','username','password','examId','stream'],1);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
}
function validateStream(){
    $stream = $_POST['stream'];
    // echo $stream."\n";
    if($stream != "CSE" && $stream!="IT" && $stream!="CT"){
        $result['status']='FAIL';
        $result['comment']="incorrect stream: $stream";
        echo json_encode($result);
        exit();
    }
}
function validateExam($id){
    $query = "SELECT isActive FROM
    exam WHERE id=?  AND isActive = '4' LIMIT 1";
    $q = new Query($query,"i");
    $q->execute([$id]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect examId: $id";
        echo json_encode($result);
        exit();
    }
}
function validateUser(){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $query = "SELECT id FROM coe WHERE username=? AND password=? AND isActive='1' 
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

}

try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="root";
    // $_POST['password']="shoot";
    // $_POST['stream']="ALL";
    // $_POST['examId']="3";
    set();
    $input = (object)($_POST);
    validateUser();
    validateExam($input->examId);
    if($input->stream!="ALL"){
        validateStream();
    }
    $table = "marksheet INNER JOIN student ON marksheet.studentId=student.id";
    $caluse = "marksheet.examId=?";
    $types = "i";
    $inArr = [$input->examId];
    $select = "student.username,
    student.username,
    student.name,
    student.joiningYear,
    student.passOutYear,
    student.email,
    student.registration,
    student.contactNo,
    marksheet.marks
    " ;
    if($input->stream!="ALL"){
        $caluse = $caluse." AND student.departmentCode=?";
        $types = $types."s";
        $inArr[]=$input->stream; 
    }
    else{
        $select = $select.",student.departmentCode";
    }
    

    $query = "SELECT $select FROM $table WHERE $caluse";
    $q = new Query($query,$types);
    $q->execute($inArr);
    $data = $q->data();
    $result['status']='OK';
    $result['result']=[];
    foreach($data as $row){
        $body['username']=$row['username'];
        $body['name']=$row['name'];
        $body['stream']=($input->stream!="ALL")?$input->stream:$row['departmentCode'];
        $body['joiningYear']=$row['joiningYear'];
        $body['batchPassoutYear']=$row['passOutYear'];
        $body['email']=$row['email'];
        $body['registration']=$row['registration'];
        $body['contactNumber']=$row['contactNo'];
        $body['marks']=$row['marks'];
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