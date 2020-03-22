<?php

function getExamId($conn,$subject_id,$teacher_id){

try{

    $time = time();
    $query = "INSERT INTO exam(subject_id,teacher_id,create_time) VALUES (?,?,?)";
    execute($conn,$query,"ssi",[$subject_id,$teacher_id,$time],$stmt);
    $id = $conn->insert_id;
    close($stmt);
    return $id;
    
}
catch(Exception $e){
    if($conn->errno === 1452){
        exit("invalid teacher or subject");
    }
    report($e);
    exit("error in test_dashboardcreate_functions.php->getExamId");
}

}

?>