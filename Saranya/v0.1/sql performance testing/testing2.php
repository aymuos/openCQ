<?php

include 'db_connection.php';
set_time_limit(0);

$conn = OpenCon();

for(;;){


    $query = "SELECT id FROM a ORDER BY RAND() LIMIT 1";
    execute($conn,$query,"",[],$stmt);
    $result = get_data($stmt);
    close($stmt);
    
    $random = rand(1,100);
    $random = sha1($random);
    try{
        $conn->autocommit(FALSE);
        $query = "INSERT INTO b(name) VALUES (?)";
        execute($conn,$query,"s",[$random],$stmt);
        $id = $conn->insert_id;
        close($stmt);
        $query = "INSERT INTO c(aid,bid) VALUES (?,?)";
        execute($conn,$query,"ii",[$result[0]['id'],$id],$stmt);
        close($stmt);
        $conn->autocommit(TRUE);
    }
    catch(Exception $e){
        report($e);
    }

}

CloseCon($conn);
?>