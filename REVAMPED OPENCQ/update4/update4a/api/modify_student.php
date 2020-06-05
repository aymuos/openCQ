<?php
require('library.php');
require('receiver_header.php');
// $_POST['key']=key;
// $_POST['username']="soumyamukherjee";
// $_POST['name']="Soumya Mukherjee";
// $_POST['department']="CSE";
// $_POST['registration_no']="1711";
// $_POST['joining_year']="2017";
// $_POST['email']="a@b.com";
// $_POST['contact_no']="7856";
function checkvValid($parameter){
    foreach($parameter as $key=>$regex){
        $value = $_POST["$key"];
        if(preg_match($regex,$value)){
            ;
        }
        else{
            return [0,"incorrect $key: $value"];
        }
    }
    return [1,""];
}
$st = checkSet(['key','username','password','name','department','registration_no','joining_year','email','contact_no'],1);
if($st[0]===0){
    $result['status']="FAIL";
    $result['comment']=$st[1];
    echo json_encode($result);
    exit();
}
$parameter['department']="/^(CSE|CT|IT|1)$/";
$parameter['joining_year'] = "/^((1)|(20\d\d))$/";
$st = checkvValid($parameter);
if($st[0]===0){
    $result['status']="FAIL";
    $result['comment']=$st[1];
    echo json_encode($result);
    exit();
}

if($_POST['key']!=key){
    $k = $_POST['key'];
    $result['status']="FAIL";
    $result['comment']="incorrect key: $k";
    echo json_encode($result);
    exit();
}



try{
    Query::init();
    
    $query = "SELECT id FROM student WHERE username=? AND password=? AND isActive='1' LIMIT 1";
    $q = new Query($query,"ss");
    $q->execute([$_POST['username'],$_POST['password']]);
    $exist = $q->data();
    if(!$exist){
        $user = $_POST['username'];
        $result['status']="FAIL";
        $result['comment']="incorrect username/password: $user";
        echo json_encode($result);
        exit();
    }
    
     $bpy = (int)$_POST['joining_year']+4;   
     $query = "UPDATE student SET name=?,joiningYear=?,passOutYear=?,email=?,registration=?,contactNo=?,departmentCode=? WHERE username=? AND isActive='1'";
     $types = "ssssssss";
     $q = new Query($query,$types);
     $q->execute([$_POST['name'],$_POST['joining_year'],$bpy,$_POST['email'],$_POST['registration_no'],$_POST['contact_no'],$_POST['department'],$_POST['username']]);
     $result['status']="OK";
     $result['comment']="record successfully updated";
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