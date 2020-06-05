<?php
require('receiver_header.php');
require('library.php');
class ExamQuestion{
    public $question;
    public $marks_when_correct;
    public $marks_when_wrong;
    public $options;
    public function __construct($question,$marks_when_correct,$marks_when_wrong){
        $this->question = $question;
        $this->marks_when_correct = $marks_when_correct;
        $this->marks_when_wrong = $marks_when_wrong;
        $opt = [];
        $h = fopen(bank.$question."_2.txt","r");
        $opt[] = [(int)fgets($h),1];
        fclose($h);
        $h = fopen(bank.$question."_3.txt","r");
        $opt[] = [(int)fgets($h),2];
        fclose($h);
        $h = fopen(bank.$question."_4.txt","r");      
        $opt[] = [(int)fgets($h),3];
        fclose($h);
        $h = fopen(bank.$question."_5.txt","r");
        $opt[] = [(int)fgets($h),4];
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
        $this->options = $opt;
    }
}


class Attempt{
    public $student;
    public $attempt;
    public function __construct($student,$attempt){
        $this->student = $student;
        $this->attempt = $attempt;
    } 
}
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
    $query = "SELECT examId,questionId,marks_when_correct,marks_when_wrong FROM exam_questions WHERE examId IN ($clause)
    ORDER BY examId,questionId";
    $q = new Query($query,$types);
    $q->execute($exams);
    $data = $q->data();
    foreach($data as $row){
        $eid = $row['examId'];
        $qid = $row['questionId'];
        $marks_when_correct = $row['marks_when_correct'];
        $marks_when_wrong = $row['marks_when_wrong'];
        if(isset($questions[$eid])){
            $questions[$eid][]= new ExamQuestion($qid,$marks_when_correct,$marks_when_wrong);
    
        }
        else{
            $questions[$eid]=[new ExamQuestion($qid,$marks_when_correct,$marks_when_wrong)];
        }
    }
    return $questions;
}

function generateShuffles($exams){
    if(!$exams){
        return [];
    }
    
    $clause = implode(',',array_fill(0,count($exams),"?"));
    $types = str_repeat('i',count($exams));
    $query = "SELECT examId,studentId,questionShuffle FROM marksheet WHERE examId IN ($clause)";
    $q = new Query($query,$types);
    $q->execute($exams);
    $data = $q->data();
    $shuffles = [];
    foreach($data as $row){
        $eid = $row['examId'];
        $stid = $row['studentId'];
        $qshuffle = $row['questionShuffle'];
        $shuffles[$eid][$stid]= $qshuffle;

    }
    return $shuffles;
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
		if($file == ".htaccess")continue;
        $arr = explode('_',$file);
		//var_dump($arr);
        $eid = explode('.',$arr[1],2)[0];
        $stid = $arr[0];
        $st = file_get_contents(exam.$file);
        if(isset($attempt[$eid])){
            // echo "*";
            $attempt["$eid"][]=new Attempt($stid,$st);
            // var_dum($attempt);
        }
        else{
            $attempt["$eid"]=[new Attempt($stid,$st)];
            // var_dump($attempt);
        }
    }
    return [$attempt,$files];
    // var_dump($attempt);
}
class Marks{
    public $marks;
    public $attempts;
    public function __construct($marks,$attempts){
        $this->marks = $marks;
        $this->attempts = $attempts;
    }
}
function updateResult($attempts,$questions,$shuffles){
    // $dbresult = [];
    foreach($attempts as $key=>$value){
        // echo "......exam......\n";
        // echo "$key\n";
        foreach($value as $atom){
            // echo "......student......\n";
            $stid = $atom->student;
            // echo "$stid\n";
            $attempt = $atom->attempt;
            // echo "......attempt......\n";
            // echo "$attempt\n";
            // $query = "SELECT questionShuffle FROM marksheet WHERE examId=?
            // AND studentId=? LIMIT 1";
            // $q = new Query($query,"ii");
            // $q->execute([$key,$stid]);
            // $res = $q->data();
            mt_srand($shuffles[$key][$stid]);
            $qs = $questions[$key];
            shuffle($qs);
            $i=0;
            $cmp=0;
            foreach($qs as $obj){
                $id = $obj->question;
                // echo ".......question.........\n";
                // echo new Question($id)."\n";
                $marks_when_correct = $obj->marks_when_correct;
                $marks_when_wrong = $obj->marks_when_wrong;
                $opt = $obj->options;
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
                // echo ".......1st Option.........\n";
                // echo new Option($id,$opt[0][1])."\n";
                // echo ".......2nd Option.........\n";
                // echo new Option($id,$opt[1][1])."\n";
                // echo ".......3rd Option.........\n";
                // echo new Option($id,$opt[2][1])."\n";
                // echo ".......4th Option.........\n";
                // echo new Option($id,$opt[3][1])."\n";
                if($attempt[$i]!=0){
                    if($opt[$attempt[$i]-1][1]==1){
                        $cmp = $cmp + $marks_when_correct;
                        // echo "voila!!\n";
                    }
                    else{
                        $cmp = $cmp + $marks_when_wrong;
                    }
                }
                $i++;
            }
            $query = "UPDATE marksheet SET attempts=?,marks=? WHERE examId=? AND 
            studentId=?";
            $q = new Query($query,"sdii");
            $q->execute([$attempt,$cmp,$key,$stid]);
            // $dbresult[$key][$stid]=new Marks($cmp,$attempt);
        }
    }
    // return $dbresult;
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





// Query::init();
// $arrt = generateAttempts();
// $attempts = $arrt[0];
// // var_dump($attempts);
// $exams = array_keys($attempts);
// validityExams($exams);
// $questions = generateQuestions($exams);
// $shuffles = generateShuffles($exams);
// // var_dump($questions);
// var_dump(updateResult($attempts,$questions,$shuffles));
// // var_dump(new Attempt(3,"010"));
// Query::init();
// var_dump(generateShuffles([1,2,4]));
try{
    Query::init();
    // $_POST['key']=key;
    // $_POST['username']="grey";
    // $_POST['password']="umbrella";
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
        $shuffles = generateShuffles($exams);
        updateResult($attempts,$questions,$shuffles);
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