<?php
require('receiver_header.php');
require('library.php');

// $_POST['key']=key;
// $_POST['questionId']="ALL";
// $_POST['chapterId']="7";
// $_POST['code']="ALL";
// $_POST['username']="BB";
// $_POST['password']="AtoZ";
function validateQuestion($id){
    try{
        if($_POST['questionId']!="ALL" && $id!=$_POST['questionId']){
            $question = $_POST['questionId'];
            return [0,"incorrect questionId: $question"];
        }
        $query = "SELECT chapterId FROM question
        WHERE id=? AND isActive='1' LIMIT 1";
        $q = new Query($query,"i");
        $q->execute([$id]);
        $exist = $q->data();
        if(!$exist){
            $question = $_POST['questionId'];
            return [0,"incorrect questionId: $question"];
        }
        else{
            return [1,$exist[0]['chapterId']];
        }
    }
    catch(Exception $e){
        throw $e;
    }
}

function validateChapter($id){
    try{
        if($_POST['chapterId']!="ALL" && $id!=$_POST['chapterId']){
            $chapter = $_POST['chapterId'];
            return [0,"incorrect chapterId: $chapter"];
        }
        else{
            $query = "SELECT subjectID,teacherId,name FROM chapter WHERE id=? AND 
            isActive='1' LIMIT 1";
            $q = new Query($query,"i");
            $q->execute([$id]);
            $exist = $q->data();
            if(!$exist){
                $chapter = $_POST['chapterId'];
                if($chapter=="ALL"){
                    $question = $_POST['questionId'];
                    return [0,"incorrect questionId: $question"];
                }
                else{
                    return [0,"incorrect chapterId: $chapter"];
                }
            }
            else{
                return [1,[$exist[0]['subjectID'],$exist[0]['teacherId'],$exist[0]['name']]];
            }

        }
    }
    catch(Exception $e){
        throw $e;
    }
}

function validateSubject($id){
    try{
        $query = "SELECT subjectCode,paperName FROM subject WHERE id=? AND isActive='1' LIMIT 1";
        $q = new Query($query,"i");
        $q->execute([$id]);
        $exist = $q->data();
        if(!$exist){
            $subject = $_POST['code'];
            $chapter = $_POST['chapterId'];
            $question = $_POST['questionId'];
            if($subject=="ALL"){
                if($chapter=="ALL"){
                    return [0,"incorrect questionId: $question"];
                }
                else{
                    return [0,"incorrect chapterId: $chapter"];
                }
            }
            else{
                return [0,"incorrect code: $subject"];
            }
        }
        if($exist[0]['subjectCode']==$_POST['code'] || $_POST['code']=="ALL"){
            return [1,$exist[0]['subjectCode'],$exist[0]['paperName']];
        }
        $subject = $_POST['code'];
        return [0,"incorrect code: $subject"];
    }
    catch(Exception $e){
        throw $e;
    }
}

function validateUser($id){
    try{
        $query = "SELECT username FROM teacher WHERE id=? AND isActive='1' LIMIT 1";
        $q = new Query($query,"i");
        $q->execute([$id]);
        $exist = $q->data();
        if(!$exist){
            $subject = $_POST['username'];
            $chapter = $_POST['chapterId'];
            $question = $_POST['questionId'];
            if($subject=="ALL"){
                if($chapter=="ALL"){
                    return [0,"incorrect questionId: $question"];
                }
                else{
                    return [0,"incorrect chapterId: $chapter"];
                }
            }
            else{
                return [0,"incorrect username/password: $subject"];
            }
        }
        if($exist[0]['username']==$_POST['username'] || $_POST['username']=="ALL"){
            return [1,$exist[0]['username']];
        }
        $subject = $_POST['username'];
        return [0,"incorrect username/password: $subject"];
    }
    catch(Exception $e){
        throw $e;
    }
}

