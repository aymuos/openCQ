<?php

include 'db_connection2.php';
set_time_limit(0);
$conn = OpenCon();

for(;;){


    $query = "SELECT id FROM a ORDER BY RAND() LIMIT 1";
    execute($conn,$query,"",[],$stmt);
    $result = get_data($stmt);
    close($stmt);
    
    $random = rand(1,100);
    $random = sha1($random);
    $query = "INSERT INTO b(name,aid) VALUES (?,?)";
    execute($conn,$query,"si",[$random,$result[0]['id']],$stmt);
    $id = $conn->insert_id;
    close($stmt);
    //$query = "INSERT INTO c(aid,bid) VALUES (?,?)";
    //execute($conn,$query,"ii",[$result[0]['id'],$id],$stmt);
    //close($stmt);
}
CloseCon($conn);
?>