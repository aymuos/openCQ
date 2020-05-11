<?php


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
class Query{
    public static $conn;
    public $query;
    public $types;
    public $stmt;

    public static function init(){
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "opencq";
        try{    
            self::$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
            self::$conn->set_charset("utf8mb4");
            
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public function __construct($query,$types=""){
        $this->query = $query;
        $this->types = $types;
        // $conn = self::$conn;
        // $this->stmt = $conn->prepare($query);
        // if($types === ""){
        //     ;
        // }
        // else{
        //     $this->stmt->bind_param($types, ...$inarr);
        // }
        // try{
        //     $this->stmt->execute();
        // }
        // catch(Exception $e){
        //     // self::$conn->errno = $e->getCode();
        //     throw $e;
        // }
        
        #echo $conn->errno;
        #return $stmt;
    }

    public function execute($inarr=[]){
        $conn = self::$conn;
        $this->stmt = $conn->prepare($this->query);
        if($this->types === ""){
            ;
        }
        else{
            $this->stmt->bind_param($this->types, ...$inarr);
        }
        try{
            $this->stmt->execute();
        }
        catch(Exception $e){
            // self::$conn->errno = $e->getCode();
            throw $e;
        }   
    }
    public function data(){
        return $this->stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function affected(){
        return $this->stmt->affected_rows;
    }

    public static function info(){
        
        return self::$conn->info;
    }

    public static function infoArray(){
        preg_match_all('/(\S[^:]+): (\d+)/', self::$conn->info, $matches); 
        $infoArr = array_combine ($matches[1], $matches[2]);
        return $infoArr;
    }

    public static function insertId(){
        return self::$conn->insert_id;
    }

    // public static function errorNumber(){
    //     return self::$conn->errno;
    // }

    public static function tStart(){
        self::$conn->autocommit(FALSE);
    }

    public static function tStop(){
        self::$conn->autocommit(TRUE);
    }

    public static function tRoll(){
        self::$conn->rollback();
    }

    public function __destruct(){
        if($this->stmt != null) $this->stmt->close();
    }

    public static function destroy(){
        self::$conn->close();
        // echo "I am Destroyed";
    }
}

function err($e){
    error_log($e,3,"errors.txt");
}
function report($e){

    err("----------ERROR----------\n");
    $error = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    $stack = $e->getTraceAsString();
    err("error in file = $file"."\n");
    err("error in line = $line"."\n");
    err("error code = $error"."\n");
    err("error message = $message"."\n");
    err("error stack: \n$stack\n");
    err("----------ERROR----------\n");
    
}

function noSpace($a){
	return strtolower(preg_replace('/\s/','',$a));
}

function checkSet($parameters,$type=0){
    if($type==0){
        $check = $_GET;
    }
    else{
        $check = $_POST;
    }
    foreach($parameters as $key){
        if(isset($check["$key"])){

        }
        else{
            return [0,"undefined parameter: $key"];
        }
    }
    return [1,""];
}

function wordXP(string $word){
    return '('.preg_quote(strtolower($word),'/').')';
}

function XP(string $word){
    $word = ltrim($word);
    $word = rtrim($word);
    $arr = preg_split("/(\s)+/",$word,null,PREG_SPLIT_NO_EMPTY);
    // var_dump($arr);
    foreach($arr as &$value){
        $value = wordXP($value);

    }
    //var_dump($arr);
    return '^(\\s)*'.implode('(\\s)+',$arr).'(\\s)*$';
}

// class Question{
//     public $id;
//     public $weight;
//     public $value;
//     public function __construct($id,$value="",$weight=0){
//         $this->id = $id;
//         $this->weight = $weight;
//         $this->value = $value;
//     }

// }

// class Choice extends Question{
//     public $isRight;
//     public $isMarked;
//     public __construct($id,$value="",$weight=0,$isRight=0,$isMarked=0){
//         $this->id=$id;

//     }
// }

// function qdata($id){
//     $statement="";
//     $choice = [];

  
  
//     for($i=1;$i<=)
// }

function checkValid($parameter){
    foreach($parameter as $key=>$value){
        if(gettype($value)==="integer"){
            continue;
        }
        if(gettype($value)!="string"){
            return [0,"incorrect $key: "];
        }
        if($value==""){
            return [0,"incorrect $key: $value"];
        }
        for($i=0;$i<strlen($value);$i++){
            $c = $value[$i];
            $ass = ord($c);
            if($ass<48 || $ass>57){
                return [0,"incorrect $key: $value"];
            }
        }
    }
    return [1,""];
}

function validateKey($key){
    if($key!=key){
        $result['status']='FAIL';
        $result['comment']="incorrect key: $key";
        echo json_encode($result);
        exit();
    }
}

function stripText($text, $tags = '', $invert = FALSE) {

    preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
    //  var_dump($tags);
    $tags = array_unique($tags[1]);
    
    if(is_array($tags) AND count($tags) > 0) {
      if($invert == FALSE) {
          
        return strip_tags(preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>@si', '', $text));
      }
      else {
          
        return strip_tags(preg_replace('@<('. implode('|', $tags) .')\b.*?>@si', '', $text));
      }
    }
    elseif($invert == FALSE) {
      return strip_tags(preg_replace('@<(\w+)\b.*?>@si', '', $text));
    }
    return strip_tags($text);
  }

function weigh($str){   
    $str = htmlspecialchars_decode($str);
    $text = stripText($str,'<img>',TRUE);
    
    $text = strtolower(trim($text));
    //echo $text;
    $arr = preg_split("/(\s)+/",$text,null,PREG_SPLIT_NO_EMPTY);
    // var_dump($arr);
    $all = 0;
    $both=0;
    foreach($arr as $value){
        if($value=='none'){
            return 50;
        }
        else if($value=='all'){
            $all=1;
        }
        else if($value=='both'){
            $both=1;
        }
    }
    if($all==1){
        return 30;
    }
    if($both==1){
        return 20;
    }
    return 0;
}
// define("bank","C:\\Users\\SARANYA\\Desktop\\S\\projects\\api\\questionBank\\");

class Option{
    public $number;
    public $st;
    public $weight;
    public $isMarked;
    public function __construct($qid,$number){
        $this->number = $number;
        $this->isMarked = FALSE;
        $number++;
        $filename = $qid."_".$number.".txt";
        $location = bank;
        $file = $location.$filename;
        if(file_exists($file)){
            $st=file_get_contents($file);
            $arr = explode("\n",$st,2);
            $this->weight=intval($arr[0]);
            $this->st=$arr[1];
        }
        else{
            $this->weight=0;
            $this->st="";
        }
        // $st = file_get_contents($file);
        // if($st===FALSE){
        //     $this->weight=0;
        //     $this->st="";
        // }
        // else{
        //     $arr = explode("\n",$st,2);
        //     $this->weight=intval($arr[0]);
        //     $this->st=$arr[1];
        // }
        
    }
    public function __toString(){
        return $this->st;
    }
    public static function cmpOption($c1,$c2){
        $cw1 = $c1->weight;
        $cw2 = $c2->weight;
        if($cw1==$cw2){
            return 0;
        }
        return ($cw1>$cw2)?+1:-1;
    }
    public function food($f){
        $this->weight = $this->weight+$f;
    }
}

class Question{
    public $id;
    public $st;
    public $weight;
    public $options;
    public function __construct($id){
        $this->id=$id;
        $this->weight=0;
        $filename = bank.$id."_1.txt";
        // exit($filename);
        $this->st = (file_exists($filename))?file_get_contents($filename):"";
        // $st = file_get_contents($filename);
        // $this->st = ($st===FALSE)?"":$st;
        $choices = [];
        $choices[]=new Option($id,1);
        $choices[]=new Option($id,2);
        $choices[]=new Option($id,3);
        $choices[]=new Option($id,4);
        usort($choices,array('Option','cmpOption'));
        $this->options = $choices; 
    }
    public function __toString(){
        return $this->st;
    }
    public function correct(){
        $i=1;
        foreach($this->options as $value){
            if($value->number==1){
                return [$value,$i];
            }
            $i=$i+1;
        }
    }
    public function incorrect(){
        $mask = $this->correct()[1];
        $result = [];
        for($i=1;$i<=4;$i=$i+1){
            if($i!=$mask){
                $result[]=[$this->options[$i-1],$i];
            }
        }
        return $result;
    }
    public function marked(){
        $i=1;
        foreach($this->options as $value){
            if($value->isMarked==TRUE){
                return [$value,$i];
            }
            $i=$i+1;
        }
        return ["",0];
    }
    public function attempt($num){
        $opt = $this->marked();
        if($opt[1]!=0){

            $opt[0]->isMarked=FALSE;
        }
        if($num!=0){
            $this->options[$num-1]->isMarked=TRUE;
        }
    }
    public function opRandom(){
        $this->options[0]->food(mt_rand()%10);
        $this->options[1]->food(mt_rand()%10);
        $this->options[2]->food(mt_rand()%10);
        $this->options[3]->food(mt_rand()%10);
        usort($this->options,array('Option','cmpOption'));
    }
}

// define("exam","C:\\Users\\SARANYA\\Desktop\\S\\projects\\api\\exam\\");
function saveAttempt($stid,$eid,$attemptQuestion,$attemptOption){
    $file = exam.$stid."_".$eid.".txt";


        $file = fopen($file,"r+");
        $result = fseek($file,$attemptQuestion-1);
        // $result[$attemptQuestion-1]=$attemptOption;
        fwrite($file,$attemptOption);
        fclose($file);


}

function getAttempt($stid,$eid){
    $file = exam.$stid."_".$eid.".txt";
    $attempt = file_get_contents($file);
    return $attempt; 
}
function varDumpToString($var) {
    ob_start();
    var_dump($var);
    $result = ob_get_clean();
    return $result;
 }
// echo getAttempt(3,3);
// define("bank","C:\\Users\\SARANYA\\Desktop\\S\\projects\\api\\questionBank\\");
// $question = new Question(1);
// echo $question."\n";
// echo $question->options[0]."\n";
// echo $question->options[1]."\n";
// echo $question->options[2]."\n";
// echo $question->options[3]."\n";
// echo $question->correct()[0]."\n";
// echo $question->correct()[1]."\n";
// var_dump($question->incorrect());


// echo weigh('
// <h1 style="text-align: center; ">
//   Hi, I\'m Textbox.io!</h1>
// <p>all of the above</p>
// <img src="none"></img>

// ')

?>