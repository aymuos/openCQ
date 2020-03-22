<?php

function addCourse($conn,$teacher,$subject){
try{


    $query = "SELECT id FROM subject WHERE id = ? LIMIT 1";
    execute($conn,$query,"s",[$subject],$stmt);
    $res = get_data($stmt);
    close($stmt);
    if(!$res){
        exit("Invalid Subject Code");
    }

    $query = "SELECT id FROM teacher WHERE id = ? LIMIT 1";
    execute($conn,$query,"s",[$teacher],$stmt);
    $res = get_data($stmt);
    close($stmt);
    if(!$res){
        exit("invalid teacher id");
    }

    $query = "INSERT INTO allocation(subject_id,teacher_id) VALUES(?,?)";
    execute($conn,$query,"ss",[$subject,$teacher],$stmt);
    close($stmt);

}
catch(Exception $e){
    if($conn->errno === 1062){
        exit("You are already allocated for this subject");
    }
    report($e);
    exit("Error in add_course_functions.php->addCourse");
}
}
?>