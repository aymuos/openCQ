<?php

//Delete the image corresponding to this question id. It can be null. if null then no need to do anything.
$id = $_GET["ques_id"];



header('location: add-a-ques.php?ques_id='.$id);


?>