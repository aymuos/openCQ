<?php

function examDetails($conn,$id,$subject_id,$teacher_id){

try{


    $query = "SELECT id FROM exam WHERE id = ? LIMIT 1";
    execute($conn,$query,"i",[$id],$stmt);
    $res = get_data($stmt);
    close($stmt);
    if(!$res){
        exit('Invalid exam id');
    }
    $arr = [];
    
    //$subject_id = //$_SESSION['sub_code'];
    //$teacher_id = //$_SESSION['usernamemaster'];
    
    $query = "SELECT name,UG FROM subject WHERE id = ?";
    execute($conn,$query,"s",[$subject_id],$stmt);
    //$arr['subject']=get_data($stmt)[0]['name'];
    $temp = get_data($stmt);
    $arr['subject']=$temp[0]['name'];
    if($temp[0]['UG']=='1'){
        $arr['g']="UG";
    }
    else{
        $arr['g']="PG";
    }
    close($stmt);
    
    
    
    $query = "SELECT name FROM teacher WHERE id = ?";
    execute($conn,$query,"s",[$teacher_id],$stmt);
    $arr['teacher']=get_data($stmt)[0]['name'];
    close($stmt);


    /*if($res[0]['UG']=='1'){
        $arr['g']="UG";
    }
    else{
        $arr['g']="PG";
    }*/

    $arr['subcode']=$subject_id;

    return $arr;

}
catch(Exception $e){
    report($e);
    exit("Error in teacher_test_view_functions.php->examDetails");
}
}

?>