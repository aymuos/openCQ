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
function checkvValid($key,$id){
    if($id==""){
        return [0,"incorrect $key: $id"];
    }
    for($i=0;$i<strlen($id);$i++){
        $c = $id[$i];
        $ass = ord($c);
        // echo "$ass\n";
        if($ass<48 || $ass>57){
            return [0,"incorrect $key: $id"];
        }

    }
    return [1,""];
}

// $_GET['key']=key;
// $_GET['teacherId']="2";
// $_GET['subjectId']="2";

$valid = checkSet(['key','teacherId','subjectId']);
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

$valid = checkvValid('teacherId',$input->teacherId);

if($valid[0]==0){
    $result['status']='FAIL';
    $result['comment']=$valid[1];
    echo json_encode($result);
    exit();
}

if($input->subjectId!="ALL"){
    $valid = checkvValid('subjectId',$input->subjectId);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
}


try{
    Query::init();

    $query = "SELECT id
    FROM teacher
    WHERE id=? AND isActive='1' LIMIT 1";

    $q = new Query($query,"i");
    $q->execute([$input->teacherId]);
    $exist = $q->data();
    if(!$exist){
        $result['status']='FAIL';
        $result['comment']="incorrect teacherId: $input->teacherId";
        echo json_encode($result);
        exit();
    }
    if($input->subjectId!="ALL"){
        $query = "SELECT id FROM subject 
        WHERE id=? AND isActive='1' LIMIT 1";

        $q = new Query($query,"i");
        $q->execute([$input->subjectId]);
        $exist = $q->data();
        if(!$exist){
            $result['status']='FAIL';
            $result['comment']="incorrect subjectId: $input->subjectId";
            echo json_encode($result);
            exit();
        }

        $query = "SELECT subjectID 
        FROM subject_under_teacher
        WHERE subjectID=? AND teacherId=? LIMIT 1";

        $q = new Query($query,'ii');
        $q->execute([$input->subjectId,$input->teacherId]);
        $exist = $q->data();
        if(!$exist){
            $result['status']='FAIL';
            $result['comment']="teacher $input->teacherId has not undertaken subject $input->subjectId";
            echo json_encode($result);
            exit();
        }

    }

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