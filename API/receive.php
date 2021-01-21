<?php
require('receiver_header.php');
require('library.php');
// exit(json_encode(["status"=>"FAIL","comment"=>$_POST]));
// exit(json_encode(["status"=>"FAIL","comment"=>"no output"]));
//modify these datas 

// $_POST['key']=key;
// $_POST['rollNo']="10";
class Data{
    public $table;
    public $retrieveFields;
    public $conditionFields;
    public $conditionCount;
    public $conditionValues;
    public $conditionTypes;
    public function __construct($table,$fields,$condArray){
        $conditions = [];
        $this->conditionTypes = "";
        $data_inp = ["key"];
        foreach($condArray as $value){
            $conditions[] = $value[0];
            $data_inp[]=$value[0]; 
            $this->conditionTypes = $this->conditionTypes.$value[1]; 
        }
        // var_dump($conditions);
        // var_dump($data_inp);
        // exit();
		// array_push($data_inp,$conditions);
        $valid = checkSet($data_inp,1);
        if($valid[0]==0){
            exit(json_encode(["status"=>"FAIL","comment"=>$valid[1]]));
        }
        validateKey($_POST['key']);
        
        $this->conditionValues = array_values($_POST);
        array_shift($this->conditionValues); 
        $this->table = $table;
        $this->retrieveFields = implode(",",$fields);
        $this->conditionCount = count($conditions);
        array_walk($conditions,function(&$value,$key){
            $value = "$value=?";
        });
        $this->conditionFields = ((!$conditions)?"TRUE":implode(" AND ",$conditions));
    }
    public function getQuery(){
        return "SELECT $this->retrieveFields FROM $this->table WHERE $this->conditionFields";
    }
}

$data =  new Data(
    'form_student',
    [
        'rollNo',
        'name',
		'semester',
		'department',
		'regNo',
		'filled_offline_form',
		'compulsory1',
		'compulsory2',
		'elective1',
		'elective2',
		'backlog1',
		'backlog2',
		'backlog3'
    ],
    [
        ['rollNo',"s"]
    ]
);



try{

    Query::init();
    
    // var_dump($data);
    $q = new Query($data->getQuery(),$data->conditionTypes);
    // var_dump($data->conditionValues);
    $q->execute($data->conditionValues);
    $data = $q->data();
    if(!$data){
        exit(json_encode(["status"=>"FAIL","comment"=>"invalid roll number"]));
    }
    $result['status']="OK";
    $result['result']=$data[0];
    echo json_encode($result);
    // echo "hello ";
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