<?php
require('receiver_header.php');
require('library.php');
function set(){
    $valid = checkSet(['key','username','password'],1);
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

function generateQuestions($exams){
    if(!$exams){
        return [];
    }
    $questions = [];
    $clause = implode(',',array_fill(0,count($exams),"?"));
    $types = str_repeat('i',count($exams));
    $query = "SELECT examId,questionId FROM exam_questions WHERE examId IN ($clause)
    ORDER BY examId,questionId";
    $q = new Query($query,$types);
    $q->execute($exams);
    $data = $q->data();
    foreach($data as $row){
        $eid = $row['examId'];
        $qid = $row['questionId'];
        if(isset($questions[$eid])){
            $questions[$eid][]=$qid;
        }
        else{
            $questions[$eid]=[$qid];
        }
    }
    return $questions;
}

function validityExams($arr){
    if(!$arr){
        return;
    }
    $clause = implode(',',array_fill(0,count($arr),"?"));
    $types = str_repeat('i',count($arr));
    $query = "SELECT id FROM exam WHERE id IN ($clause) AND isActive IN ('3','4')";
    $q = new Query($query,$types);
    $q->execute($arr);
    $info = $q->data();
    $exams = [];
    foreach($info as $row){
        $exams[]=$row['id'];
    }
    $left = array_diff($arr,$exams);
    if($left){
        $result['status']='FAIL';
        $result['comment']="invalid attempt to generate result";
        echo json_encode($result);
        exit();
    }
}

function generateAttempts(){
    $attempt=[];
    $files = array_values(array_diff(scandir(exam),array('..','.')));
    foreach($files as $file){
        $arr = explode('_',$file);
        $eid = explode('.',$arr[1],2)[0];
        $stid = $arr[0];
        $st = file_get_contents(exam.$file);
        if(isset($attempt[$eid])){
            // echo "*";
            $attempt["$eid"][]=[$stid,$st];
            // var_dum($attempt);
        }
        else{
            $attempt["$eid"]=[[$stid,$st]];
            // var_dump($attempt);
        }
    }
    return [$attempt,$files];
    // var_dump($attempt);
}

function updateResult($attempts,$questions){
    foreach($attempts as $key=>$value){
        foreach($value as $atom){
            $stid = $atom[0];
            $attempt = $atom[1];
            $query = "SELECT questionShuffle FROM marksheet WHERE examId=?
            AND studentId=? LIMIT 1";
            $q = new Query($query,"ii");
            $q->execute([$key,$stid]);
            $res = $q->data();
            mt_srand($res[0]['questionShuffle']);
            $qs = $questions[$key];
            shuffle($qs);
            $i=0;
            $cmp=0;
            foreach($qs as $id){
                $opt = [];
                $h = fopen(bank.$id."_2.txt","r");
                $opt[] = [(int)fgets($h),1];
                fclose($h);
                $h = fopen(bank.$id."_3.txt","r");
                $opt[] = [(int)fgets($h),0];
                fclose($h);
                $h = fopen(bank.$id."_4.txt","r");
               
                $opt[] = [(int)fgets($h),0];
                fclose($h);
                $h = fopen(bank.$id."_5.txt","r");
                $opt[] = [(int)fgets($h),0];
                fclose($h);
                usort($opt,function ($a,$b){
                    if($a[0]>$b[0]){
                        return +1;
                    }
                    else if($a[0]==$b[0]){
                        return 0;
                    }
                    else{
                        return -1;
                    }
                });
                $opt[0][0]=$opt[0][0]+mt_rand()%10;
                $opt[1][0]=$opt[1][0]+mt_rand()%10;
                $opt[2][0]=$opt[2][0]+mt_rand()%10;
                $opt[3][0]=$opt[3][0]+mt_rand()%10;
                usort($opt,function ($a,$b){
                    if($a[0]>$b[0]){
                        return +1;
                    }
                    else if($a[0]==$b[0]){
                        return 0;
                    }
                    else{
                        return -1;
                    }
                });
                if($attempt[$i]!=0){
                    if($opt[$attempt[$i]-1][1]==1){
                        $cmp++;
                        // echo "voila!!\n";
                    }
                }
                $i++;
            }
            $query = "UPDATE marksheet SET attempts=?,marks=? WHERE examId=? AND 
            studentId=?";
            $q = new Query($query,"siii");
            $q->execute([$attempt,$cmp,$key,$stid]);
        }
    }
}

function updateExam($arr){
    if(!$arr){
        return;
    }
    $clause = implode(',',array_fill(0,count($arr),"?"));
    $types = str_repeat('i',count($arr));
    $query = "UPDATE exam SET isActive='4' WHERE id IN ($clause) AND isActive='3'";
    $q = new Query($query,$types);
    $q->execute($arr);

}

try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="root";
    // $_POST['password']="shoot";
    set();
    validateUser();
    try{
        Query::tStart();
        $arrt= generateAttempts();
        // exit();
        $attempts = $arrt[0];
        $files = $arrt[1];
        $exams = array_keys($attempts);
        validityExams($exams);
        $questions = generateQuestions($exams);
        updateResult($attempts,$questions);
        updateExam($exams);
        array_map(function($f){
            return unlink(exam.$f);
        },$files);
        Query::tStop();
        $result['status']='OK';
        $result['comment']="results have been generated";
        echo json_encode($result);
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