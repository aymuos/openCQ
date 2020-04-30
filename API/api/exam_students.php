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
function validateExam($id){
    $query = "SELECT id FROM
    exam WHERE id=?  AND isActive='1' LIMIT 1";
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

function table(){
    $examId = $_POST['examId'];
    if($examId!="ALL"){
        $table = "marksheet INNER JOIN student ON marksheet.studentId=student.Id";
    }
    else{
        $table = "exam 
        INNER JOIN marksheet ON exam.id=marksheet.examId 
        INNER JOIN student ON marksheet.studentId=student.Id";
    }
    return $table;
}

function selection(){
    $examId = $_POST['examId'];
    if($examId!="ALL"){
        $select = "student.username,
        student.name,
        student.joiningYear,
        student.passOutYear,
        student.email,
        student.registration,
        student.contactNo,
        student.departmentCode,
        marksheet.submitted
        ";
    }
    else{
        $select = "exam.id,
        student.username,
        student.name,
        student.joiningYear,
        student.passOutYear,
        student.email,
        student.registration,
        student.contactNo,
        student.departmentCode,
        marksheet.submitted
        ";
    }
    return $select;
}

function clause(){
    $examId = $_POST['examId'];
    $clause="";
    $types = "";
    $inArr = [];
    if($examId!="ALL"){
        $clause="marksheet.examId=?";
        $types=$types."i";
        $inArr[]=$examId;
        return [$clause,$types,$inArr];
    }
    else{
        $clause="exam.isActive='1'";
        return [$clause,$types,$inArr];
    }
}

try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="root";
    // $_POST['password']="shoot";
    // $_POST['examId']="3";
    set();
    validateUser();
    $input = (object)($_POST);
    if($input->examId!="ALL"){
        validateExam($input->examId);
    }
    $table = table();
    $select = selection();
    
    $clause = clause();
    $types = $clause[1];
    $inArr = $clause[2];
    $clause = $clause[0];
    $query = "SELECT $select FROM $table WHERE $clause";
    //  exit($query);
    $q = new Query($query,$types);
    $q->execute($inArr);
    $data = $q->data();
    // var_dump($data);
    $result['status']='OK';
    $result['result']=[];
    foreach($data as $row){
        $body['examId']=($input->examId!="ALL")?$input->examId:$row['id'];
        $body['username']=$row['username'];
        $body['name']=$row['name'];
        $body['stream']=$row['departmentCode'];
        $body['joiningYear']=$row['joiningYear'];
        $body['batchPassoutYear']=$row['passOutYear'];
        $body['email']=$row['email'];
        $body['registration']=$row['registration'];
        $body['contactNumber']=$row['contactNo'];
        $body['submitted']=$row['submitted'];
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