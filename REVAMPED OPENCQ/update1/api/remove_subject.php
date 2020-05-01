<?php
require('receiver_header.php');
require('library.php');
function set(){
    $valid = checkSet(['key','username','password','code'],1);
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
    $query = "SELECT id FROM teacher 
    WHERE username=? AND password=? AND isActive='1' LIMIT 1";
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
        $query = "DELETE FROM subject_under_teacher WHERE subjectID=? AND teacherId=?";
        $q = new Query($query,"ii");
        $q->execute([$subject,$user]);
        $exist = $q->affected();
        $input = (object)$_POST;
        if($exist===0){
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

try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="BB";
    // $_POST['password']="AtoZ";
    // $_POST['code']="CS502";
    set();

    $input = (object)($_POST);
    validateKey($input->key);
    $tid = validateUser($input->username,$input->password);
    $sid = validateCode($input->code);
    validateAllocation($sid,$tid);
    $result['status']='OK';
    $result['comment']='subject has been removed from the teacher';
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