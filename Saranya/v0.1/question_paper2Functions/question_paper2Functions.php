<?php

function questions($conn,$chapter_id){

try{
    $query = "SELECT id FROM chapter WHERE id = ? LIMIT 1";
    execute($conn,$query,"i",[$chapter_id],$stmt);
    $result = get_data($stmt);
    if(!$result){
        exit("chapter does not exist");
    }
    close($stmt);


    $query = "SELECT name FROM question WHERE chapter_id = ?";
    execute($conn,$query,"i",[$chapter_id],$stmt);
    $result = get_data($stmt);
    close($stmt);
    $arr = [];
    foreach($result as $value){
        $arr[]=$value['name'];
    }
    return $arr;

}
catch(Exception $e){
    report($e);
    exit("Error in question_paper2Functions.php->questions");
}
}

?>