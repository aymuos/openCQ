<?php
function findName($conn,$id){

try{


    $query = "SELECT name FROM subject WHERE id = ?";
    execute($conn,$query,"s",[$id],$stmt);
    $res = get_data($stmt);
    close($stmt);
    if(!$res){
        exit("Invalid subject code");
    }
    else{
        return $res[0]['name'];
    }


}
catch(Exception $e){
    report($e);
    exit("Error in server_send_functions->findName");
}
}
?>