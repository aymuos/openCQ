<?php
require('library.php');
require('receiver_header.php');
// $_POST['key']=key;
// $_POST['username']="ss";
// $_POST['honorary']="Doc";
// $_POST['fname']="Swan";
// $_POST['lname']="Sherlok";
// $_POST['department']="BSEH";
// $_POST['designation']="HOD";
// $_POST['address']="14 Luis Road, Goragacha";
// $_POST['email']="DarK-ness@light.lit";
// $_POST['contact_no']="7890458202";
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
$st = checkSet(
    [
    'key',
    'usernamecoe',
    'passwordcoe',
	'username',
    'name',
    'department',
    'designation',
    'address',
    'email',
    'contact_no'
    ],1);
if($st[0]===0){
    $result['status']="FAIL";
    $result['comment']=$st[1];
    echo json_encode($result);
    exit();
}
$parameter['department']="/^(CSE|CT|IT|BSEH|1)$/";
//$parameter['joining_year'] = "/^((1)|(20\d\d))$/";
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
    
    $query = "SELECT * FROM coe WHERE username=? AND isActive='1' LIMIT 1";
    $q = new Query($query,"s");
    $q->execute([$_POST['usernamecoe']]);
    $exist = $q->data();
    if(!$exist){
        $user = $_POST['username'];
        $result['status']="FAIL";
        $result['comment']="incorrect username: $user";
        echo json_encode($result);
        exit();
    }
	else if($exist[0]['password']!=$_POST['passwordcoe']){
		$user = $_POST['username'];
        $result['status']="FAIL";
        $result['comment']="incorrect passwordcoe";
        echo json_encode($result);
        exit();
	}
    
    //  $bpy = (int)$_POST['joining_year']+4;   
     $query = "UPDATE teacher SET 
     name=?,
     departmentCode=?,
     designation=?,
     address=?,
     email=?,
     contactNo=? WHERE username=? AND isActive='1'";
     $types = "sssssss";
     $q = new Query($query,$types);
     $name =  $_POST['name'];
     $dcode = $_POST['department'];
     $desg = $_POST['designation'];
     $address = $_POST['address'];
     $email = $_POST['email'];
     $contact = $_POST['contact_no'];
     $q->execute([
         $name,
         $dcode,
         $desg,
         $address,
         $email,
         $contact,
         $_POST['username']
     ]);
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