function validateAllocation($user,$subject){
    try{
        $query = "SELECT subjectID FROM subject_under_teacher WHERE subjectID=? AND teacherId=?
        LIMIT 1";
        $q = new Query($query,"ii");
        $q->execute([$subject,$user]);
        $exist = $q->data();
        $input = (object)$_POST;
        if(!$exist){
            if($input->code=="ALL"){
                if($input->chapter=="ALL"){
                    return [0,"incorrect questionId: $input->questionId"];
                }
                else{
                    return [0,"incorrect chapterId: $input->chapterId"];
                }
            }
            else{
                return [0,"teacher $input->username has not undertaken subject $input->code"];
            }
        }
        return [1,""];
    }
    catch(Exception $e){
        throw $e;
    }

}

function apiValidation(){
    $valid = checkSet(['key','questionId','chapterId','code','username','password'],1);
    if($valid[0]==0){
        return $valid;
    }
    $input = (object)($_POST);
    if($input->key!=key){
        return [0,"incorrect key: $input->key"];
    }
    $parameter = [];
    if($input->chapterId!="ALL"){
        $parameter['chapterId']=$input->chapterId;
    }
    if($input->questionId!="ALL"){
        $parameter['questionId']=$input->questionId;
    }
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
        $input = (object)($_POST);
        if($input->questionId!="ALL"){
            $valid = validateQuestion($input->questionId);
            if($valid[0]==0){
                return $valid;
            }
            $chapter = $valid[1];
            $valid = validateChapter($chapter);
            if($valid[0]==0){
                return $valid;
            }
            $subject = $valid[1][0];
            $teacher = $valid[1][1];
            $chapterName = $valid[1][2];
            $valid = validateSubject($subject);
            if($valid[0]==0){
                return $valid;
            }
            $subjectCode = $valid[1];
            $subjectName = $valid[2];

            $valid = validateUser($teacher);
            if($valid[0]==0){
                return $valid;
            }
            $teacherUser = $valid[1];
            $valid = validateAllocation($teacher,$subject);
            if($valid[0]==0){
                return $valid;
            }
            return [1,[$subjectCode,$chapter,$subjectName,$chapterName]];
        }
        else{
            if($input->chapterId!="ALL"){
                $valid = validateChapter($input->chapterId);
                if($valid[0]==0){
                    return $valid;
                }
                $subject = $valid[1][0];
                $teacher = $valid[1][1];
                $chapterName = $valid[1][2];
                $valid = validateSubject($subject);
                if($valid[0]==0){
                    return $valid;
                }
                $subjectCode = $valid[1];
                $paperName = $valid[2];
                $valid = validateUser($teacher);
                if($valid[0]==0){
                    return $valid;
                }
                $teacherUser = $valid[1];
                $valid = validateAllocation($teacher,$subject);
                if($valid[0]==0){
                    return $valid;
                }
                return [1,$subjectCode,$paperName,$chapterName];
            }
            else{
                if($input->code != "ALL"){
                    $query = "SELECT id,paperName FROM subject WHERE 
                    subjectCode=? AND isActive='1'";
                    $q = new Query($query,"s");
                    $q->execute([$input->code]);
                    $exist = $q->data();
                    if(!$exist){
                        return [0,"incorrect code: $input->code"];
                    }
                    $sid = $exist[0]['id'];
                    $paperName = $exist[0]['paperName'];
                    $valid = validateAllocation($tid,$sid);
                    if($valid[0]==0){
                        return $valid;
                    }
                    return [1,[$sid,$tid,$paperName]];
                }
                else{
                    return [1,$tid];
                }
            }
        }
    }
    catch(Exception $e){
        throw $e;
    }

}

function dataByChapter($id){
    $arr = [];
    try{
        $query = "SELECT id FROM question WHERE chapterId=? AND isActive='1'";
        $q = new Query($query,"i");
        $q->execute([$id]);
        $info = $q->data();
        foreach($info as $row){
            $arr[]=$row['id'];
        }
        return $arr;
    }
    catch(Exception $e){
        throw $e;
    }
}

function dataBySubject($id,$user){
    $arr = [];
    try{
        $query = "SELECT question.id AS qid,chapter.id AS cid,chapter.name AS cname FROM chapter INNER JOIN question 
        ON chapter.id = question.chapterId WHERE chapter.subjectID=? AND chapter.teacherId=? 
        AND question.isActive='1' AND chapter.isActive='1'";

        $q = new Query($query,"ii");
        $q->execute([$id,$user]);
        $info = $q->data();
        return $info;
    }
    catch(Exception $e){
        throw $e;
    }
}

