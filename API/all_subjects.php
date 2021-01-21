<?php
require('library.php');
require('receiver_header.php');
// $_GET['key']=key;

$valid = checkSet(['key']);

if($valid[0]==0){
    $result['status']='FAIL';
    $result['comment']=$valid[1];
    echo json_encode($result);
    exit();
}
$input = (object)($_GET);

if($input->key!=key){
    $result['status']='FAIL';
    $result['comment']="incorrect key: $input->key";
    echo json_encode($result);
    exit();
}

try{
    Query::init();
    
    $query = "SELECT 
    id,subjectCode AS code, 
    paperName AS name 
    from subject
    WHERE isActive='1'";

    $q = new Query($query);
    $q->execute();
    $subject = $q->data();

    $result['status']='OK';
    $result['result']=$subject;
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