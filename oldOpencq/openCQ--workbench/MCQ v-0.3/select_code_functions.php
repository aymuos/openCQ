<?php




function subjects_already_allocated($conn,$teacher_id){
    try{
        $query = "SELECT subject_id FROM allocation WHERE  teacher_id = ?";
        execute($conn,$query,"s",[$teacher_id],$stmt);
        $table = get_data($stmt);
        close($stmt);
        $arr = [];
        foreach($table as $row){
            $arr[]=$row['subject_id'];
        }
        return $arr;
    }
    catch(Exception $e){
        //report($e);
        exit("error in function selecet_code_functions -> subject_already_allocated");
    }

}


function all_available_subjects($conn){
    try{
        $query = "SELECT id FROM subject";
        execute($conn,$query,"",[],$stmt);
        $table = get_data($stmt);
        close($stmt);
        $arr = [];
        foreach($table as $row){
            $arr[] = $row['id'];
        }
        return $arr;
    }
    catch(Exception $e){
        report($e);
        exit("error in function selecet_code_functions -> all_available_subjects");
    }
}






?>
