<?php
require('receiver_header.php');
require('library.php');

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

function validateCodes($codes){
    if(!$codes){
        $result['status']='FAIL';
        $result['comment']="empty array of codes";
        echo json_encode($result);
        exit();
    }
    $arr = [];
    $types="";
    foreach($codes as $value){
        $arr[]="?";
        $types=$types."s";
    }
    $clause = implode(",",$arr);
    $query = "SELECT id,subjectCode FROM subject WHERE subjectCode 
    IN ($clause) AND isActive='1'";
    // exit($query);
    $q = new Query($query,$types);
    $q->execute($codes);
    $info = $q->data();
    $result = [];
    $check = [];
    foreach($info as $row){
        $result[]=$row['id'];
        $check[]=$row['subjectCode'];
    }
    $valid = array_diff($codes,$check);
    if($valid){
        $fail = $valid[0];
        $result['status']='FAIL';
        $result['comment']="incorrect code: $fail";
        echo json_encode($result);
        exit();
    }
    return $result;
}


try{
    Query::init();
    $_POST = json_decode(file_get_contents('php://input'),TRUE);
    // $_POST['key']=key;
    // $_POST['username']="BB";
    // $_POST['password']="AtoZ";
    // $_POST['codes']=["MU250","MU250","MU250"];
    $valid = checkSet(['key','username','password','codes'],1);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
    $input = (object)($_POST);
    $teacher = validateUser($input->username,$input->password);
    $subjects = validateCodes($input->codes);
    $clause = [];
    $types = "";
    $inArr = [];
    foreach($subjects as $subject){
        $inArr[]=$subject;
        $inArr[]=$teacher;
        $types = $types."ii";
        $clause[]="(?,?)";
    }
    $clause = implode(",",$clause);
    $query = "INSERT IGNORE INTO subject_under_teacher(subjectID,teacherId) 
    VALUES $clause";
    // exit($query);
    $q = new Query($query,$types);
    $q->execute($inArr);
    $result['status']='OK';
    $result['comment']='subjects have been added to the teacher';
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