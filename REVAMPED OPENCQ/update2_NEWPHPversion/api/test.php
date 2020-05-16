<?php
require('library.php');
require('receiver_header.php');
// $word = "saranya naha roy@gm^a\$l.com";

// echo XP($word);


try{
    Query::init();

    function checkDt($test){
        $regx = XP($test);
        $query = "SELECT name FROM chapter WHERE LOWER(name) REGEXP ? AND isActive = '1' LIMIT 1";
        $q = new Query($query,"s");
        //echo $regx."\n";
        $q->execute([$regx]);
        $data = $q->data();
        if($data){
            $name = $data[0]['name'];
            echo "Found a match: $name";
        }
        else{
            echo "no match";
        }
    }
    checkDt(" 
    
   BIG           MOON
    ");
    // try{
    //     Query::tStart();
    //     Query::tStop();
    // }
    // catch(Exception $e){
    //     Query::tRoll();
    //     throw $e;
    // }

}
catch(Exception $e){
    report($e);
}
finally{
    Query::destroy();
}
?>