function dataAll($uid){
    $arr = [];
    try{
        $query = "SELECT question.id AS qid,chapter.id AS cid,subject.subjectCode AS code
        ,subject.paperName AS sname,chapter.name AS cname   
        FROM subject INNER JOIN chapter ON 
        subject.id=chapter.subjectID INNER JOIN question 
        ON chapter.id = question.chapterId WHERE chapter.teacherId=? 
        AND question.isActive='1' AND chapter.isActive='1' AND subject.isActive='1'";

        $q = new Query($query,"i");
        $q->execute([$uid]);
        $info = $q->data();
        return $info;
    }
    catch(Exception $e){
        throw $e;
    }
}

try{
    Query::init();
    $valid = apiValidation();
    $input = (object)($_POST);
    if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
    if($input->questionId!="ALL"){
        $result['status']='OK';
        $body['id']=(int)$input->questionId;
        $question = new Question($input->questionId);
        $body['problemStatement']=$question->st;
        $body['correctOption'] = $question->correct()[0]->st;
        $incorrect = $question->incorrect();
        $body['incorrectOption1']=$incorrect[0][0]->st;
        $body['incorrectOption2']=$incorrect[1][0]->st;
        $body['incorrectOption3']=$incorrect[2][0]->st;
        $body['chapterId']=(int)$valid[1][1];
        $body['chapterName']=$valid[1][3];
        $body['code']=$valid[1][0];
        $body['paperName']=$valid[1][2];
        $result['result']=[$body];
        echo json_encode($result);
        exit();
    }
    if($input->chapterId!="ALL"){
        $arr = dataByChapter($input->chapterId);
        $result['status']='OK';
        $result['result']=[];
        foreach($arr as $value){
            $body['id']=(int)$value;
            $question = new Question($value);
            $body['problemStatement']=$question->st;
            $body['correctOption'] = $question->correct()[0]->st;
            $incorrect = $question->incorrect();
            $body['incorrectOption1']=$incorrect[0][0]->st;
            $body['incorrectOption2']=$incorrect[1][0]->st;
            $body['incorrectOption3']=$incorrect[2][0]->st;
            $body['chapterId']=(int)$input->chapterId;
            $body['chapterName']=$valid[3];
            $body['code']=$valid[1];
            $body['paperName']=$valid[2];
            $result['result'][]=$body;   
        }
        echo json_encode($result);
        exit();
    }
    if($input->code!="ALL"){
        $arr = dataBySubject($valid[1][0],$valid[1][1]);
        $result['status']='OK';
        $result['result']=[];
        foreach($arr as $value){
            $body['id']=(int)$value['qid'];
            $question = new Question($value['qid']);
            $body['problemStatement']=$question->st;
            $body['correctOption'] = $question->correct()[0]->st;
            $incorrect = $question->incorrect();
            $body['incorrectOption1']=$incorrect[0][0]->st;
            $body['incorrectOption2']=$incorrect[1][0]->st;
            $body['incorrectOption3']=$incorrect[2][0]->st;
            $body['chapterId']=(int)$value['cid'];
            $body['chapterName']=$value['cname'];
            $body['code']=$input->code;
            $body['paperName']=$valid[1][2];
            $result['result'][]=$body; 
        }
        echo json_encode($result);
        exit();
    }
    $arr = dataAll($valid[1]);
    $result['status']='OK';
    $result['result']=[];
    foreach($arr as $value){
        $body['id']=(int)$value['qid'];
        $question = new Question($value['qid']);
        $body['problemStatement']=$question->st;
        $body['correctOption'] = $question->correct()[0]->st;
        $incorrect = $question->incorrect();
        $body['incorrectOption1']=$incorrect[0][0]->st;
        $body['incorrectOption2']=$incorrect[1][0]->st;
        $body['incorrectOption3']=$incorrect[2][0]->st;
        $body['chapterId']=(int)$value['cid'];
        $body['chapterName']=$value['cname'];
        $body['code']=$value['code'];
        $body['paperName']=$value['sname'];
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