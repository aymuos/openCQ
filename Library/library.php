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

function checkValid($key,$id){
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

// echo weigh('
// <h1 style="text-align: center; ">
//   Hi, I\'m Textbox.io!</h1>
// <p>all of the above</p>
// <img src="none"></img>

// ')
 

?>