<?php
function add_question($conn,$chname,$statement,$co,$ico1,$ico2,$ico3,$id,$flag){
    $arr = [];
    $arr[]=get_id($co);
    $arr[]=get_id($ico1);
    $arr[]=get_id($ico2);
    $arr[]=get_id($ico3);

    $arr2 = array_unique($arr);

    if(count($arr) == count($arr2)){
        ;
    }
    else{
        exit("Duplicate Choice");
    }
    try{
        $conn->autocommit(FALSE);

        $url = "";
        if(count($flag)==0){
            //no image;
            ;
        }
        else if(count($flag)==1){
            $url = $flag[0];
            /*$query = "UPDATE question SET url = ? WHERE id = ?";
            execute($conn,$query,"si",[$flag[0],$question_id],$stmt);
            close($stmt);*/        
    
        }
        else{
            //add file
            
            $image_name = $id;
            $image_location = $flag[0].$image_name.'.'.$flag[1];
            $url = $image_location;
    
            /*$query = "UPDATE question SET url = ? WHERE id = ?";
            execute($conn,$query,"si",[$image_location,$question_id],$stmt);
            close($stmt);*/
        }



        if($id == ""){
            $id=0;
        }
        else{
            $query = "SELECT id FROM question WHERE id = ? LIMIT 1";
            execute($conn,$query,"i",[$id],$stmt);
            $result = get_data($stmt);
            close($stmt);
            if(!$result){
                exit("Invalid Question");
            }

        }
        
        $query = "INSERT INTO question(id,name,url,chapter_id) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE name=VALUES(name),url=VALUES(url),chapter_id=VALUES(chapter_id)";
        execute($conn,$query,"issi",[$id,$statement,$url,$chname],$stmt);
        echo 'insert_id = '.$conn->insert_id;
        echo '<br>';
        if($id==0){
            $id = $conn->insert_id;
            
            if(count($flag)==2){
                $image_name = $id;
                $image_location = $flag[0].$image_name.'.'.$flag[1];
                $url = $image_location;
                $query = "UPDATE question SET url = ? WHERE id = ?";
                execute($conn,$query,"si",[$image_location,$id],$stmt);
                close($stmt);
            }
            
        }


        $query = "SELECT id,is_right FROM choice WHERE question_id = ?";
        execute($conn,$query,"i",[$id],$stmt);
        $result = get_data($stmt);
        close($stmt);
        $coid = 0;
        $waid = [];
        if(count($result)==0){

            $waid[]=0;
            $waid[]=0;
            $waid[]=0;
        }
        else{
            foreach($result as $value){
                if($value['is_right'] == '1'){
                    $coid = $value['id'];
                }
                else{
                    $waid[]=$value['id'];
                }
            }
        }


        $query = "INSERT INTO choice(id,name,is_right,question_id) VALUES (?,?,'1',?),(?,?,'0',?),(?,?,'0',?),(?,?,'0',?) ON DUPLICATE KEY UPDATE name=VALUES(name);";
        execute($conn,$query,"isiisiisiisi",[$coid,$co,$id,$waid[0],$ico1,$id,$waid[1],$ico2,$id,$waid[2],$ico3,$id],$stmt);
        close($stmt);





        $conn->autocommit(TRUE);
        return $id;
    }
    catch(Exception $e){
        if($conn->errno === 1452){
            $conn->rollback();
            exit('chapter does not exist');
        }
        $conn->rollback();
        report($e);
        //CloseCon($conn);
        exit("Error in upload_functions.php -> add_question");
    }
}

?>