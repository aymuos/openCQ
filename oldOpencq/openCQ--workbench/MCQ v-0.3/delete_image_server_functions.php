<?php

function deleteImage($conn,$id){
try{


    $query = "SELECT id FROM question WHERE id = ? LIMIT 1";
    execute($conn,$query,"i",[$id],$stmt);
    $result = get_data($stmt);
    close($stmt);
    if(!$result){
        return 0;
    }
    else{
        $query = "UPDATE question SET url = '' WHERE id = ?";
        execute($conn,$query,"i",[$id],$stmt);
        close($stmt);
        return 1;
    }
}
catch(Exception $e){
    report($e);
    exit("Error in delete_image_server_functions.php->deleteImage");
}
    
    

}

?>