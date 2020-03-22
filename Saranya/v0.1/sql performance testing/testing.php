<?php 
/*include 'db_connection.php';
include 'upload_functions.php';
echo '
<html>
    <head>
    </head>
    <body>
    
        <form action="testing.php" method="get">
            Chapter: <input type="text" name="chapter-name">
            <br>
            Statement: <input type="text" name="problem-statement">
            <br>
            AC: <input type="text" name="correct">
            <br>
            WA1: <input type="text" name="incorrect1">
            <br>
            WA2: <input type="text" name="incorrect2">
            <br>
            WA3: <input type="text" name="incorrect3">
            <br>
            Image/URL: <input type="text" name="x">
            <br>
            ID: <input type="text" name="ques_id">
            <br>
            <input type="submit">
        </form>
        <br>
    </body>
</html>
'
;
        

            $conn = OpenCon();
            $chname = $_GET["chapter-name"]; 			//This is the chapter name
            $statement = $_GET["problem-statement"];	//This has the problem statement
            $co = $_GET["correct"];					//This is the correct option
            $ico1 = $_GET["incorrect1"];				//This is the incorrect option 1
            $ico2 = $_GET["incorrect2"];				//This is the incorrect option 2
            $ico3 = $_GET["incorrect3"];				//This is the incorrect option 2
            $var = $_GET["x"];							//if '$var' is 0 then it means that user has just uploaded the image...if 1 then user has finished the whole question.
            $id = $_GET["ques_id"];					//This contains the question id. if it is empty then it is a new question
            

            if($var == "0"){
                $question_id = add_question($conn,$chname,$statement,$co,$ico1,$ico2,$ico3,$id,["upload\\","png"]);
            }
            else{
                $question_id = add_question($conn,$chname,$statement,$co,$ico1,$ico2,$ico3,$id,[$var]);
            }
            
            echo "question added as ".$question_id;
*/


/*$to = "rashedmehdi42@gmail.com";
$subject = "Opencq";
$txt = "Hello Rashed. Automatically sending an email using a php script";
$txt = wordwrap($txr,70);
$txt = str_replace("\n.","\n..",$txt);
$headers = "From: jarvisnaharoy@gmail.com" . "\r\n" .
"CC: rishav16ban98@gmail.com";

mail($to,$subject,$txt,$headers);
*/

include 'db_connection.php';
set_time_limit(0);

$n = 10;

$conn = OpenCon();

for(;;){


    $values = implode(",",array_fill(0,$n,"(?)"));

    $types = str_repeat("s",$n);

    $arr = [];

    for($i=0;$i<$n;$i++){
        $random = rand(1,100);
        for($j=0;$j<=38;$j++){
            $random = sha1($random);
        }
        $arr[]=$random;
        echo count($arr)."<br>";

    }

    echo $types;
    echo '<br>';
    echo $values;
    echo '<br>';
    foreach($arr as $val){
        echo $val.",";
    }
    echo '<br>';
    echo count($arr);
    echo '<br>';
    $query = "INSERT INTO a(name) values $values";
    execute($conn,$query,$types,$arr,$stmt);
    close($stmt);

}

    CloseCon($conn);

  ?>      
