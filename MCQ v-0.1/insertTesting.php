<?php
include 'db_connection.php';
$conn = OpenCon();

try{
    $query = "INSERT INTO exam_question(name,url,exam_id,chapter_name) VALUES ('testing','testing',15,'testing')";
    execute($conn,$query,"",[],$stmt);
    close($stmt);  
    echo "Success";
}
catch(Exception $e){
    report($e);
    echo "Failed";
}


?>