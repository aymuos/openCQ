<?php

class Choice{
    public $id;
    public $st;
    public $priority;
    public $isCorrect;

    /*public function __construct(){
        ;
    }*/

    public function __construct($id,$str,$ac){
        $this->id = $id;
        $this->st = $str;
        $priorityArr = array(0,0,0);
        $str = strtolower($str);
        $stArr = explode(" ",$str);
        foreach($stArr as $value){
            if($value == "none"){
                $priorityArr[0]=1;
            }
            else if($value == "all"){
                $priorityArr[1]=1;
            }
            else if($value == "both"){
                $priorityArr[2]=1;
            }
        }
        if($priorityArr[2]==1){
            $this->priority = 1;
        }
        if($priorityArr[1]==1){
            $this->priority = 2;
        }
        if($priorityArr[0]==1){
            $this->$priority = 3;
        }
        $this->isCorrect = $ac;
    }
}
?>