<?php

include 'db_connection.php';

$conn = OpenCon();

try{
    $query = "SELECT url FROM question";
    execute($conn,$query,"",[],$stmt);
    $question = get_data($stmt);
    close($stmt);
    foreach($question as $row){
        $a = $row['url'];
        echo "<img src =";
        echo "$a";
        echo "><\img>";
        echo "<br>";   
    }
}
catch(Exception $e){
    report($e);
    exit("error");
}

?>