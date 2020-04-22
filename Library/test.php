<?php
require('library.php');
require('receiver_header.php');
try{
    Query::init();
    
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