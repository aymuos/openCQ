<?php
require('library.php');
require('receiver_header.php');

// $_POST['key']=key;
// $_POST['chapterId']="2";
// $_POST['code']="CS502";
// $_POST['username']="GCECT/F/0012";
// $_POST['password']="452";
// $_POST['questionId']="2";

function apiValidation(){
    $valid = checkSet(['key','questionId','chapterId','code','username','password'],1);
    if($valid[0]==0){
        return $valid;
    }
    $input = (object)($_POST);
    if($input->key!=key){
        return [0,"incorrect key: $input->key"];
    }
    $parameter['questionId']=$input->questionId;
    $parameter['chapterId']=$input->chapterId;
    $valid = checkValid($parameter);
    if($valid[0]==0){
        return $valid;
    }
    try{

        $query = "SELECT id FROM teacher WHERE 
        username=? AND password=? AND isActive='1'";
        $q = new Query($query,"ss");
        $q->execute([$input->username,$input->password]);
        $exist = $q->data();
        if(!$exist){
            return [0,("incorect username/password: $input->username")];
        }
        $tid = $exist[0]['id'];
        $query = "SELECT id FROM subject WHERE 
        subjectCode=? AND isActive='1'";
        $q = new Query($query,"s");
        $q->execute([$input->code]);
        $exist = $q->data();
        if(!$exist){
            return [0,"incorrect code: $input->code"];
        }
        $sid = $exist[0]['id'];
        $query = "SELECT subjectID FROM subject_under_teacher
        WHERE subjectID=? AND teacherId=?";
        $q = new Query($query,"ii");
        $q->execute([$sid,$tid]);
        $exist = $q->data();
        if(!$exist){
            return [0,"teacher $input->username has not undertaken subject $input->code"];
        }
        $query = "SELECT id FROM chapter WHERE 
        id=? AND subjectID=? AND teacherId=? AND isActive='1'";
        $q = new Query($query,"iii");
        $q->execute([$input->chapterId,$sid,$tid]);
        $exist = $q->data();
        if(!$exist){
            return [0,"incorrect chapterId: $input->chapterId"];
        }

        $query = "SELECT id FROM question WHERE 
        id=? AND chapterId=? AND isActive='1'";
        $q = new Query($query,"ii");
        $q->execute([$input->questionId,$input->chapterId]);

        $exist = $q->data();
        if(!$exist){
            return [0,"incorrect questionId: $input->questionId"];
        }

        return [1,""];
    }
    catch(Exception $e){
        throw $e;
    }
}

// function checkValid($parameter){
//     foreach($parameter as $key=>$regex){
//         $value = $_POST["$key"];
//         if(preg_match($regex,$value)){
//             ;
//         }
//         else{
//             return [0,"incorrect $key: $value"];
//         }
//     }
//     return [1,""];
// }




// var_dump(checkValid(""));
// exit();

// $valid = checkSet(['key','questionId']);

// if($valid[0]==0){
//     $result['status']='FAIL';
//     $result['comment']="$valid[1]";
//     echo json_encode($result);
//     exit();
// }

// $valid = checkValid($_GET['questionId']);
// // var_dump($valid);
// if($valid[0]==0){
//     $result['status']='FAIL';
//     $result['comment']=$valid[1];
//     echo json_encode($result);
//     exit();
// }



// $input = (object)($_GET);



// if($_GET['key']!=key){
//     $result['status']='FAIL';
//     $result['comment']="incorrect key: $input->key";
//     echo json_encode($result);
//     exit();
// }



try{
    Query::init();
    $valid = apiValidation();
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
    // $valid = apiValidation()
    // echo $input->questionId;
    // $query = "SELECT id FROM question 
    // WHERE id=? AND isActive='1' LIMIT 1";
    
    // $q = new Query($query,"i");
    // $q->execute([$input->questionId]);
    // if(!$q->data()){
        //     $result['status']='FAIL';
        //     $result['comment']="incorrect questionId: $input->questionId";
        //     echo json_encode($result);
        //     exit();
        // }
        
        
        
        try{
                Query::tStart();
                $query = "UPDATE question SET isActive='0'
                WHERE id=?";
                $input = (object)$_POST;
                $q = new Query($query,"i");
                $q->execute([$input->questionId]);
                $query = "UPDATE chapter SET noOfQues= noOfQues - 1 WHERE id=?";
                $q = new Query($query,"i");
                $q->execute([$input->chapterId]);
                $result['status']='OK';
                $result['comment']='question is deleted';
                echo json_encode($result);
                Query::tStop();
            }
            catch(Exception $e){
                Query::tRoll();
                throw $e;
            }
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