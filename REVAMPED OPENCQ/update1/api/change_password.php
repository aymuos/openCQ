<?php
require('library.php');
require('receiver_header.php');
function checkvValid($parameter){
    foreach($parameter as $key=>$regex){
        $value = $_POST["$key"];
        if(preg_match($regex,$value)){
            ;
        }
        else{
            return [0,"incorrect $key: $value"];
        }
    }
    return [1,""];
}
// $_POST['key']=key;
// $_POST['username']="superninja";
// $_POST['old_password']="superuser";
// $_POST['new_password']="rootuser";
// $_POST['category']="0";

$valid = checkSet(['key','username','old_password','new_password','category'],1);

if($valid[0]==0){
    $result['status']="FAIL";
    $result['comment']=$valid[1];
    echo json_encode($result);
    exit();
}

$key = $_POST['key'];
$user = $_POST['username'];
$old = $_POST['old_password'];
$new = $_POST['new_password'];
$catg = $_POST['category'];


if($_POST['key']!=key){
    $result['status']="FAIL";
    $result['comment']="incorrect key: $key";
    echo json_encode($result);
    exit();
}
$parameter['category']='/^(0|1|2)$/';

$valid = checkvValid($parameter);

if($valid[0]==0){
    $result['status']="FAIL";
    $result['comment']=$valid[1];
    echo json_encode($result);
    exit();
}

try{
    Query::init();
    $table="";
    if($catg=='0'){
        $table = "coe";
    }
    else if($catg=='1'){
        $table = "teacher";
    }
    else if($catg=='2'){
        $table="student";
    }

    $query = "SELECT username,password FROM $table 
    WHERE username=? AND isActive='1' LIMIT 1";
    $q = new Query($query,"s");
    $q->execute([$user]);
    $data = $q->data();
    if(!$data){
        $result['status']='FAIL';
        $result['comment']="incorrect username: $user";
        echo json_encode($result);
        exit();
    }
    $password = $data[0]['password'];
    if($password!=$old){
        $result['status']='FAIL';
        $result['comment']="incorrect old password";
        echo json_encode($result);
        exit();
    }

    $query = "UPDATE $table SET password=?
    WHERE username=? AND isActive='1'";

    $q = new Query($query,"ss");
    $q->execute([$new,$user]);
    $result['status']='OK';
    $result['comment']="password updated successfully";
    echo json_encode($result);
    // exit();

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