<?php
require_once "Student.class.php";

class Tung extends Student {

    private $weight = 10;  
    private $height = 80; 
    
    public function getWeight(){
        return  self::$weight;
    }
    public function setWeight($weight){
        $this->weight  = $weight;
    }
    public function getHeight(){
        return  $this->height;
    }
    public function setHeight($height){
        $this->height = $height;
    }
    public function showInfor(){
        parent::showInfor();
        echo "weight: " . $this->weight . "<br/>";
        echo "height: " . $this->height . "<br/>";
    }
    public function __toString(){
        return "tên tôi là " . $this->getName();
    }
}
