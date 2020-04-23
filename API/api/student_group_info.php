<?php
require('library.php');
require('receiver_header.php');
function checkValidity($parameter){
    foreach($parameter as $key=>$regex){
        if(isset($_GET["$key"])){
            $value = $_GET["$key"];
            if(!preg_match($regex,$value)){
                return [0,"incorrect $key: $value"];
            }
        }
        else{
            return [0,"undefined parameter: $key"];
        }
    }
    return [1,""];
}

function queryStudentGroupInfo($stream,$bpy,$jy){
    $clause = 0;
    $query = "SELECT username,name,departmentCode AS department,joiningYear AS 'joining year',passOutYear AS 'pass out year',registration AS 'registration no',email,contactNo AS 'contact no' FROM student";
    $types = "";
    $place = [];
    if($stream != '1'){
        if($clause == 0){
            $query.=" WHERE";
            $clause=1;
        }
        else{
            $query.=" AND";
        }
        $query.=" departmentCode = ?";
        $types.="s";
        $place[]=$stream;
    }
    if($bpy != '1'){
        if($clause == 0){
            $query.=" WHERE";
            $clause=1;
        }
        else{
            $query.=" AND";
        }
        $query.=" passOutYear = ?";
        $types.="s";
        $place[]=$bpy;
    }
    if($jy != '1'){
        if($clause == 0){
            $query.=" WHERE";
            $clause=1;
        }
        else{
            $query.=" AND";
        }
        $query.=" joiningYear = ?";
        $types.="s";
        $place[]=$jy;
    }

    return [$query,$types,$place];

    
}
$result = array("status"=>"");

// $_GET['key']=key;
// $_GET['stream']="CSE";
// $_GET['joining_year']="1";
// $_GET['batch_passout_year']="1";

$key = key;
$parameter['key'] = "/^($key)$/";
$parameter['stream'] = "/^(CSE|CT|IT|1)$/";
$parameter['joining_year'] = "/^((1)|(20\d\d))$/";
$parameter['batch_passout_year']= "/^((1)|(20\d\d))$/";

// echo "*";
// var_dump(checkValidity($parameter));


// function checkValid(){
//     if(isset($_GET['key'])){
//         $ok = 0;
//         return [0,"undefined parameter: key"];
//     }
    
// }
$valid = checkValidity($parameter);
// echo "*";
if($valid[0]===0){
    $result['status']="FAIL";
    $result['comment']=$valid[1];
    err(json_encode($result));
    echo json_encode($result);
    exit();
}
// echo "*";
try{
    Query::init();
    $stream = $_GET['stream'];
    $jy = $_GET['joining_year'];
    $bpy = $_GET['batch_passout_year'];    
    $query = queryStudentGroupInfo($stream,$bpy,$jy);
    // echo "*";
    // echo $query[0]."\n";
    // echo $query[1]."\n";
    $q = new Query($query[0],$query[1]);
    
    $q->execute($query[2]);
    $info = $q->data();
    // var_dump($info);
    
    $result['status']="OK";
    $result['result']=$info;
    echo json_encode($result);
    
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
    $sad = 'FAIL';
    $cat = 'server error occurred';
    $arror = array(  'status' => $sad,
        'comment' => $cat);
    echo json_encode($arror);
    report($e);
    exit();
    
}
finally{
    Query::destroy();
}
?>