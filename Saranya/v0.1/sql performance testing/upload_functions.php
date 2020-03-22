<?php

function add_question($conn,$chname,$statement,$co,$ico1,$ico2,$ico3,$id,$flag){


try{

    $conn->autocommit(FALSE);

    if($id == ""){
        ;
    }
    else{
        $query = "DELETE FROM  question WHERE id = ?";
        execute($conn,$query,"i",[$id],$stmt);
        if($stmt->affected_rows === 0){
            exit("question doesn't exist");
        }
        close($stmt);
    }
    
    $query = "SELECT id FROM chapter WHERE name = ?";
    execute($conn,$query,"s",[$chname],$stmt);
    $table = get_data($stmt);
    if(!$table){
        exit("Chapter Doesn't Exist");
    }
    $id = $table[0]['id'];
    close($stmt);


    $query = "INSERT INTO question(name,chapter_id) VALUES(?,?)";
    execute($conn,$query,"si",[$statement,$id],$stmt);
    $question_id = $conn->insert_id;
    close($stmt);
    
    $arr = [];
    $arr[]=get_id($co);
    $arr[]=get_id($ico1);
    $arr[]=get_id($ico2);
    $arr[]=get_id($ico3);

    $arr2 = array_unique($arr);

    if(count($arr) == count($arr2)){
        ;
    }
    else{
        exit("Duplicate Choice");
    }
    
    $query = "INSERT INTO choice(name,is_right,question_id) VALUES (?,'1',?),(?,'0',?),(?,'0',?),(?,'0',?)";
    execute($conn,$query,"sisisisi",[$co,$question_id,$ico1,$question_id,$ico2,$question_id,$ico3,$question_id],$stmt);
    close($stmt);

    
    
    if(count($flag)==0){
        //no image;
        ;
    }
    else if(count($flag)==1){
        //url
        $query = "UPDATE question SET url = ? WHERE id = ?";
        execute($conn,$query,"si",[$flag[0],$question_id],$stmt);
        close($stmt);        

    }
    else{
        //add file
        $image_name = $question_id;
        $image_location = $flag[0].$image_name.'.'.$flag[1];
        

        $query = "UPDATE question SET url = ? WHERE id = ?";
        execute($conn,$query,"si",[$image_location,$question_id],$stmt);
        close($stmt);
    }

    

    $conn->autocommit(TRUE);
    //CloseCon($conn);
    return $question_id;
}
catch(Exception $e){
    report($e);
    //CloseCon($conn);
    exit("Error in upload_functions.php -> add_question");
}



}


?>