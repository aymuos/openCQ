<?php
require('receiver_header.php');
require('library.php');

$input = [
    'rollNo',
    'name',
	"semester",
	"department",
	'regNo',
	"contactNo",
	"email",
	"fatherName",
	"permanentAddress",
	"filled_offline_form",
	"compulsory1",
	"compulsory2",
	"elective1",
	"elective2",
	"backlog1",
	"backlog2",
	"backlog3",
	"backlog4",
	"backlog5"
];

function set(){
    //$valid = checkSet(['key',...$input],1);
    $valid[0] = 1;
	if($valid[0]==0){
        $result['status']='FAIL';
        $result['comment']=$valid[1];
        echo json_encode($result);
        exit();
    }
}

try{

    Query::init();
    set();
    validateKey($_POST['key']);
    $inarr = array_values($_POST);
	
    array_shift($inarr);
    $query = "INSERT INTO form_student("
            .implode(",",$input) 
            .") VALUES ("
            .implode(",",array_fill(0,count($input),"?"))
            .")";
    // echo $query."\n";
    // echo str_repeat("s",count($input))."\n";
    // var_dump([...array_values(['rollNo'=>"1023","name"=>"Rashed","regNo"=>"4520"])]);
    // exit();
    $q = new Query($query,str_repeat("s",count($input)));
	//var_dump($inarr);
    $q->execute($inarr);
	$result['status']='OK';
    $result['comment']= 'record updated successfully';
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
    if($e->getCode()===1062){
        $sad = 'FAIL';
        $cat = 'Duplicate Entry';
        $arror = array(  'status' => $sad, 'comment' => $cat);
        echo json_encode($arror);
        exit();     
    }
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