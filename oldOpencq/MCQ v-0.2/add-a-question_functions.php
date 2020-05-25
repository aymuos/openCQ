<?php

function chapters($conn,$teacher_id){
try{


    $query = "SELECT id,name FROM chapter WHERE teacher_id = ?";
    execute($conn,$query,"s",[$teacher_id],$stmt);
    $result = get_data($stmt);
    close($stmt);
    return $result;

}
catch(Exception $e){
    report($e);
    exit("Error in add-a-question_functions->chapters");
}
}

function questions($conn,$id){
try{

    $query = "SELECT name,url,chapter_id FROM question WHERE id = ?";
    execute($conn,$query,"i",[$id],$stmt);
    $result = get_data($stmt);
    close($stmt);
    if(!$result){
        exit("invalid question id");
    }
    $arr['name'] = $result[0]['name'];
    $arr['url'] = $result[0]['url'];
    $arr['chapter_id'] = $result[0]['chapter_id'];
    return $arr;
}
catch(Exception $e){
    report($e);
    exit("Error in add-a-question_functions->questions");
}
}

function choices($conn,$id){
    try{
        $query = "SELECT name,url,is_right FROM choice WHERE question_id = ?";
        execute($conn,$query,"s",[$id],$stmt);
        $result = get_data($stmt);
        close($stmt);
        $arr = [];
        $wa = 1;
        foreach($result as $value){
           
            if($value['is_right'] == '1'){
                $arr['AC'] = [];
                $arr['AC'][] = $value['name'];
                $arr['AC'][] = $value['url']; 
            }
            else{
                $key = 'WA'.$wa;
                $wa = $wa+1;
                $arr[$key]=[];
                $arr[$key][] = $value['name'];
                $arr[$key][]=$value['url'];
            }
        }
        return $arr;
    }
    catch(Exception $e){
        report($e);
        exit("Error in add-a-question_functions->choices");
    }
}

?>